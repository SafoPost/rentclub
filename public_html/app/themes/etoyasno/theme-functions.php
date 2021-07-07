<?php
function getTermTopParent($term_id, $tax)
{
    $parent  = get_term_by('id', $term_id, $tax);
    while ($parent->parent != 0) {
        $parent  = get_term_by('id', $parent->parent, $tax);
    }
    return $parent->term_id;
}

function recursiveTree($activeParent = 0, $parent = 0, $tax = 'product_cat')
{
    $terms = get_terms([
        'taxonomy' => $tax,
        'hide_empty' => false,
        'parent' => $parent
    ]);
    if (count($terms) > 0): ?>
        <ul <?php echo 'class="' . (($parent !== 0) ? 'sub-category ' : 'parent-category ') .  '"'; ?>>
            <?php foreach ($terms as $category):
                $childs = get_term_children($category->term_id, $tax);


                ?>
                <li <?php echo ($activeParent === $category->term_id || get_queried_object()->parent === $category->term_id) ? 'class="active"' : '' ?><?php echo (get_queried_object()->term_id === $category->term_id) ? 'class="current-cat"' : '' ?> >
                    <a href="<?php echo get_term_link($category->term_id, $tax);?>"> <?php echo $category->name; ?></a>
                    <?php if (count($childs) > 0):
                        recursiveTree($activeParent, $category->term_id);
                    endif; ?>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php endif;
}
function get_taxonomy_hierarchy($lowlevel, $parent = 0, $taxonomy = 'product_cat' ) {
    $result = array();
    $parent = get_term($lowlevel, $taxonomy);
    array_unshift($result, $parent->name);
    while ($parent->parent != 0) {
        $parent  = get_term_by('id', $parent->parent, $taxonomy);
        array_unshift($result, $parent->name);
    }

    return $result;
}