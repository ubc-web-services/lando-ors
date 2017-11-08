<?php
/**
 * @file
 * Display Suite Accordion template.
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
 * - $accordion_trigger: Rendered content for the "Accordion Trigger" region.
 * - $accordion_trigger_classes: String of classes that can be used to style the "Accordion Trigger" region.
 *
 * - $accordion_content: Rendered content for the "Accordion Content" region.
 * - $accordion_content_classes: String of classes that can be used to style the "Accordion Content" region.
 */
?>

  <div class="accordion accordion-closed">
      
  <!-- Needed to activate contextual links -->
  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>
    
    <div class="accordion-tab" tabindex="0">
      <?php print $accordion_trigger; ?>
    </div> 

   <div class="accordion-content clearfix">
      <?php print $accordion_content; ?>
    </div>
  </div>



<!-- Needed to activate display suite support on forms -->
<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
