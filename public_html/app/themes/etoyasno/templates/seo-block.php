<?php
if (is_archive() || is_tax()){
    $seo_block = get_field('seo_block', get_queried_object());

} else {
    $seo_block = get_field('seo_block');

}
$text = explode("<p><!--more--></p>", $seo_block['seo_text']);

?>
<?php if (strlen($text[0]) > 0): ?>
<section class="seo">
    <div class="wrapper">
        <?php if (strlen($seo_block['title']) > 0): ?>
        <h2 class="seo-title quadrate green"><?php echo $seo_block['title']; ?></h2>
        <?php endif; ?>
        <div class="seo-block <?php echo (isset($text[1]) && strlen($text[1]) < 1) ? 'hidden' : ''; ?>">
            <div class="show">
                <?php echo $text[0]; ?>
            </div>
            <?php if (isset($text[1]) && strlen($text[1]) > 0): ?>
                <div class="hidden">
                    <?php echo $text[1]; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($text[1]) && strlen($text[1]) > 0): ?>
            <button class="show-seo-block btn size-small blank more">Читать полностью</button>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
