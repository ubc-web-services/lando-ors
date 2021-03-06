<?php

/** hook_theme() 
---------------------------------------------------------- */
function megatron_theme() {
  return array(
    'ubc_clf_toolbar' => array(
      'variables' => array('element' => NULL)
    ),
    'ubc_clf_header' => array(
      'variables' => array('element' => NULL)
    ),
    'ubc_clf_unit' => array(
      'variables' => array('element' => NULL)
    ),
    'ubc_clf_visual_identity_footer' => array(
      'variables' => array('element' => NULL)
    ),
    'ubc_clf_global_utility_footer' => array(
      'variables' => array('element' => NULL)    
    ),
    'megatron_links' => array(
      'variables' => array(
        'links' => array(), 
        'attributes' => array(), 
        'heading' => NULL
      ),
    ),
    'megatron_mobile_links' => array(
      'variables' => array(
        'links' => array(),
        'attributes' => array(),
        'heading' => NULL
      ),
    ),
    'megatron_secondary_links' => array(
      'variables' => array(
        'links' => array(), 
        'attributes' => array(), 
        'heading' => NULL
      ),
    ),
    /*
    'megatron_side_links' => array(
      'variables' => array(
        'links' => array(), 
        'attributes' => array(), 
        'heading' => NULL
      ),
    ),
    */
    
    'megatron_btn_dropdown' => array(
      'variables' => array(
        'links' => array(), 
        'attributes' => array(), 
        'type' => NULL
      ),
    ), 
  );
}


/** SANITIZE STRING FOR INJECTION 
---------------------------------------------------------- */
function megatron_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id'. $string;
  }
  return $string;
}


/** CHANGE DEFAULT META CONTENT-TYPE TAG TO HTML5 VERSION
---------------------------------------------------------- */
function megatron_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**Changes the search form to use the HTML5 "search" input attribute
---------------------------------------------------------- */
function megatron_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
}


/**
 * Override or insert variables into the page template for HTML output.
 */
function megatron_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function megatron_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
}


/** HTML.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function megatron_preprocess_html(&$vars) {
    // Classes for body element. Allows advanced theming based on context
    // (home page, node of certain type, etc.)
    if (!$vars['is_front']) {
      // Add unique class for each page.
      $path = drupal_get_path_alias($_GET['q']);
      // Add unique class for each website section.
      list($section, ) = explode('/', $path, 2);
      if (arg(0) == 'node') {
        if (arg(1) == 'add') {
          $section = 'node-add';
        }
        elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
          $section = 'node-' . arg(2);
        }
      }
      // add a body class that reflects content placement
      $vars['classes_array'][] = drupal_html_class('section-' . megatron_id_safe($section));
      $vars['classes_array'][] = drupal_html_class('path-' . megatron_id_safe($path));
    }
    // add a body class to tell us what colours we're using
    $vars['classes_array'][] = drupal_html_class('themecolour' . theme_get_setting('clf_clf_theme_new'));
   

     // Add js libraries and scripts
     $clfVerison = theme_get_setting('clf_clf_version');
     $options = array(
       'group' => JS_THEME,
     );
     
     drupal_add_js('//cdn.ubc.ca/clf/' . $clfVerison . '/js/ubc-clf.min.js', array('type' => 'external', 'group'=>JS_LIBRARY, 'weight' => 0));  
     
     $showSecondary = theme_get_setting('clf_secondarynavoption');
     if ($showSecondary) {
       drupal_add_css(path_to_theme('megatron') . '/css/secondary-nav.css', array('group' => CSS_THEME, 'weight' => 115, 'every_page' => TRUE, 'preprocess' => FALSE)); 
     }
     
     // Add CSS if layout is not default
     $clfLayout = theme_get_setting('clf_layout');
     //if (!empty($clfLayout)) {
     if (($clfLayout == '__full') || ($clfLayout == '__fluid')) {
       $vars['classes_array'][] = drupal_html_class('full-width');  
     }
     if ($clfLayout == '__fluid') {
       $vars['classes_array'][] = drupal_html_class('full-width-left');
         
     }
     
     // Add CSS for the Typography.com Whitney file
     $clfType = theme_get_setting('clf_type');
     if ($clfType == 'dev') {
       drupal_add_css('https://cloud.typography.com/6804272/697806/css/fonts.css', array('type' => 'external', 'group'=>CSS_SYSTEM, 'media'=> 'screen', 'every_page'=>TRUE, 'weight' => -10));   
     }
     if ($clfType == 'prod') {
       drupal_add_css('https://cloud.typography.com/6804272/781004/css/fonts.css', array('type' => 'external', 'group'=>CSS_SYSTEM, 'media'=> 'screen', 'weight' => -10)); 
     }
  }


/** BREADCRUMB ALTERATIONS
Return a themed breadcrumb trail
---------------------------------------------------------- */
function megatron_breadcrumb($variables) {
  global $base_path;
  $breadcrumb = $variables['breadcrumb'];
  $breadcrumb = array_unique($breadcrumb);
  $breadcrumb[0] = ''; 
  $show_breadcrumb = theme_get_setting('breadcrumb_display');
  $pos = FALSE;
    
  if ((!empty($breadcrumb)) && ($show_breadcrumb == 'yes')) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $crumbs = '<ul class="breadcrumb expand">';
    $crumbs .= '<li class="breadcrumb-home"><a href="' . $base_path . '">' . theme_get_setting('clf_unitname') . '</a></li>';
    
    $array_size = count($breadcrumb);
    $i = 0;
    while ( $i < $array_size) {
      if(drupal_get_title()) {
        $pos = strpos($breadcrumb[$i], drupal_get_title());
      }
      //we stop duplicates entering where there is a sub nav based on page jumps
      if ($pos === false){
        $crumbs .= '<li class="breadcrumb-' . $i;
        $crumbs .=  '">' . $breadcrumb[$i] . '<span class="divider">/</span></li> ';
      }
      $i++;
    }
    $crumbs .= '<li class="active">'. drupal_get_title() .'</li></ul>';
    return $crumbs;
  }
  return '';
}


/** NODE.TPL.PHP PREPROCESS VARIABLES 
stripe and add 'Unpublished' div.
---------------------------------------------------------- */
function megatron_preprocess_node(&$vars, $hook) {
  // Add a striping class. 
   $vars['classes_array'][] = 'node-' . $vars['zebra'];
  // Add 'node-unpublished' class to unpublished nodes. 
  if (!$vars['status']) {
    $vars['classes_array'][] = 'node-unpublished';
    $vars['unpublished'] = TRUE;
  }
  else {
    $vars['unpublished'] = FALSE;
  }
  if($vars['teaser']) {
      $vars['classes_array'][] = 'row-fluid';
  }
  // add node template suggestions for teasers!
  if($vars['view_mode'] == 'teaser') {
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->type . '__teaser';   
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->nid . '__teaser';
  }
}


/** BLOCK.TPL.PHP PREPROCESS VARIABLES 
stripe blocks, add custom tpl suggestion for primary content.
---------------------------------------------------------- */
function megatron_preprocess_block(&$variables, $hook) {
  // Add a striping class.
  $variables['classes_array'][] = 'block-' . $variables['zebra'];
  $variables['title_attributes_array']['class'][] = 'block-title';
}


/** BLOCK.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function megatron_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}


/** PAGE.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function megatron_preprocess_page(&$variables) {
  // Define CLF page elements in an include
  require_once('includes/template-ubc-clf-elements.inc');
  // Add template suggestions based on content type 
  if (isset($variables['node'])) {  
    //$variables['theme_hook_suggestions'][] = 'page' . theme_get_setting('clf_layout') . '';
    $variables['theme_hook_suggestions'][] = 'page__type__'. $variables['node']->type;
  }

  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second']) && !drupal_is_front_page()) {
    $variables['columns'] = 3;
  }
  elseif (!empty($variables['page']['sidebar_first']) && !drupal_is_front_page()) {
    $variables['columns'] = 2;
  }
  elseif (!empty($variables['page']['sidebar_second']) && !drupal_is_front_page()) {
    $variables['columns'] = 2;
  }
  elseif (!empty($variables['page']['sidebar_first']) && drupal_is_front_page()) {
    $variables['columns'] = 4;
  }
  else {
    $variables['columns'] = 1;
  }
  
  // Primary nav
  $variables['primary_nav'] = FALSE;
  if($variables['main_menu']) {
    // Build links
    $tree = menu_tree_page_data(variable_get('menu_main_links_source', 'main-menu'));
    $variables['main_menu'] = megatron_menu_navigation_links($tree);
    // Provide default theme wrapper function
    //$variables['mobile_nav']['#theme_wrappers'] = array('menu_tree__primary');
    
    // Build list
    $variables['primary_nav'] = theme('megatron_links', array(
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      ),
      'links' => $variables['main_menu'],
      'attributes' => array(
        'id' => 'main-menu',
        'class' => array('nav'),
      ),
      
    ));
  }
  
  
  // secondary nav
  $showSecondary = theme_get_setting('clf_secondarynavoption');
  $variables['secondary_nav'] = FALSE;
  if ($showSecondary) {
    if($variables['secondary_menu']) {
      // Build links
      $tree = menu_tree_page_data(variable_get('menu_secondary_links_source', 'user-menu'));
      $variables['secondary_menu'] = megatron_menu_navigation_links($tree);
      // Provide default theme wrapper function
      //$variables['mobile_nav']['#theme_wrappers'] = array('menu_tree__secondary');
      
      // Build list
      $variables['secondary_nav'] = theme('megatron_links', array(
        'heading' => array(
          'text' => t('Secondary menu'),
          'level' => 'h2',
          'class' => array('element-invisible'),
        ),
        'links' => $variables['secondary_menu'],
        'attributes' => array(
          'id' => 'secondary-menu',
          'class' => array('nav'),
        ),
        
      ));
    }
  }
  
  /*
  // Side nav
  $variables['side_nav'] = FALSE;
  if($variables['main_menu']) {
    // Build links
    $tree = menu_tree_page_data(variable_get('menu_main_links_source', 'main-menu'));
    $variables['main_menu'] = megatron_menu_navigation_links($tree);
    // Provide default theme wrapper function
    //$variables['mobile_nav']['#theme_wrappers'] = array('menu_tree__secondary');
    
    // Build list
    $variables['side_nav'] = theme('megatron_side_links', array(
      'heading' => array(
        'text' => t('Side menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      ),
      'links' => $variables['main_menu'],
      'attributes' => array(
        'id' => 'side-menu',
        'class' => array('accordion sidenav simple'),
      ),
      
    ));
  }
  */
  
  // Mobile nav
  $variables['mobile_nav'] = FALSE;
  if($variables['main_menu']) {
    // Build links
    $tree = menu_tree_page_data(variable_get('menu_main_links_source', 'main-menu'));
    $variables['main_menu'] = megatron_menu_navigation_links($tree);
    // Provide default theme wrapper function
    $variables['mobile_nav']['#theme_wrappers'] = array('menu_tree__primary');
    
    // Build list
    $variables['mobile_nav'] = theme('megatron_links', array(
      'links' => $variables['main_menu'],
      'attributes' => array(
        //'id' => 'main-menu',
        'class' => array('nav navbar-nav nav-pills'),
      ),
      'heading' => array(
        'text' => t('Mobile menu'),
        'class' => array('element-invisible'),
      ),
    ));
  }
  
  /*
  // Secondary nav
  $variables['secondary_nav'] = FALSE;
  if ($variables['secondary_menu']) {
    // Build links
    $variables['secondary_nav'] = menu_tree(variable_get('menu_secondary_links_source', 'user-menu'));
    // Provide default theme wrapper function
    $variables['secondary_nav']['#theme_wrappers'] = array('menu_tree__secondary');
  }
  */
}


/** BOOTSTRAP THEME FUNCTIONS USED */
/** Alter the span class for a region (main content / sidebars)
---------------------------------------------------------- */
function _megatron_content_span($columns = 1) {
  $class = FALSE;
  switch($columns) {
  case 1:
    // default (no sidebars)
    $class = 'span12';
    break;
  case 2:
    // 1 sidebar
    $class = 'span9';
    break;
  case 3:
    // 2 sidebars
    $class = 'span6';
    break;
  case 4:
    // front with 1 sidebar
    $class = 'span8';
    break;
  }
  return $class;
}


function megatron_theme_get_info($setting_name, $theme = NULL) {
// If no key is given, use the current theme if we can determine it.
  if (!isset($theme)) {
    $theme = !empty($GLOBALS['theme_key']) ? $GLOBALS['theme_key'] : '';
  }

  $output = array();

  if ($theme) {
    $themes = list_themes();
    $theme_object = $themes[$theme];

    // Create a list which includes the current theme and all its base themes.
    if (isset($theme_object->base_themes)) {
      $theme_keys = array_keys($theme_object->base_themes);
      $theme_keys[] = $theme;
    }
    else {
      $theme_keys = array($theme);
    }
    foreach ($theme_keys as $theme_key) {
      if (!empty($themes[$theme_key]->info[$setting_name])) {
        $output[$setting_name] = $themes[$theme_key]->info[$setting_name];
      }
    }
  }
  
  return $output;
}


/** THEME MEGATRON MAIN MENU LINKS
Returns navigational links based on a menu tree */
function megatron_menu_navigation_links($tree, $lvl = 0) {
  $result = array();
  
  if (count($tree) > 0) {  
    foreach ($tree as $id => $item) {
    
      // Only work with enabled links
      if (empty($item['link']['hidden'])) {
        $class = '';
        // add active-trail
        if ($item['link']['in_active_trail']) {
          $class = ' active-trail ';
        }
        // add class based on link title
        $classtwo = 'menu-item-' . megatron_id_safe($item['link']['title']);
        $new_item = array(
          'title' => $item['link']['title'],
          'link_path' => $item['link']['link_path'],
          'href' => $item['link']['href'],
        );
    	  
    	  // Don't use levels deeper than 1
    	  if($lvl < 1) {
    		  $new_item['below'] = megatron_menu_navigation_links($item['below'], $lvl+1);
    	  }
    	  $result['menu-'. $item['link']['mlid'] . $class . ' ' .$classtwo] = $new_item;
    	}
    }
  }
  return $result;
}


/** OTHER THEME FUNCTIONS
---------------------------------------------------------- */

/** Preprocess function for theme_megatron_btn_dropdown
adds classes to dropdown menus */
function megatron_preprocess_megatron_btn_dropdown(&$variables) {
  // Add default class
  $variables['attributes']['class'][] = 'btn-group';
  
  // Check if its a array of links so we need to theme it first here.
  if(is_array($variables['links'])) {
	$variables['links'] = theme('links', array(
	  'links' => $variables['links'],
	  'attributes' => array(
		'class' => array('dropdown-menu'),
	  ),
	));
  }
}  


/** theme_megatron_btn_dropdown
changes link to toggle and adds toggle graphic
---------------------------------------------------------- */
function megatron_megatron_btn_dropdown($variables) {
  $type_class = '';
  
  // Type class
  if(isset($variables['type'])) {
	  $type_class = ' btn-'. $variables['type'];
  }
  
  // Start markup
  $output = '<div'. drupal_attributes($variables['attributes']) .'>';
  
  // Add as string if its not a link
  if(is_array($variables['label'])) {
	  $output .= l($variables['label']['title'], $$variables['label']['href'], $variables['label']);
  }
  
  $output .= '<a class="btn '. $type_class .' dropdown-toggle" data-toggle="dropdown" href="#">';
  
  // Its a link so create one
  if(is_string($variables['label'])) {
	  $output .= check_plain($variables['label']);
  }
  
  // Finish markup 	
  $output .= '
  <div class="ubc7-arrow down-arrow"></div>
	</a>
	' . $variables['links'] . '
  </div>';
  
  return $output;
}  


/** THEME MENU UNORDERED LIST MARKUP
theme all sets of links
-- you can override this for specific menus with megatron_menu_tree__menu_name
---------------------------------------------------------- */
function megatron_menu_tree(&$variables) {
  return '<ul class="menu nav bootstrap-sidenav">' . $variables['tree'] . '</ul>';
}

/**
 * Bootstrap theme wrapper function for the primary menu links
 */
function megatron_menu_tree__primary(&$variables) {
  return '<ul class="nav navbar-nav nav-pills">' . $variables['tree'] . '</ul>';
}

/**
 * Bootstrap theme wrapper function for the secondary menu links
 */
function megatron_menu_tree__secondary(&$variables) {
  return '<ul class="nav nav-pills">' . $variables['tree'] . '</ul>';
}

function megatron_menu_link(array $variables) {
  // remove some default drupal menu classes
  /*$remove = array('leaf', 'expanded', 'collapsed', 'expandable');
    if($remove){
     $variables['element']['#attributes']['class'] = array_diff($variables['element']['#attributes']['class'],$remove);
  }*/
  
    $element = $variables['element'];
    $sub_menu = '';
    
    if ($element['#below']) {
        $sub_menu = drupal_render($element['#below']);
    }
    
    $element['#attributes']['class'][] = 'menu-item-' . megatron_id_safe($element['#title']);
    $element['#attributes']['id'] = 'mid-' . $element['#original_link']['mlid'];
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
      return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  }
  


/** TABS 
ZEN TABS (also see custom styles in stylesheet)
Customize the PRIMARY and SECONDARY LINKS, to allow the admin tabs to work on all browsers
---------------------------------------------------------- */
function megatron_menu_local_task($variables) {
  $link = $variables['element']['#link'];
  $link['localized_options']['html'] = TRUE;
  return '<li' . (!empty($variables['element']['#active']) ? ' class="active"' : '') . '>' . l('<span class="tab">' . $link['title'] . '</span>', $link['href'], $link['localized_options']) . "</li>\n";
}

//  Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
function megatron_menu_local_tasks() {
  $output = array();
  if ($primary = menu_primary_local_tasks()) {
    if(menu_secondary_local_tasks()) {
      $primary['#prefix'] = '<ul class="tabs primary with-secondary clearfix">';
    }
    else {
      $primary['#prefix'] = '<ul class="tabs primary clearfix">';
    }
    $primary['#suffix'] = '</ul>';
    $output[] = $primary;
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $secondary['#prefix'] = '<ul class="tabs secondary clearfix">';
    $secondary['#suffix'] = '</ul>';
    $output[] = $secondary;
  }
  return drupal_render($output);
}


/** FORMS
Implements hook_form_alter().
---------------------------------------------------------- */
function megatron_form_alter(&$form, &$form_state, $form_id) {
  // Customize the search block form
  
  if ($form_id == 'search_block_form') {
  	//dpm($form); // print the messages
  	$form['#attributes']['class'][] = 'form-inline input-append';
    //$form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#attributes']['title'] = t('enter your search terms...');
    $form['search_block_form']['#attributes']['placeholder'] = t('Enter your search terms...');
    $form['search_block_form']['#attributes']['class'][] = 'nomargin';
    $form['search_block_form']['#theme_wrappers'] = NULL;
    //$form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    //$form['search_block_form']['#size'] = 40;  // define size of the textfield
    //$form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield
    $form['actions']['#theme_wrappers'] = NULL; // remove the div around the button
    $form['actions']['submit']['#value'] = t('Go'); // Change the text on the submit button
    //$form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');
    
    // Add extra attributes to the text box
    //$form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search';}";
    //$form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
    // Prevent user from searching the default text
    //$form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='Search'){ alert('Please enter a search'); return false; }";
  }
  if ($form_id == 'search_form') {
  	dpm($form); // print the messages
  	//$form['#attributes']['class'][] = '';
    $form['basic']['#attributes']['class'][] = 'form-inline input-append clearfix'; 
    $form['advanced']['#title'] =  t('Refine your search'); 
    //$form['advanced']['#type'] =  'accordion'; 
    $form['actions']['submit']['#value'] = t('Go'); // Change the text on the submit button
    //$form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');
    
    // Add extra attributes to the text box
    //$form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search';}";
    //$form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
    // Prevent user from searching the default text
    //$form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='Search'){ alert('Please enter a search'); return false; }";
  }
}  

/** Returns HTML for a form element.
---------------------------------------------------------- */
/*
function megatron_form_element(&$variables) {
  $element = &$variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before',
  );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }

  // Add bootstrap class
  $attributes['class'] = array('control-group');

  // Check for errors and set correct error class
  if (isset($element['#parents']) && form_get_error($element)) {
    $attributes['class'][] = 'error';
  }

  if (!empty($element['#type'])) {
    $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
  }
  if (!empty($element['#name'])) {
    $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
  }
  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }
  $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
  $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';

  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= '<div class="controls">';
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;

    case 'after':
      $output .= '<div class="controls">';
      $variables['#children'] = ' ' . $prefix . $element['#children'] . $suffix;
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;

    case 'none':
    case 'attribute':
      // Output no label and no required marker, only the children.
      $output .= '<div class="controls">';
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
  }

  if ( !empty($element['#description']) ) {
    $output .= '<p class="help-block">' . $element['#description'] . "</p>\n";
  }

  $output .= "</div></div>\n";

  return $output;
}
*/

/** Returns HTML for a form element label and required marker.
---------------------------------------------------------- */
/*
function megatron_form_element_label(&$variables) {
  $element = $variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // If title and required marker are both empty, output no label.
  if ((!isset($element['#title']) || $element['#title'] === '') && empty($element['#required'])) {
    return '';
  }

  // If the element is required, a required marker is appended to the label.
  $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '';

  $title = filter_xss_admin($element['#title']);

  $attributes = array();
  // Style the label as class option to display inline with the element.
  if ($element['#title_display'] == 'after') {
    $attributes['class'][] = 'option';
    $attributes['class'][] = $element['#type'];
  }
  // Show label only to screen readers to avoid disruption in visual flows.
  elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'][] = 'element-invisible';
  }

  if (!empty($element['#id'])) {
    $attributes['for'] = $element['#id'];
  }

  // @Bootstrap: Add Bootstrap control-label class.
  $attributes['class'][] = 'control-label';

  // @Bootstrap: Insert radio and checkboxes inside label elements.
  $output = '';
  if ( isset($variables['#children']) ) {
    $output .= $variables['#children'];
  }

  // @Bootstrap: Append label
  $output .= $t('!title !required', array('!title' => $title, '!required' => $required));

  // The leading whitespace helps visually separate fields from inline labels.
  return ' <label' . drupal_attributes($attributes) . '>' . $output . "</label>\n";
} */


/** BUTTONS
---------------------------------------------------------- */

/** Preprocessor for theme('button').
---------------------------------------------------------- */
function megatron_preprocess_button(&$vars) {
  $vars['element']['#attributes']['class'][] = 'btn';

  if (isset($vars['element']['#value'])) {
    $classes = array(
      //specifics
      t('Save and add') => 'btn-info',
      t('Add another item') => 'btn-info',
      t('Add effect') => 'btn-primary',
      t('Add and configure') => 'btn-primary',
      t('Update style') => 'btn-primary',
      t('Download feature') => 'btn-primary',

      //generals
      t('Save') => 'btn-primary',
      t('Apply') => 'btn-primary',
      t('Create') => 'btn-primary',
      t('Confirm') => 'btn-primary',
      t('Submit') => 'btn-secondary',
      t('Export') => 'btn-primary',
      t('Import') => 'btn-primary',
      t('Restore') => 'btn-primary',
      t('Rebuild') => 'btn-primary',
      t('Search') => 'btn-secondary',
      t('Add') => 'btn-info',
      t('Update') => 'btn-info',
      t('Delete') => 'btn-danger',
      t('Remove') => 'btn-danger',
    );
    foreach ($classes as $search => $class) {
      if (strpos($vars['element']['#value'], $search) !== FALSE) {
        $vars['element']['#attributes']['class'][] = $class;
        break;
      }
    }
  }
}

/** Implements theme_button().
---------------------------------------------------------- */
function megatron_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));
  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  $element['#attributes']['class'][] = 'btn';
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
  // Add a btn-primary class if submit button.
  if (isset($element['#parents']) && ($element['#parents'][0] == 'submit')) {
    $element['#attributes']['class'][] = 'btn-secondary';
  }
 return '<input' . drupal_attributes($element['#attributes']) . ' />';
}


/** PAGER */
// REMOVED AS WAS CAUSING VIEWS AJAX FORM ERROR - JOTOOLE - NOV7/13
/* Returns HTML for a query pager.
 *
 * Menu callbacks that display paged query results should call theme('pager') to
 * retrieve a pager control so that users can view other results. Format a list
 * of nearby pages with additional query results.
 *
 * @param $vars
 *   An associative array containing:
 *   - tags: An array of labels for the controls in the pager.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *   - quantity: The number of pages in the list.
 *
 * @ingroup themeable
 */
/*function megatron_pager($variables) {
  $output = "";
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }

  // End of generation loop preparation.
  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    //if ($li_first) {
    //  $items[] = array(
    //    'class' => array('pager-first'), 
    //    'data' => $li_first,
    //  );
    //}
    if ($li_previous) {
      $items[] = array(
        'class' => array('prev'), 
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'), 
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
           // 'class' => array('pager-item'), 
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('active'), // Add the active class 
            'data' => l($i, '#', array('fragment' => '','external' => TRUE)),
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            //'class' => array('pager-item'), 
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'), 
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('next'), 
        'data' => $li_next,
      );
    }
    //if ($li_last) {
    //  $items[] = array(
    //    'class' => array('pager-last'), 
    //    'data' => $li_last,
    //  );
    //}

    return '<div class="pagination">'. theme('item_list', array(
      'items' => $items, 
      //'attributes' => array('class' => array('pager')),
    )) . '</div>';
  }
  
  return $output;
}*/

/** TABLES */
/** Add Bootstrap table class to tables added by Drupal
---------------------------------------------------------- */
function megatron_preprocess_table(&$variables) {
  if(!isset($variables['attributes']['class'])) {
    $variables['attributes']['class'] = array('table', 'table-striped');
  }
  else {
    $variables['attributes']['class'][] = 'table';
    $variables['attributes']['class'][] = 'table-striped';
  }
}

/** VIEWS
Provides views theme override functions for Bootstrap themes.

Add Bootstrap table class to views tables.
---------------------------------------------------------- */
function megatron_preprocess_views_view_table(&$vars) {
  $vars['classes_array'][] = 'table';
}

function megatron_preprocess_views_view_grid(&$vars) {
  $vars['class'] .= ' table';
}


/** STATUS MESSAGES
Returns HTML for status and/or error messages, grouped by type.
---------------------------------------------------------- */
function megatron_status_messages($vars) {
  $display = $vars['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
  );
  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= "<div class=\"alert alert-block alert-$type\">\n";
    $output .= "  <a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>\n";
    if (!empty($status_heading[$type])) {
      $output .= '<h4 class="alert-heading">' . $status_heading[$type] . "</h4>\n";
    }
    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
  }
  return $output;
}


/** EXCLUDE CSS
Allow css files to be excluded in the .info file
---------------------------------------------------------- */
function megatron_css_alter(&$css) {
  $excludes = _megatron_alter(megatron_theme_get_info('exclude'), 'css');
  $css = array_diff_key($css, $excludes);
}


/** REPLACE CORE jQUERY
Replace jQuery with updated version
---------------------------------------------------------- */
function megatron_js_alter(&$javascript) {
  // Swap out jQuery to use an external version of the library (a requirement of the Twitter Bootstrap framework).
  //$clf_jqueryoption = theme_get_setting('clf_jqueryoption');
  //if (empty($clf_jqueryoption)) {
  if (module_exists('jquery_update')) {
        
  }
  else {
  	$javascript['misc/jquery.js']['data'] = '//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js';
  	$javascript['misc/jquery.js']['type'] = 'external';
  	$javascript['misc/jquery.js']['group'] = JS_LIBRARY; 
  	$javascript['misc/jquery.js']['weight'] = -100; 
  	//$javascript['misc/jquery.js']['scope'] = 'footer'; 
  	$javascript['misc/jquery.js']['version'] = '1.8.1'; 
  }
}


function _megatron_alter($files, $type) {
  $output = array();
  
  foreach($files as $key => $value) {
    if(isset($files[$key][$type])) {
	  foreach($files[$key][$type] as $file => $name) {
		  $output[$name] = FALSE;
	  }
    }
  }
  return $output;
}





/** Returns HTML for a set of links.
---------------------------------------------------------- */
function megatron_megatron_links($variables) {

  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];

  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';
    
    
    // Treat the heading first if it is present to prepend it to the list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading. 
          //'level' => 'li',
        );
      }
      $output .= '<h3';
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</h3>';
    }
    
    $output .= '<ul' . drupal_attributes($attributes) . '>';
    
    $num_links = count($links);
    $i = 1;

	
    foreach ($links as $key => $link) {
      $children = array();
      if(isset($link['below']))
      $children = $link['below'];
      
	    $attributes = array('class' => array($key));
	  
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
           && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $attributes['class'][] = 'active';
      }
	    if(count($children) > 0) {
		    $attributes['class'][] = 'dropdown';
		    $link['attributes']['class'][] = 'btn';
      }
	    
  	  if(!isset($link['attributes']))
  		$link['attributes'] = array();
  	  $class = (count($children) > 0) ? 'dropdown' : NULL;
  	  $output .= '<li ' . drupal_attributes($attributes) . '>';
	  
	    
  	  if (isset($link['href'])) {
  		  if(count($children) > 0) { 
  		    $link['html'] = TRUE;
  		    $output .=  '<div class="btn-group">' .l($link['title'], $link['href'], $link);
  		    $output .=  '<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="ubc7-arrow blue down-arrow"></span></button>';
  		  }else{
  		    // Pass in $link as $options, they share the same keys.
  		    $output .= l($link['title'], $link['href'], $link);
  		  }
  	  }
  	  elseif (!empty($link['title'])) {
  	   // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
  	   if (empty($link['html'])) {
  		   $link['title'] = check_plain($link['title']);
  	   }
  	   $span_attributes = '';
  	   if (isset($link['attributes'])) {
  		   $span_attributes = drupal_attributes($link['attributes']);
  	   }
	     $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
     }
	  	  
	  if(count($children) > 0) {
		  $attributes = array();
      $attributes['class'] = array('dropdown-menu');
		  $output .= theme('megatron_links', array('links' => $children, 'attributes' => $attributes));
		  $output .= '</div>';
	  }
	  
	  $output .= "</li>\n";	
    }

    $output .= '</ul>';
  }
  //if(count($children) > 0) {
 //   $output .= '</div>';
 // }

  return $output;
} 


/**
 * Returns HTML for a set of links for all menus using the dropdown toggles. This is used for the Mobile Nav
 */
 /*
function megatron_megatron_mobile_links(array $variables) {
  
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';
    
    // Treat the heading first if it is present to prepend it to the list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading. 
          //'level' == 'h3',
        );
      }
      $output .= '<h3';
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</h3>';
    }
    
    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $children = array();
      if (isset($link['below'])) {
        $children = $link['below'];
      }

      $attributes = array('class' => array($key));

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $attributes['class'][] = 'first';
      }
      if ($i == $num_links) {
        $attributes['class'][] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
        && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $attributes['class'][] = 'active';
      }
      
      if (count($children) == 0) {
        $attributes['class'][] = 'nokids';
        // removed so it doesn't turn the link into an unclickable toggle
        //$link['attributes']['data-toggle'] = 'dropdown';
        //$link['attributes']['class'][] = 'dropdown-toggle';
      }

      if (count($children) > 0) {
        $attributes['class'][] = 'with-dropdown';
        // removed so it doesn't turn the link into an unclickable toggle
        //$link['attributes']['data-toggle'] = 'dropdown';
        //$link['attributes']['class'][] = 'dropdown-toggle';
      }

      if (!isset($link['attributes'])) {
        $link['attributes'] = array();
      }

      $link['attributes'] = array_merge($link['attributes'], $attributes);

      $output .= '<li' . drupal_attributes($attributes) . '>';

      if (isset($link['href'])) {
        if (count($children) > 0) {
          $link['html'] = TRUE;
          $output .=  '<div class="btn-group btn-block" role="group"><button class="btn btn-mobilenav dropdown-toggle col-ss-2" aria-expanded="false"><span class="icon-plus"></span></button><button type="button" class="btn btn-mobilenav col-ss-10">' .l($link['title'], $link['href'], $link) . '</button></div>';
        }
        else {
          // Pass in $link as $options, they share the same keys.
          $output .= '<button class="btn btn-mobilenav btn-block">' . l($link['title'], $link['href'], $link) . '</button>';
        }
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }

        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;

      if(count($children) > 0) {
        $attributes = array();
        $attributes['class'] = array('dropdown-menu');

        $output .= theme('megatron_mobile_links', array('links' => $children, 'attributes' => $attributes));
        //$output .= '</div>';
      }

      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}
*/

/** MEGATRON TEST LINKS 
Sidenav Render
---------------------------------------------------------- */
/*
function megatron_megatron_side_links($variables) {

  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];

  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';
    
    
    // Treat the heading first if it is present to prepend it to the list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading. 
          //'level' => 'li',
        );
      }
      $output .= '<h3';
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</h3>';
    }
    
    $output .= '<ul' . drupal_attributes($attributes) . '>';
    
    $num_links = count($links);
    $i = 1;

	
    foreach ($links as $key => $link) {
      $children = array();
      if(isset($link['below']))
      $children = $link['below'];
      
	    $attributes = array('class' => array($key));
	  
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
           && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $attributes['class'][] = 'active';
      }
	    if(count($children) > 0) {
		    $attributes['class'][] = 'dropdown';
		    $link['attributes']['class'][] = 'btn';
      }
	    
  	  if(!isset($link['attributes']))
  		$link['attributes'] = array();
  	  $class = (count($children) > 0) ? 'dropdown' : NULL;
  	  $output .= '<li ' . drupal_attributes($attributes) . '>';
	  
	    
  	  if (isset($link['href'])) {
  		  if(count($children) > 0) { 
  		    $link['html'] = TRUE;
  		    $output .=  '<div class="btn-group">' .l($link['title'], $link['href'], $link);
  		    $output .=  '<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="ubc7-arrow blue down-arrow"></span></button>';
  		  }else{
  		    // Pass in $link as $options, they share the same keys.
  		    $output .= l($link['title'], $link['href'], $link);
  		  }
  	  }
  	  elseif (!empty($link['title'])) {
  	   // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
  	   if (empty($link['html'])) {
  		   $link['title'] = check_plain($link['title']);
  	   }
  	   $span_attributes = '';
  	   if (isset($link['attributes'])) {
  		   $span_attributes = drupal_attributes($link['attributes']);
  	   }
	     $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
     }
	  	  
	  if(count($children) > 0) {
		  $attributes = array();
      $attributes['class'] = array('dropdown-menu');
		  $output .= theme('megatron_links', array('links' => $children, 'attributes' => $attributes));
		  $output .= '</div>';
	  }
	  
	  $output .= "</li>\n";	
    }

    $output .= '</ul>';
  }
  //if(count($children) > 0) {
 //   $output .= '</div>';
 // }

  return $output;
}
*/