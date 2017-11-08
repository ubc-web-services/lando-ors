<?php




/** HTML.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function sparc_preprocess_html(&$vars) {
  // add inline scripts at bottom of JS_THEME scope
  drupal_add_js('new WOW().init();',
    array('type' => 'inline', 'scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => 10)
  );
  // <meta name="google-site-verification" content="V6RspE18OsmO047VeleQS8PDZ-2zAYxgFNMXUW7Gw90" />
  $google_verification = array(
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => array(
        'content' =>  'V6RspE18OsmO047VeleQS8PDZ-2zAYxgFNMXUW7Gw90',
        'name' => 'google-site-verification',
      )
    );
    drupal_add_html_head($google_verification, 'google_verification');
}

/** OVERWRITE THE MEGATRON DEFAULT FUNCTION TO CONVERT TO BOOTSTRAP 3 MARKUP */
/** Alter the span class for a region (main content / sidebars)
---------------------------------------------------------- */
function _sparc_content_span($columns = 1) {
  $class = FALSE;
  switch($columns) {
  case 1:
    // default (no sidebars)
    $class = 'col-md-12';
    break;
  case 2:
    // 1 sidebar
    $class = 'col-md-9';
    break;
  case 3:
    // 2 sidebars
    $class = 'col-md-6';
    break;
  case 4:
    // front with 1 sidebar
    $class = 'col-md-8';
    break;
  }
  return $class;
}


/** BUTTONS
Implements theme_button().
---------------------------------------------------------- */
function sparc_button($variables) {
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
    $element['#attributes']['class'][] = 'btn-primary';
  }
  if (isset($element['#parents']) && ($element['#parents'][0] == 'reset')) {
    $element['#attributes']['class'][] = 'btn-secondary';
  }
 return '<input' . drupal_attributes($element['#attributes']) . ' />';
}


/** SEARCH FORM ALTERATIONS 
---------------------------------------------------------- */
function sparc_form_alter(&$form, &$form_state, $form_id) {
  // change these for all exposed views forms - we set specific form values in "nursing_form_views_exposed_form_alter"
  if ($form_id == 'views_exposed_form') {
    
    //$form['submit']['#attributes'] = array('class' => array('btn', 'btn-nursing', 'btn-nursing-alt')); 
    //$form['title']['#attributes']['placeholder'] = t('Search titles by keyword');
    //$form['created']['#attributes']['placeholder'] = t('Refine by publication date');
    //$form['combine']['#attributes']['placeholder'] = t('Search by keyword');
    //$form['keywords']['#attributes'] = array('class' => array('container-inline')); 
    //$form['keywords']['#prefix'] = ''; 
    //$form['keywords']['#suffix'] = ''; 
    $form['keywords']['#attributes']['placeholder'] = t('Enter some keywords');
    $form['keyword']['#attributes']['placeholder'] = t('Enter some keywords'); 
    $form['sponsor']['#attributes']['placeholder'] = t('Enter a sponsor name'); 
    //$form['keys']['#attributes']['placeholder'] = t('e.g. Research, Alumni, etc.');
    //$form['name']['#attributes']['placeholder'] = t('e.g. Jane Doe');
    // define our view and view displays for specific views
    //$view = $form_state['view'];
    //if ($view->name == 'news_stories_listing' && $view->current_display == ("views-exposed-form-news-stories-listing-page-2" || "views-exposed-form-content-search-page-5")) {
      //$form['submit']['#attributes'] = array('class' => array('btn', 'btn-nursing', 'btn-nursing-alt')); 
      //$form['title']['#attributes']['placeholder'] = t('Search title keywords');
      //$form['created']['#attributes']['placeholder'] = t('Refine by date');
    //}
  }
}




/*
// add classes to views tables
function sparc_preprocess_views_view_table(&$vars) {
  $vars['classes_array'][] = 'table table-hover';
}
*/

/** Return the UBC CLF visual identity footer
 *  Overrides shortened Unit Name saved in database with full unit name
---------------------------------------------------------- */
function sparc_ubc_clf_visual_identity_footer($variables) {
    $clf_layout = theme_get_setting('clf_layout');
    $containerstart = '';
    $containerend = '';
    $unit_name = 'UBC Support Programs to Advance Research Capacity';

    if (($clf_layout == '__full') || ($clf_layout == '__fluid')) {
        $containerstart = '<div class="container">';
        $containerend = '</div>';
    }
    $output = '<div id="ubc7-unit-footer" class="row-fluid expand">';
    $output .= $containerstart;
    $output .= '<div class="span12 unit-signature"><a class="faculty-identifier" href="/"><object type="image/svg+xml" data="' . base_path() . drupal_get_path('theme', 'sparc') . '/img/Unit_Signature.svg" class="signature">' . $unit_name . '</object></a><p>Part of the <a href="https://research.ubc.ca" target="_blank">VP Research &amp; Innovation</a> portfolio</p></div>';
    $output .= $containerend;
    $output .= $containerstart;
   $output .= '<div class="row-fluid"><div class="span10" id="ubc7-unit-address">'; 
    $output .= '<div class="ubc7-address-unit-name"<strong>Office of Research Services</strong></div>' . theme_get_setting('clf_campus') . '';
    if (theme_get_setting('clf_faculty')) {
        $output .= '<div class="ubc7-address-faculty-name">' . theme_get_setting('clf_faculty_name') . '</div>'; }
    $output .= '<div class="ubc7-address-street">' . theme_get_setting('clf_streetaddr') . '</div>';
    $output .= '<div class="ubc7-address-location">';
    $output .= '<span class="ubc7-address-city">' . theme_get_setting('clf_locality') . '</span>';
    if (theme_get_setting('clf_locality') && theme_get_setting('clf_region')) {
        $output .= ',';
    }
    $output .= ' <span class="ubc7-address-province" title="' . theme_get_setting('clf_region') . '">' . theme_get_setting('clf_region') . '</span> ';
    $output .= '<span class="ubc7-address-country">' . theme_get_setting('clf_country') . '</span> ';
    $output .= '<span class="ubc7-address-postal">' . theme_get_setting('clf_postal') . '</span>';
    $output .= '</div>';
    if (theme_get_setting('clf_telephone')) {
        $output .= '<div class="ubc7-address-phone">Tel ' . theme_get_setting('clf_telephone') . '</div>';
    }
    if (theme_get_setting('clf_fax')) {
        $output .= '<div class="ubc7-address-fax">Fax ' . theme_get_setting('clf_fax') . '</div>';
    }
    if (theme_get_setting('clf_email')) {
        $output .= '<div class="ubc7-address-email">E-mail <a href="mailto:' . theme_get_setting('clf_email') . '">' . theme_get_setting('clf_email') . '</a></div>';
    }
    if (theme_get_setting('clf_website')) {
        $output .= '<div class="ubc7-address-website">Website <a href="http://' . theme_get_setting('clf_website') . '" title="' . theme_get_setting('clf_unitname') . '">' . theme_get_setting('clf_website') . '</a></div>';
    }
    $output .= '<p class="footer-credits">UBC receives support for managing its research enterprise from the federal <a href="https://research.ubc.ca/support-resources/indirect-costs-budgeting-finance/federal-research-support-fund" target="_blank" title="Federal Research Support Fund">Research Support Fund</a>.</p></div>';
    if (theme_get_setting('clf_social_facebook') || theme_get_setting('clf_social_twitter') || theme_get_setting('clf_social_linkedin') || theme_get_setting('clf_social_googleplus') || theme_get_setting('clf_social_youtube'))  {
        $output .= '<div class="span2"><strong>Find us on</strong><div id="ubc7-unit-social-icons">';
        if (theme_get_setting('clf_social_facebook')) {
            $output .= '<a href="' . theme_get_setting('clf_social_facebook') . '"><i class="icon-facebook-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_twitter')) {
            $output .= '<a href="' . theme_get_setting('clf_social_twitter') . '"><i class="icon-twitter-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_linkedin')) {
            $output .= '<a href="' . theme_get_setting('clf_social_linkedin') . '"><i class="icon-linkedin-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_googleplus')) {
            $output .= '<a href="' . theme_get_setting('clf_social_googleplus') . '"><i class="icon-google-plus-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_youtube')) {
            $output .= '<a href="' . theme_get_setting('clf_social_youtube') . '"><i class="icon-youtube"></i></a>&nbsp;';
        }
        $output .= '</div></div>';
    }
    else { $output .= ''; }
    $output .= $containerend;
    $output .= '</div><div class="row-fluid expand ubc7-back-to-top">';
    $output .= $containerstart;
    $output .= '<div class="span2">
          <a href="#" title="Back to top">Back to top <div class="ubc7-arrow up-arrow grey"></div></a>
        </div>';
    $output .= $containerend;
    $output .= '</div>';
    return $output;
}

/** BREADCRUMB ALTERATIONS
Return a themed breadcrumb trail
---------------------------------------------------------- */
function sparc_breadcrumb($variables) {
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
                $crumbs .=  '">' . decode_entities($breadcrumb[$i]) . '<span class="divider">/</span></li> ';
            }
            $i++;
        }
        $title = drupal_get_title();
        $crumbs .= '<li class="active">'. decode_entities($title) .'</li></ul>';
        return $crumbs;
    }
    return '';
}


function sparc_megatron_links($variables) {

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
                // TODO -- need to find out if applying href = true to all links here will be an issue, this fixes the problem with using <em> for break marker
                $link['html'] = TRUE;
                $rendered_link = l($link['title'], $link['href'], $link);

                if(count($children) > 0) {
                    $output .=  '<div class="btn-group">' .$rendered_link;
                    $output .=  '<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="ubc7-arrow blue down-arrow"></span></button>';
                }else{
                    // Pass in $link as $options, they share the same keys.
                    $output .= $rendered_link;
                }
            }
            elseif (!empty($link['title'])) {
                // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
                if (empty($link['html'])) {
                    $link['title'] = check_plain($link['title']);
                    //$link['title'] = html_entity_decode($link['title']."**");
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

