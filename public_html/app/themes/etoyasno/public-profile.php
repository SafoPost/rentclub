<?php
global $wp;

$user = get_user_by( 'login', $wp->query_vars['user'] );
$current_user = wp_get_current_user();


$is_admin = in_array( 'administrator', (array) $current_user->roles);

if ($user === false || in_array( 'administrator', (array) $user->roles)){
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part(404);
    exit;
}
if (is_user_logged_in() && $current_user->data->user_login === $wp->query_vars['user']){
    wp_redirect( get_permalink(9), 301 );
    exit;
}
get_header(); ?>
    <main role="main">
        <div class="wrapper">
            <div class="profile-content">
                <?php
                wc_get_template(
                    'myaccount/personal-info.php',
                    array(
                        'target_user' => get_user_by( 'login', $wp->query_vars['user'] ),
                        'show_private' => $is_admin,
                    )
                );
                ?>
            </div>

        </div>
    </main>

<?php
do_action( 'storefront_sidebar' );
get_footer();
