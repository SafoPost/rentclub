<?php

function recursiveTreeNewAd($parent = 0, $prev = '', $tax = 'product_cat')
{
    $terms = get_terms([
        'taxonomy' => $tax,
        'hide_empty' => false,
        'parent' => $parent,
    ]);
    if (!empty($_GET['prev'])):
        $default_term = intval($_GET['prev']);
        if (is_int($default_term) && $default_term > 0) {
            $current_term = get_term_by('id', $default_term, $tax);
            $parent_name = get_term_by('id', $current_term->parent, $tax)->name;
            $current_tree = get_taxonomy_hierarchy($default_term);
        }
    endif;

    if (count($terms) > 0) {

        $class = array();
        if ($parent !== 0) {
            $class[] = 'sub-category';
        } else {
            $class[] = 'parent-category';
        }
        if (!empty($_GET['prev'])):
            if (in_array($prev, $current_tree) && $prev !== $parent_name || empty($prev)) {
                $class[] = 'opened';
            }
        endif;
        ?>

        <ul class="<?php echo implode(" ", $class) ?>" data-parent="<?php echo $prev; ?>">
            <?php foreach ($terms as $category):
                $childs = get_term_children($category->term_id, $tax);

                $class = array();
                if (!empty($_GET['prev'])):
                    if (count($childs) !== 0) {
                        $class[] = 'parent';
                    }
                    if (in_array($category->name, $current_tree) && count($childs) !== 0) {
                        $class[] = 'active';
                    }
                endif;
                ?>
                <li
                        class="<?php echo implode(" ", $class) ?>"
                        data-slug="<?php echo $category->slug; ?>">
                    <?php
                    if (count($childs) !== 0):
                        echo '<span class="category-item">' . $category->name . '</span>';
                        recursiveTreeNewAd($category->term_id, $category->name);
                    else:
                        echo '<a class="category-item link" href="' . get_permalink(9) . 'ads/add/' . $category->slug . '">' . $category->name . '</a>';
                    endif;
                    ?>
                </li>

            <?php endforeach; ?>
        </ul>
        <?php
    }
}

?>
<h1 class="quadrate green size-h2">Новое объявление</h1>
<div class="category-wizard">
    <?php recursiveTreeNewAd(); ?>
</div>
<script>
    let wizard = jQuery('.category-wizard');
    wizard.find('li').on('click', function () {
        if (!jQuery(this).hasClass('active')) {
            jQuery(this).siblings('li.active').removeClass('active').find('li.active').removeClass('active');
            jQuery(this).parent().addClass('opened');
            jQuery(this).addClass('active');
        }
    });
</script>

