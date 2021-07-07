<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();


?>
    <main class="page-catalog">
        <div class="wrapper">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <div class="catalog-title">
                    <h1 class="quadrate green size-h2"><?php woocommerce_page_title(); ?></h1>
                </div>

            <?php endif; ?>
            <div class="page-catalog-block">
                <nav class="category-list">
                    <div class="category-list-title">Категории</div>
                    <?php

                    recursiveTree(getTermTopParent(get_queried_object()->term_id, 'product_cat'));
                    ?>

                </nav>
                <div class="product-list">
                    <?php
                    if (woocommerce_product_loop()) {


                        woocommerce_product_loop_start();

                        if (wc_get_loop_prop('total')) {
                            while (have_posts()) {
                                the_post();

                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action('woocommerce_shop_loop');

                                wc_get_template_part('content', 'product');
                            }
                        }

                        woocommerce_product_loop_end();

                        /**
                         * Hook: woocommerce_after_shop_loop.
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        woocommerce_pagination();
                        //do_action('woocommerce_after_shop_loop');
                    } else {
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action('woocommerce_no_products_found');
                    } ?>
                </div>
            </div>
        </div>
        <?php get_template_part('templates/seo', 'block'); ?>
    </main>

<?php

get_footer();