<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header id="header">
    <div class="wrapper">
        <div class="header-top">
            <div class="h-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"
                   title="<?php echo esc_html(get_bloginfo('name')); ?>" rel="home">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/source/img/svg/logo.svg' ?>" alt="">
                </a>
            </div>
            <div class="h-city">
                <div class="city-title">Ваш город:</div>
                <button class="city">Екатеринбург</button>
            </div>
            <div class="h-search">
                <form action="" class="form-search" method="post">
                    <input type="search" name="h-search" onkeyup="this.setAttribute('value', this.value);" value=""
                           placeholder="Камера Canon 6D">
                    <input type="submit" value="">
                </form>
            </div>
            <a href="#" class="h-rent-link btn size-medium green plus">Сдать в аренду</a>
            <div class="h-panel">
                <div class="h-panel-button cart" data-count="3">
                    <a href="#" class="cart-btn"></a>
                </div>
                <div class="h-panel-button user" data-count="1">
                    <button class="user-btn"></button>
                    <ul class="user-menu">
                        <li><a href="">Мои заказы</a></li>
                        <li><a href="">Мой профиль</a></li>
                        <li><a href="">Мои объявления</a></li>
                        <li><a href="">Уведомления</a></li>
                        <li><a href="">Выйти</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        if (!is_account_page()):
        ?>
        <div class="header-bottom">
            <?php wp_nav_menu(
                [
                    'theme_location' => 'header-menu',
                    'container' => 'nav',
                    'menu_class' => 'header-menu',
                    'menu_id' => 'main-menu',
                ]
            ); ?>
        </div>
        <?php endif; ?>
        <div class="h-contacts"></div>
    </div>
</header>
<?php
global $wp_query;
if (function_exists('yoast_breadcrumb')
    && !is_front_page()
    && !is_account_page()
    && !array_key_exists( 'user', $wp_query->query_vars )
) { ?>
    <div class="breadcrumbs">
        <div class="wrapper">
            <?php yoast_breadcrumb('<nav id="breadcrumbs">', '</nav>'); ?>
        </div>
    </div>
<?php }
?>





