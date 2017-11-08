<?php

/**
 * @file
 * Display Suite Untables configuration.
 */

function ds_untables() {
  return array(
    'label' => t('Untables'),
    'regions' => array(
      'first' => t('First'),
      'second' => t('Second'),
      'third' => t('Third'),
      'fourth' => t('Fourth'),
    ),
    // Uncomment if you want to include a CSS file for this layout (untables.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (untables.png)
    // 'image' => TRUE,
  );
}
