<?php
/**
 * @package Rentit_Extra_Hours
 * @version 1.0
 */
/*
Plugin Name: Rentit Extra Hours
Plugin URI: https://wordpress.org/plugins/hello-dolly/
Description: Rentit_Extra_Hours
Version: 1.0
Author URI: https://ma.tt/
Text Domain: Rentit_Extra_Hours
*/// check for plugin using plugin name
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'rentit_date_changer/rentit_date_changer.php' ) ) {
	  //plugin is activated
	
	require_once('customizer.php');
	require_once('before_cart_set_session.php');
}else{
	add_action( 'admin_init', 'Rentit_Extra_Hours_notice' );
	function Rentit_Extra_Hours_notice(){
		 $plugin = plugin_basename( __FILE__ ); // 'myplugin'
		 deactivate_plugins( $plugin ); // Deactivate 'myplugin'
		?><div class="error"><p><?php 	esc_html_e( 'Sorry, but This Plugin requires the rentit_date_changer to be installed and active.', 'rentit' );
	 ?></p></div><?php
	}
}



