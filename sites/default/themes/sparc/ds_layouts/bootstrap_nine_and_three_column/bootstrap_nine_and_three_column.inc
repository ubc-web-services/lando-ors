<?php

/**
 * @file
 * Display Suite Bootstrap nine and three column configuration.
 */

function ds_bootstrap_nine_and_three_column() {
  return array(
    'label' => t('Bootstrap nine and three column'),
    'regions' => array(
      'left' => t('Left'),
      'right' => t('Right'),
    ),
    // Uncomment if you want to include a CSS file for this layout (bootstrap_nine_and_three_column.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (bootstrap_nine_and_three_column.png)
    // 'image' => TRUE,
  );
}
