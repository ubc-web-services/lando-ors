<?php
/**
 * @file
 * Display Suite Slideshow slide template.
 *
 * Available variables:
 *
 * Layout:
 * - $classes: String of classes that can be used to style this layout. // REMOVED
 * - $contextual_links: Renderable array of contextual links.
 * - $layout_wrapper: wrapper surrounding the layout. // REMOVED
 *
 * Regions:
 *
 * - $image: Rendered content for the "Image" region.
 * - $image_classes: String of classes that can be used to style the "Image" region. //  REMOVED
 *
 * - $caption: Rendered content for the "Caption" region.
 * - $caption_classes: String of classes that can be used to style the "Caption" region.
 */
?>

  <!-- Needed to activate contextual links -->
  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

    <?php print $image; ?>

    <div class="flex-caption <?php print $caption_classes; ?>">
      <?php print $caption; ?>
    </div>


<!-- Needed to activate display suite support on forms -->
<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
