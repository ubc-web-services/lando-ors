<?php

/**
 * @file
 * Display Suite Accordion configuration.
 */

function ds_accordion() {
  return array(
    'label' => t('Accordion'),
    'regions' => array(
      'accordion_trigger' => t('Accordion Trigger'),
      'accordion_content' => t('Accordion Content'),
    ),
    // Uncomment if you want to include a CSS file for this layout (accordion.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (accordion.png)
    // 'image' => TRUE,
  );
}
