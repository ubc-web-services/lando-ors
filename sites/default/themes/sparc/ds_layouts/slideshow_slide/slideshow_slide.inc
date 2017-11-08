<?php

/**
 * @file
 * Display Suite Slideshow slide configuration.
 */

function ds_slideshow_slide() {
  return array(
    'label' => t('Slideshow slide'),
    'regions' => array(
      'image' => t('Image'),
      'caption' => t('Caption'),
    ),
    // Uncomment if you want to include a CSS file for this layout (slideshow_slide.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (slideshow_slide.png)
    // 'image' => TRUE,
  );
}
