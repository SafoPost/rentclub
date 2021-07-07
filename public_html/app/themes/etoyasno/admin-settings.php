<?php
add_action( 'admin_menu', 'add_user_menu_bubble' );

function add_user_menu_bubble() {
    global $menu;

    $user_count = count_users();  // get whatever count you need
    $user_count = $user_count['avail_roles']['administrator'];

    if ( $user_count ) {

        foreach ( $menu as $key => $value ) {

            if ( $menu[$key][2] == 'users.php' ) {

                $menu[$key][0] .= ' ' . $user_count . '';

                return;
            }
        }
    }
}