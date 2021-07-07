<?php
$data = get_field('general_data', 'general');


?>

<footer id="footer">
    <div class="footer-top">
        <div class="wrapper">
            <?php wp_nav_menu(
                [
                    'theme_location' => 'footer-menu',
                    'container' => 'nav',
                    'menu_class' => 'footer-menu',
                    'menu_id'         => 'footer-menu',
                ]
            ); ?>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="wrapper">
            <div class="footer-bottom-block">
                <div class="footer-data">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"
                       title="<?php echo esc_html(get_bloginfo('name')); ?>" rel="home">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/source/img/svg/logo.svg' ?>" alt="">
                    </a>
                    <a class="phone" href="tel:<?php echo preg_replace('/[^0-9\\+]/', '', $data['contacts']['phone']); ?>"><?php echo $data['contacts']['phone']; ?></a>
                    <a class="email" href="mailto:<?php echo $data['contacts']['email']; ?>"><?php echo $data['contacts']['email']; ?></a>
                    <div class="social">
                        <?php if (strlen($data['social']['instagram']) > 0): ?>
                            <a href="<?php echo $data['social']['instagram']; ?>" class="instagram"
                               target="_blank"></a>
                        <?php endif; ?>
                        <?php if (strlen($data['social']['youtube']) > 0): ?>
                            <a href="<?php echo $data['social']['youtube']; ?>" class="youtube"
                               target="_blank"></a>
                        <?php endif; ?>
                        <?php if (strlen($data['social']['telegram']) > 0): ?>
                            <a href="tg://resolve?domain=<?php echo $data['social']['telegram']; ?>" class="telegram"
                               target="_blank"></a>
                        <?php endif; ?>
                        <?php if (strlen($data['social']['whatsapp']) > 0): ?>
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $data['social']['whatsapp']); ?>"
                               class="whatsapp"
                               target="_blank"></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="footer-catalog">
                    <nav>
                        <div class="catalog-title">Каталог</div>
                        <ul class="footer-catalog-list">
                            <?php
                            $terms = get_terms([
                                'taxonomy' => 'product_cat',
                                'parent' => 0
                            ]);
                            foreach ($terms as $term): ?>
                                <li>
                                    <a href="<?php echo get_term_link($term->term_id, 'product_cat'); ?>"><?php echo $term->name; ?></a>

                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
                <div class="footer-additional-data">
                    <a href="#" class="h-rent-link btn border plus">Сдать в аренду</a>
                    <div class="requisites">
                        <?php if (strlen($data['requisites']['ooo']) > 0): ?>
                            <div class="ooo"><?php echo $data['requisites']['ooo']; ?></div>
                        <?php endif; ?>
                        <div class="requisites-line">
                            <?php if (strlen($data['requisites']['inn']) > 0): ?>
                                <div class="inn"><?php echo $data['requisites']['inn'] . ' | '; ?></div>
                            <?php endif; ?>
                            <?php if (strlen($data['requisites']['kpp']) > 0): ?>
                                <div class="kpp"><?php echo $data['requisites']['kpp']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="payments">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/source/img/svg/footer/googlePay.svg' ?>" alt="">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/source/img/svg/footer/apay.svg' ?>" alt="">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/source/img/svg/footer/master-card.svg' ?>" alt="">
                        <div class="break"></div>
                        <img src="<?php echo get_stylesheet_directory_uri() . '/source/img/svg/footer/visa.svg' ?>" alt="">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/source/img/svg/footer/maestro.svg' ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="dev">Разработка сайта: <a href="https://eto-yasno.ru" target="_blank">Это Ясно</a></div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
