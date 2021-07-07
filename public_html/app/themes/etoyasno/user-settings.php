<?php
// Create the query var so that WP catches the custom /member/username url
function userpage_rewrite_add_var( $vars ) {
    $vars[] = 'user';
    return $vars;
}
add_filter( 'query_vars', 'userpage_rewrite_add_var' );

// Create the rewrites
function userpage_rewrite_rule() {
    add_rewrite_tag( '%user%', '([^&]+)' );
    add_rewrite_rule(
        '^user/([^/]*)/?',
        'index.php?user=$matches[1]',
        'top'
    );
}
add_action('init','userpage_rewrite_rule');

// Catch the URL and redirect it to a template file
function userpage_rewrite_catch() {
    global $wp_query;

    if ( array_key_exists( 'user', $wp_query->query_vars ) ) {
        include (TEMPLATEPATH . '/public-profile.php');
        exit;
    }
}
add_action( 'template_redirect', 'userpage_rewrite_catch' );

function memberpage_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action('init','memberpage_rewrite');

add_filter( 'pre_user_login' , 'wpso_same_user_email' );


function wpso_same_user_email( $user_login ) {
    global $wpdb;
    $last = $wpdb->get_row("SHOW TABLE STATUS LIKE 'wp_users'");
    $lastid = $last->Auto_increment;

    if( isset($_POST['email'] ) ) {
        $user_login = 'id' . substr(time(), -2) . mt_rand(0, 20000);
    }
    return $user_login;
}

function filter_user_contact_methods( $methods ) {


    // To remove them all
    $methods = array();

    return $methods;
}
add_filter( 'user_contactmethods', 'filter_user_contact_methods' );