<?php
function Rentit_Extra_Hours_before_cart_set_session_custom_data( $array ) {
	$rentit_extra_hours_max_free_hours = get_theme_mod( 'rentit_extra_hours_max_free_hours', '2' );
	$rentit_extra_hours_max_make_day = get_theme_mod( 'rentit_extra_hours_max_make_day', '12' );
	$total_diff_to_calc = $rentit_extra_hours_max_make_day - $rentit_extra_hours_max_free_hours;
	if($extra_hours <= $rentit_extra_hours_max_free_hours){//its free less than enough hour to calc

	}elseif($extra_hours >= $rentit_extra_hours_max_make_day){//make a day price
		$extra_hours = rentit_DateDiff( 'h', strtotime( $_POST[ 'gregorian_dropin_date' ] ), strtotime( $_POST[ 'gregorian_dropoff_date' ] ) ) % 24;
		$_POST[ 'extra_hours' ] = $extra_hours;
		$product_id = isset( $_POST[ 'add-to-cart' ] ) ? absint( $_POST[ 'add-to-cart' ] ) : '';
		$price = rentit_get_current_price_product( $product_id );

		$price_per_hour = round( $price / $total_diff_to_calc );
		$total_price_extra_hours = $price / $total_diff_to_calc * $_POST[ 'extra_hours' ];
		$round_total_price_extra_hours = $price;

		$_SESSION[ 'extra_hours' ] = $_POST[ 'extra_hours' ];
		$_SESSION[ 'custom_data_1' ][ 'extra_hours' ] = $_POST[ 'extra_hours' ];

		$custom_data_extras_hours[ 'value' ] = $round_total_price_extra_hours . " " . get_woocommerce_currency_symbol( get_option('woocommerce_currency'));
		$custom_data_extras_hours[ 'name' ] = $_SESSION[ 'extra_hours' ] . ' Extra Hour(s)';
		$custom_data_extras_hours[ 'price' ] = $round_total_price_extra_hours;
		$custom_data_extras_hours[ 'duration_type' ] = 'total';
		$array[ 'extras' ][ 999999999 ] = $custom_data_extras_hours;
		$array[ 'new_price' ] = $array[ 'new_price' ] + $round_total_price_extra_hours;

		wc_setcookie( 'extra_hours', $_POST[ 'extra_hours' ], time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
	}else{//less than a day
		$extra_hours = rentit_DateDiff( 'h', strtotime( $_POST[ 'gregorian_dropin_date' ] ), strtotime( $_POST[ 'gregorian_dropoff_date' ] ) ) % 24;
		$_POST[ 'extra_hours' ] = $extra_hours;
		$product_id = isset( $_POST[ 'add-to-cart' ] ) ? absint( $_POST[ 'add-to-cart' ] ) : '';
		$price = rentit_get_current_price_product( $product_id );

		$price_per_hour = round( $price / $total_diff_to_calc );
		$total_price_extra_hours = $price / $total_diff_to_calc * $_POST[ 'extra_hours' ];
		$round_total_price_extra_hours = round( $price / $total_diff_to_calc * $_POST[ 'extra_hours' ] / 10000 ) * 10000;

		$_SESSION[ 'extra_hours' ] = $_POST[ 'extra_hours' ];
		$_SESSION[ 'custom_data_1' ][ 'extra_hours' ] = $_POST[ 'extra_hours' ];

		$custom_data_extras_hours[ 'value' ] = $round_total_price_extra_hours . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) );
		$custom_data_extras_hours[ 'name' ] = $_SESSION[ 'extra_hours' ] . ' Extra Hour(s)';
		$custom_data_extras_hours[ 'price' ] = $round_total_price_extra_hours;
		$custom_data_extras_hours[ 'duration_type' ] = 'total';
		$array[ 'extras' ][ 999999999 ] = $custom_data_extras_hours;
		$array[ 'new_price' ] = $array[ 'new_price' ] + $round_total_price_extra_hours;

		wc_setcookie( 'extra_hours', $_POST[ 'extra_hours' ], time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
	}
	return $array;

}


//source:https://stackoverflow.com/questions/43324605/change-cart-item-prices-in-woocommerce-3
//https://stackoverflow.com/questions/44974645/change-price-of-product-in-woocommerce-cart-and-checkout
add_action( 'woocommerce_before_calculate_totals', 'custom_cart_items_prices', 99999999, 1 );

function custom_cart_items_prices( $cart ) {
	if ( is_admin() && !defined( 'DOING_AJAX' ) ) {
		return;
	}

	if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) {
		return;
	}
	// Loop Through cart items
	foreach ( $cart->get_cart() as $cart_item ) {
		//dbg($_SESSION[ 'custom_data_1' ]);
		//die;
		// Updated cart item price
		$cart_item[ 'data' ]->set_price( $_SESSION[ 'custom_data_1' ][ 'new_price' ] );
	}
}