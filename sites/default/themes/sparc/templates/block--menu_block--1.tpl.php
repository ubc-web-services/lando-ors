<?php
/**
 * Created by PhpStorm.
 * User: veades
 * Date: 2015-02-26
 * Time: 11:27 AM
 */

?>
<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

<?php print render($title_prefix); ?>
<?php if ($title): ?>
    <header>
        <h2<?php print $title_attributes; ?>><?php print decode_entities($title); ?></h2>
    </header>
<?php endif;?>
<?php print render($title_suffix); ?>

<?php print $content ?>

</section> <!-- /.block -->