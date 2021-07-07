
<?php
  $schemes = get_field('work_scheme', 'general');
 ?>
    <section class="how-rent">
        <div class="wrapper">
            <h2 class="quadrate orange">Как взять вещь в аренду</h2>
        </div>
        <div class="single-map">
            <?php
            $s = 1;
            foreach ($schemes[0]['scheme'] as $scheme): ?>
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
    </section>

<?php ?>