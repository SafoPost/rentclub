<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>
    <header class="profile-header">
        <div class="wrapper">
            <?php woocommerce_account_navigation(); ?>
        </div>
    </header>
<?php
if (function_exists('yoast_breadcrumb')){ ?>
    <div class="breadcrumbs">
        <div class="wrapper">
            <?php yoast_breadcrumb('<nav id="breadcrumbs">', '</nav>'); ?>
        </div>
    </div>
<?php }
?>
    <main role="main">
        <div class="wrapper">
            <?php


            the_content();

            ?>
        </div>
    </main>

<?php
do_action('storefront_sidebar');
get_footer();
