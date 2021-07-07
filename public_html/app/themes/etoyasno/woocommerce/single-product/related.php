<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;


$related_products = get_posts( array(
    'numberposts' => 10,
    'orderby'     => 'rand',
    'post_type'   => 'product',
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'terms' => get_the_terms( $post->ID, 'product_cat' )[0],
        )
    ),
    'suppress_filters' => true,
) );


if (count($related_products) > 0): ?>

	<section class="related-products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2 class="quadrate green"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

        <ul class="products-slider columns-4">

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php

					setup_postdata( $GLOBALS['post'] =& $related_product ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;


wp_reset_postdata();
