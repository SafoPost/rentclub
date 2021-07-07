<?php

add_action('after_setup_theme', 'theme_register_nav_menu');
function theme_register_nav_menu()
{
    register_nav_menu('header-menu', 'Шапка сайта');
    register_nav_menu('footer-menu', 'Подвал сайта');
}

if ('disable_gutenberg') {
    add_filter('use_block_editor_for_post_type', '__return_false', 100);
    // Move the Privacy Policy help notice back under the title field.
    add_action('admin_init', function () {
        remove_action('admin_notices', ['WP_Privacy_Policy_Content', 'notice']);
        add_action('edit_form_after_title', ['WP_Privacy_Policy_Content', 'notice']);
    });
}

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Основные настройки',
        'menu_title' => 'Настройки темы',
        'menu_slug' => 'theme-general-settings',
        'post_id' => 'general',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('select-js', get_stylesheet_directory_uri(). '/source/js/custom-select.js');
    wp_enqueue_style('slick-css', get_stylesheet_directory_uri() . '/source/libs/slick/slick.css');
    //wp_enqueue_style('slick-theme-css', get_stylesheet_directory_uri() . '/source/libs/slick/slick-theme.css');
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/source/css/main.css');
    wp_enqueue_script('jquery');
    //wp_enqueue_script('inputmask-js', get_stylesheet_directory_uri() . '/source/js/jquery.inputmask.min.js');
    wp_enqueue_script('slick-js', get_stylesheet_directory_uri(). '/source/libs/slick/slick.min.js');
    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/source/js/main.js');

});

function fancybox_init()
{

    if( is_singular('product') ){
        wp_enqueue_style('fancybox-css', get_stylesheet_directory_uri() . '/source/libs/fancybox/jquery.fancybox.min.css');
        wp_enqueue_script('fancybox-js', get_stylesheet_directory_uri(). '/source/libs/fancybox/jquery.fancybox.min.js');
    }
}

add_action('wp_enqueue_scripts', 'fancybox_init');

add_filter('storefront_customizer_css', '__return_false');
add_filter('storefront_customizer_woocommerce_css', '__return_false');

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Основные настройки',
        'menu_title' => 'Настройки темы',
        'menu_slug' => 'theme-general-settings',
        'post_id' => 'general',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point( $path ) {

    $path = get_stylesheet_directory() . '/acf-json';

    return $path;

}

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

remove_filter ('acf_the_content', 'wpautop');

function mytheme_change_tinymce_colors( $init ) {
    $default_colours = '
        "000000", "Черный",
        "FFFFFF", "Белый"
        ';
    $custom_colours = '
        "FD7C60", "Кораловый",
        "FFAD05", "Оранжевый",
        "1A8B32", "Зеленый",
        "42A6DF", "Голубой",
        "56CCF2", "Светло голубой",
        "E0E0E0", "Серый 1",
        "E4E4E4", "Серый 2",
        "F2F3F5", "Серый 3"
        ';

    $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
    $init['textcolor_rows'] = 6; // expand colour grid to 6 rows
    return $init;
}
add_filter('tiny_mce_before_init', 'mytheme_change_tinymce_colors');


add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_filter( 'storefront_customizer_enabled', '__return_false' );
add_filter( 'storefront_customizer_css', '__return_false' );
add_filter( 'storefront_customizer_woocommerce_css', '__return_false' );



require 'woo-settings.php';
require 'theme-functions.php';
require 'user-settings.php';
require 'admin-settings.php';