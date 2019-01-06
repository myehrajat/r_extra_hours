<?php
function Rentit_Extra_Hours_customizer($wp_customize){
	
    $tmp_sectionname = "rentit_extra_hours";
	
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Extra Hours Settings', 'rentit'),
        'priority' => 1,
        'description' => esc_html__('This is setting part of extra hours management and pricing.', 'rentit')));

    $tmp_settingname = $tmp_sectionname . '_max_free_hours';
    $wp_customize->add_setting($tmp_settingname, array('default' => '0',
                                                       'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Maximum Free Hours', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'description' => esc_html__('This is hours which will not calculate for extra hours!', 'rentit'),
        'settings' => $tmp_settingname,
        'type' => 'select',
        'choices' => array(
            '0' => esc_html__('0 hour', 'rentit'),
            '1' => esc_html__('1 hour', 'rentit'),
            '2' => esc_html__('2 hours', 'rentit'),
            '3' => esc_html__('3 hours', 'rentit'),
            '4' => esc_html__('4 hours', 'rentit'),
            '5' => esc_html__('5 hours', 'rentit'),
            '6' => esc_html__('6 hours', 'rentit'),
            '7' => esc_html__('7 hours', 'rentit'),
            '8' => esc_html__('8 hours', 'rentit'),
            '9' => esc_html__('9 hours', 'rentit'),
            '10' => esc_html__('10 hours', 'rentit'),
            '11' => esc_html__('11 hours', 'rentit'),
            '12' => esc_html__('12 hours', 'rentit'),
        )));
	/**********************/
    $tmp_settingname = $tmp_sectionname . '_max_make_day';
    $wp_customize->add_setting($tmp_settingname, array('default' => '12',
                                                       'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Which Hours Price Full Day?', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'description' => esc_html__('Which hours price full day should be more than Maximum Free Hours', 'rentit') ,
        'settings' => $tmp_settingname,
        'type' => 'select',
        'choices' => array(
            '6' => esc_html__('6 hours', 'rentit'),
            '7' => esc_html__('7 hours', 'rentit'),
            '8' => esc_html__('8 hours', 'rentit'),
            '9' => esc_html__('9 hours', 'rentit'),
            '10' => esc_html__('10 hours', 'rentit'),
            '11' => esc_html__('11 hours', 'rentit'),
            '12' => esc_html__('12 hours', 'rentit'),
            '13' => esc_html__('13 hours', 'rentit'),
            '14' => esc_html__('14 hours', 'rentit'),
            '15' => esc_html__('15 hours', 'rentit'),
            '16' => esc_html__('16 hours', 'rentit'),
            '17' => esc_html__('17 hours', 'rentit'),
            '18' => esc_html__('18 hours', 'rentit'),
            '19' => esc_html__('19 hours', 'rentit'),
            '20' => esc_html__('20 hours', 'rentit'),
            '21' => esc_html__('21 hours', 'rentit'),
            '22' => esc_html__('22 hours', 'rentit'),
            '23' => esc_html__('23 hours', 'rentit'),
            '24' => esc_html__('24 hours', 'rentit'),
        )));
	/**********************/
	
}
add_action('customize_register', 'Rentit_Extra_Hours_customizer',99999);