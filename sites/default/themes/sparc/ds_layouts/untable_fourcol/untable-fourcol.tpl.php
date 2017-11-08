<?php
/**
 * @file
 * Display Suite Untable: 4 column template.
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
 * - $colfirst: Rendered content for the "colfirst" region.
 * - $colfirst_classes: String of classes that can be used to style the "colfirst" region.
 *
 * - $colsecond: Rendered content for the "colsecond" region.
 * - $colsecond_classes: String of classes that can be used to style the "colsecond" region.
 *
 * - $colthird: Rendered content for the "colthird" region.
 * - $colthird_classes: String of classes that can be used to style the "colthird" region.
 *
 * - $colfourth: Rendered content for the "colfourth" region.
 * - $colfourth_classes: String of classes that can be used to style the "colfourth" region.
 */
?>
<div class="<?php print $classes;?> row untable-row">

	<?php if (isset($title_suffix['contextual_links'])): ?>
		<?php print render($title_suffix['contextual_links']); ?>
	<?php endif; ?>

	<div class="col-md-3 program <?php print $colfirst_classes; ?>">
		<?php print $colfirst; ?>
	</div>
	
	<div class="col-md-3 sponsor <?php print $colsecond_classes; ?>">
		<?php print $colsecond; ?>
	</div>
	
	<div class="col-md-3 internal-deadline <?php print $colthird_classes; ?>">
		<?php print $colthird; ?>
	</div>
	
	<div class="col-md-3 external-deadline <?php print $colfourth_classes; ?>">
		<?php print $colfourth; ?>
	</div>

</div>

<?php if (!empty($drupal_render_children)): ?>
	<?php print $drupal_render_children ?>
<?php endif; ?>
