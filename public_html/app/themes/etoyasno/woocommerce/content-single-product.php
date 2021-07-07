<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('product-block', $product); ?>>
    <div class="block left-block">
        <?php the_title('<h1 class="product_title size-h3">', '</h1>'); ?>

        <?php
        $fullGallery = [];
        $mainImage = $product->get_image_id();
        $galleryImage = $product->get_gallery_image_ids();
        if ($mainImage) {
            $fullGallery[] = intval($mainImage);
            if (!empty($galleryImage)):
                $fullGallery = array_merge($fullGallery, $galleryImage);
            endif;
        } else {
            $fullGallery[] = intval(get_option('woocommerce_placeholder_image', 0));
        }
        ?>

        <div class="product-gallery">
            <div class="main-images">
                <?php foreach ($fullGallery as $slide): ?>
                    <div class="main-images-slide"
                         style="background-image: url('<?php echo wp_get_attachment_image_url($slide, 'medium'); ?>')">
                        <button class="open-photo" data-fancybox="product-gallery"
                                data-src="<?php echo wp_get_attachment_image_url($slide, 'full'); ?>"></button>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (count($fullGallery) > 1): ?>
                <div class="gallery-nav">
                    <button class="arrow left"></button>
                    <div class="thumbs-list">
                        <?php foreach ($fullGallery as $slide): ?>
                            <div class="thumbs-list-slide"
                                 style="background-image: url('<?php echo wp_get_attachment_image_url($slide, 'thumbnail'); ?>')">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="arrow right"></button>
                </div>
            <?php endif; ?>
        </div>
        <div class="product-seller">
            <div class="product-seller-type">
                Частное лицо:
            </div>
            <div class="product-seller-info">
                <div class="avatar">

                </div>
                <div class="info-block name">
                    <div class="info-block-title">
                        Елена
                    </div>
                    <div class="info-block-count reviews-count green">5.0</div>
                </div>
                <div class="info-block raiting">
                    <div class="info-block-title">
                        Рейтинг
                    </div>
                    <div class="info-block-count raiting-count green">5.0</div>
                </div>
                <div class="info-block time">
                    <div class="info-block-title">
                        На сайте
                    </div>
                    <div class="info-block-count time-date">21.07.17</div>
                </div>
                <div class="info-block products">
                    <div class="info-block-title">
                        Сдаёт в аренду
                    </div>
                    <div class="info-block-count product-count green">153 вещи</div>
                </div>
            </div>
        </div>
    </div>
    <div class="block right-block">
        <div class="product-rental-date">
            <div class="product-rental-date-title">Выберете дату аренды:</div>
            <div class="product-datepicker">
                <div class="date-start">25.05</div>
                <div class="arrow"></div>
                <div class="date-finish">26.05</div>
            </div>
        </div>
        <div class="product-price-block">
            <div class="product-price">700₽ <span>/ день</span></div>
            <div class="deposit">+ 5000₽ залог</div>
        </div>
        <ul class="product-labels">
            <li class="pickup">Самовывоз</li>
            <li class="deposit">Без залога</li>
            <li class="break"></li>
            <li class="proof">Обычное подтверждение</li>
        </ul>
        <div class="product-data">
            <div class="product-count">
                <div class="product-data-title">Выберете количество</div>
                <div class="product-quantity">
                    <button class="quantity-btn minus">-</button>
                    <input type="text" value="1">
                    <button class="quantity-btn">+</button>
                </div>
            </div>
            <div class="estimated-value">
                <div class="product-data-title">Оценочная стоимость вещи</div>
                <div class="value-count">7990р.</div>
            </div>
            <div class="product-rent">
                <button class="btn green">Арендовать</button>
                <div class="secure-payment">Безопасная оплата</div>
            </div>
        </div>
        <?php woocommerce_template_single_add_to_cart(); ?>
        <div class="product-info">
            <ul class="product-info-tabs tabs-list">
                <li class="active">
                    <button>Информация о вещи</button>
                </li>
                <li>
                    <button>Характеристики</button>
                </li>
            </ul>
            <div class="product-info-content tab-content" class="active">
                <?php the_content(); ?>
            </div>
            <div class="product-info-content">
                <?php
                $category = wp_get_post_terms($post->ID, 'product_cat', array('fields' => 'ids'));
                $cat_attrs = get_field('attributes', 'product_cat_' . $category[0]);
                echo '<ul class="attributes-list">';
                foreach (get_post_meta($post->ID) as $k => $attribute):
                    if (preg_match("/^_product-att_(.*)$/", $k, $matches)) {
                        if (strlen($attribute[0]) > 0) {
                            foreach ($cat_attrs as $attr):
                                if ($matches[1] === $attr['id']) {
                                    echo '<li><span class="attr-name">' . $attr['name'] . ':</span><span class="attr-value">' . $attribute[0] . '</span></li>';
                                }
                            endforeach;
                        }
                    }
                endforeach;
                echo '</ul>'
                ?>

            </div>
        </div>
    </div>
</div>


<?php
wc_get_template('single-product/related.php');
?>

<?php get_template_part('templates/how', 'rent'); ?>

<?php do_action('woocommerce_after_single_product'); ?>

