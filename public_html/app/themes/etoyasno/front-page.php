<?php
get_header();
$page = get_fields();
?>

    <main class="page-home">
        <div class="home-header">
            <div class="home-slider">
                <?php foreach ($page['home_slider'] as $slide): ?>
                    <div class="h-slide" style="background-image: url('<?php echo $slide['image']; ?>')">
                        <div class="wrapper">
                            <div class="h-slide-content">
                                <div class="title"><?php echo $slide['title']; ?></div>
                                <div class="description"><?php echo $slide['description']; ?></div>
                                <a href="#" class="btn green arrow">Подробнее</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <section class="home-catalog">
            <div class="wrapper">
                <div class="catalog-cards">
                    <?php foreach ($page['home_category'] as $category):
                        $thumbnail_id = get_term_meta($category['category']->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);
                        ?>
                        <a href="<?php echo get_term_link($category['category']->term_id, 'product_cat'); ?>"
                           class="catalog-card" <?php echo ($image) ? 'style="background-image: url(' . $image . ')"' : '' ?>>
                            <div class="card-title">
                                <?php
                                if (strlen(get_field('category_title', $category['category'])) > 0) {
                                    echo get_field('category_title', $category['category']);
                                } else {
                                    echo $category['category']->name;
                                }
                                ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="home-work-desc">
            <div class="wrapper">
                <div class="work-desc-header">
                    <div class="text-block">
                        <h2 class="quadrate green"><?php echo $page['service_work']['title']; ?></h2>
                        <div class="text">
                            <?php echo $page['service_work']['description']; ?>
                        </div>
                        <a href="<?php echo $page['service_work']["button"]["url"]; ?>" class="btn green border arrow"
                           target="<?php echo $page['service_work']["button"]["target"]; ?>"><?php echo $page['service_work']["button"]["title"]; ?></a>
                    </div>
                    <div class="img-block"
                         style="background-image: url(<?php echo $page['service_work']['image']; ?>)"></div>
                </div>
                <div class="work-desc-map">
                    <?php
                    $schemes = get_field('work_scheme', 'general');
                    ?>
                    <ul class="map-tabs">
                        <?php for ($i = 0; $i < count($schemes); ++$i) { ?>

                            <li <?php echo ($i === 0) ? 'class="active"' : '' ?> >
                                <button><?php echo $schemes[$i]['title']; ?></button>
                            </li>

                        <?php } ?>
                    </ul>
                    <?php for ($i = 0; $i < count($schemes); ++$i) { ?>

                        <div class="map-content <?php echo ($i === 0) ? 'active' : '' ?>">
                            <?php
                            $s = 1;
                            foreach ($schemes[$i]['scheme'] as $scheme): ?>
                                <div class="map-item item-<?php echo $s; ?>">
                                    <div class="icon icon-<?php echo $s; ?>"
                                         style="background-image: url('<?php echo $scheme['icon']; ?>')"></div>
                                    <div class="title"><?php echo $scheme['title']; ?></div>
                                    <?php if (strlen($scheme['help']) > 0): ?>
                                        <div class="prompt"
                                             data-text="<?php echo $scheme['help']; ?>"></div>
                                    <?php endif; ?>
                                </div>
                                <?php
                                $s++;
                            endforeach; ?>

                        </div>

                    <?php } ?>


                </div>
            </div>
        </section>
        <section class="home-advantages">
            <div class="wrapper">
                <div class="advantages-content">
                    <div class="title">
                        <h2 class="quadrate orange"><?php echo $page['home_advantages']['title']; ?></h2>
                    </div>

                    <div class="img"
                         style="background-image: url('<?php echo $page['home_advantages']['image']; ?>')"></div>
                    <ul class="advantages-list">
                        <?php foreach ($page['home_advantages']['list'] as $list): ?>
                            <li><?php echo $list['title']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
        <section class="home-category">
            <div class="wrapper">

                <ul class="category-menu">
                    <?php
                    $terms = get_terms([
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'parent' => 0
                    ]);
                    foreach ($terms as $term): ?>
                        <li>
                            <a href="<?php echo get_term_link($term->term_id, 'product_cat'); ?>"><?php echo $term->name; ?></a>

                                <?php
                                $childs = get_terms('product_cat', array('parent' => $term->term_id, 'hide_empty' => false));
                                if (count($childs) > 0):
                                    echo '<ul>';
                                foreach ($childs as $child): ?>
                                    <li><a href="<?php echo get_term_link($child->term_id, 'product_cat'); ?>"><?php echo $child->name; ?></a></li>
                                <?php endforeach;
                                echo '</ul>';
                                endif;
                                ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <?php get_template_part('templates/seo', 'block'); ?>
    </main>

<?php
do_action('storefront_sidebar');
get_footer();
