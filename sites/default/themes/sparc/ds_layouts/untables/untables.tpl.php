<?php
/**
 * @file
 * Display Suite Untables template.
 *
 * Available variables:
 *
 * Layout:
 * - $classes: String of classes that can be used to style this layout.
 * - $contextual_links: Renderable array of contextual links.
 * - $layout_wrapper: wrapper surrounding the layout.
 *
 * Regions:
 *
 * - $first: Rendered content for the "First" region.
 * - $first_classes: String of classes that can be used to style the "First" region.
 *
 * - $second: Rendered content for the "Second" region.
 * - $second_classes: String of classes that can be used to style the "Second" region.
 *
 * - $third: Rendered content for the "Third" region.
 * - $third_classes: String of classes that can be used to style the "Third" region.
 *
 * - $fourth: Rendered content for the "Fourth" region.
 * - $fourth_classes: String of classes that can be used to style the "Fourth" region.
 */
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="<?php print $classes;?> row untable-row">

  <!-- Needed to activate contextual links -->
  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

    <<?php print $first_wrapper; ?> class="col-md-3 ds-first<?php print $first_classes; ?>">
      <?php print $first; ?>
    </<?php print $first_wrapper; ?>>

    <<?php print $second_wrapper; ?> class="col-md-3 ds-second<?php print $second_classes; ?>">
      <?php print $second; ?>
    </<?php print $second_wrapper; ?>>

    <<?php print $third_wrapper; ?> class="col-md-3 ds-third<?php print $third_classes; ?>">
      <?php print $third; ?>
    </<?php print $third_wrapper; ?>>

    <<?php print $fourth_wrapper; ?> class="col-md-3 ds-fourth<?php print $fourth_classes; ?>">
      <?php print $fourth; ?>
    </<?php print $fourth_wrapper; ?>>

</<?php print $layout_wrapper ?>>

<!-- Needed to activate display suite support on forms -->
<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
