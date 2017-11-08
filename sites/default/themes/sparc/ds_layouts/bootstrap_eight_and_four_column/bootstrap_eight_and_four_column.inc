<?php

/**
 * @file
 * Display Suite Bootstrap eight and four column configuration.
 */

function ds_bootstrap_eight_and_four_column() {
  return array(
    'label' => t('Bootstrap eight and four column'),
    'regions' => array(
      'left' => t('Left'),
      'right' => t('Right'),
    ),
    // Uncomment if you want to include a CSS file for this layout (bootstrap_eight_and_four_column.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (bootstrap_eight_and_four_column.png)
    // 'image' => TRUE,
  );
}
