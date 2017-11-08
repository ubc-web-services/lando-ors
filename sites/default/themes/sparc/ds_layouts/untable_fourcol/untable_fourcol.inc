<?php

/**
 * @file
 * Display Suite Untable: Four column configuration.
 */

function ds_untable_fourcol() {
	return array(
		'label' => t('Untable: Four Columns'),
		'regions' => array(
			'colfirst' => t('First Column'),
			'colsecond' => t('Second Column'),
			'colthird' => t('Third Column'),
			'colfourth' => t('Fourth Column'),
		),
		// Uncomment if you want to include a CSS file for this layout (nursing_profile_horizontal.css)
		// 'css' => TRUE,
		// Uncomment if you want to include a preview for this layout (nursing_profile_horizontal.png)
		// 'image' => TRUE,
	);
}
