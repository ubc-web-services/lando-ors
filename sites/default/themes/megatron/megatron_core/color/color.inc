<?php

// Put the logo path into JavaScript for the live preview.
//drupal_add_js(array('color' => array('logo' => theme_get_setting('logo', 'megatron'))), 'setting');

$info = array(
  // Available colors and color labels used in theme.
  'fields' => array(
    'unit' => t('Unit Colour'),
    'text' => t('Text color'),
    'title' => t('Title color'),
    'link' => t('Link color'),
    'linkvisited' => t('Link visited color'),
    'linkhover' => t('Link hover color'),
    'linkactive' => t('Link active color'),
    'menu_item_color' => t('Primary menu item link color'),
    'menu_item_color' => t('Primary menu item background color'),
    'menu_item_a_color' => t('Primary menu active item link color'),
    'menu_item_a_bg' => t('Primary menu active item background color'),
    'menu_item_a_color' => t('Primary menu background color'),
  ),
  // Pre-defined color schemes.
  'schemes' => array(
    'default' => array(
      'title' => t('CLF (default)'),
      'colors' => array(
        'unit' => '#0779bf',
        'text' => '#0779bf',
        'title' => '#0779bf',
        'link' => '#0779bf',
        'linkvisited' => '#0779bf',
        'linkhover' => '#0779bf',
        'linkactive' => '#0779bf',
        'menu_item_color' => '#0779bf',
        'menu_item_color' => '#0779bf',
        'menu_item_a_color' => '#0779bf',
        'menu_item_a_bg' => '#0779bf',
        'menu_item_a_color' => '#0779bf',
      ),
    ),
    'plum' => array(
      'title' => t('Plum'),
      'colors' => array(
        'unit' => '#0779bf',
        'text' => '#0779bf',
        'title' => '#0779bf',
        'link' => '#0779bf',
        'linkvisited' => '#0779bf',
        'linkhover' => '#0779bf',
        'linkactive' => '#0779bf',
        'menu_item_color' => '#0779bf',
        'menu_item_color' => '#0779bf',
        'menu_item_a_color' => '#0779bf',
        'menu_item_a_bg' => '#0779bf',
        'menu_item_a_color' => '#0779bf',
      ),
    ),
    'slate' => array(
      'title' => t('Slate'),
      'colors' => array(
        'unit' => '#0779bf',
        'text' => '#0779bf',
        'title' => '#0779bf',
        'link' => '#0779bf',
        'linkvisited' => '#0779bf',
        'linkhover' => '#0779bf',
        'linkactive' => '#0779bf',
        'menu_item_color' => '#0779bf',
        'menu_item_color' => '#0779bf',
        'menu_item_a_color' => '#0779bf',
        'menu_item_a_bg' => '#0779bf',
        'menu_item_a_color' => '#0779bf',
      ),
    ),
  ),

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => array(
    'css/colors.css',
  ),

/*
  // Files to copy.
  'copy' => array(
    'logo.png',
  ),
  */

  // Gradient definitions.
  'gradients' => array(
    array(
      // (x, y, width, height).
      'dimension' => array(0, 0, 0, 0),
      // Direction of gradient ('vertical' or 'horizontal').
      'direction' => 'vertical',
      // Keys of colors to use for the gradient.
      'colors' => array('top', 'bottom'),
    ),
  ),

  // Color areas to fill (x, y, width, height).
  'fill' => array(),

  // Coordinates of all the theme slices (x, y, width, height)
  // with their filename as used in the stylesheet.
  'slices' => array(),

  // Reference color used for blending. Matches the base.png's colors.
  'blend_target' => '#ffffff',

  // Preview files.
  'preview_css' => 'color/preview.css',
  'preview_js' => 'color/preview.js',
  'preview_html' => 'color/preview.html',

  // Base file for image generation.
  'base_image' => 'color/base.png',
);
