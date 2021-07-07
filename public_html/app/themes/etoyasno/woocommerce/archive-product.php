<?php


defined('ABSPATH') || exit;

get_header();


?>

<main class="page-catalog">
    <section>
        <div class="wrapper">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="quadrate green size-h2"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <nav class="catalog-cards sub">
                <?php
                $terms = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'parent' => 0
                ]);
                foreach ($terms as $category):
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id);

                $childs = get_terms('product_cat', array('parent' => $category->term_id, 'hide_empty' => false));
                echo (count($childs) > 0) ? '<div class="category-with-child">' : '';
                ?>
                <a href="<?php echo get_term_link($category->term_id, 'product_cat'); ?>"
                   class="catalog-card" <?php echo ($image) ? 'style="background-image: url(' . $image . ')"' : '' ?>>
                    <div class="card-title">
                        <?php
                        if (strlen(get_field('category_title', $category)) > 0) {
                            echo get_field('category_title', $category);
                        } else {
                            echo $category->name;
                        }
                        ?>
                    </div>
                </a>
                    <?php
                    if (count($childs) > 0):
                        echo '<ul class="card-sub-category">';
                        foreach ($childs as $child): ?>
                            <li>
                                <a href="<?php echo get_term_link($child->term_id, 'product_cat'); ?>"><?php echo $child->name; ?></a>
                            </li>
                        <?php endforeach;
                        echo '</ul>';
                    endif;
                    ?>
                <?php
                echo (count($childs) > 0) ? '</div>' : '';
                ?>

            <?php endforeach; ?>
        </nav>
        </div>
    </section>
</main>

<?php

get_footer();
