<?php

require_once "constants.php";

/*function get_template() {
	$path = explode('/',str_replace('-','__',$_GET['q']));	
	if($path[0] == 'node'){
		$_nid = $path[1];
		$_node = node_load($_nid);
		if($_node->field_template) { 
			return $_node->field_template['und'][0]['value'];
		} else {
			return 'default';
		}		
	} else {
		return 'default';
	}
}*/

function holycrosshospital_breadcrumb($variables) {
	$breadcrumb = $variables['breadcrumb'];
	unset($breadcrumb[0]);
	if (!empty($breadcrumb)) {
		$output = '<!-- breadcrumbs --><ul class="breadcrumbs">';	
		$output .= '<li>'. implode('</li><li>', $breadcrumb) .'</li>';
		$path = explode('/',$_GET['q']);	
		if($path[0] == 'node'){
			$_nid = $path[1];
			$_node = node_load($_nid);
			if(is_object($_node)) {
			  $output .= '<li>'. htmlspecialchars($_node->title) .'</li>';
			}
		}
		$output .= '</ul>';	
		return $output;
	}
}

function holycrosshospital_breadcrumbs_block($breadcrumbs) {
	if(drupal_is_front_page()) {
		$output = '<!-- breadcrumbs --><ul class="breadcrumbs"><li>Home</li></ul>';
		return $output; 
	} else {
		$output = '<!-- breadcrumbs --><ul class="breadcrumbs">';	
		$output .= '<li>'. implode('</li><li>', $breadcrumbs) .'</li>';
		$path = explode('/',$_GET['q']);	
		if($path[0] == 'node'){
			$_nid = $path[1];
			$_node = node_load($_nid);
			if(is_object($_node)) {
			  $output .= '<li>'. htmlspecialchars($_node->title) .'</li>';
			}
		}
		$output .= '</ul>';	
		return $output; 
	}
}

function holycrosshospital_preprocess_field(&$vars) {
	
  if($vars['element']['#field_name'] == 'field_youtubecode') {
		$prepend='<div class="video-holder"><div class="video"><iframe title="'.drupal_get_title().'" width="420" height="312" src="https://www.youtube.com/embed/';
		$append='?wmode=transparent&amp;rel=0" frameborder="0" allowfullscreen>Video gallery showcasing physician, events, and medical advancements at Holy Cross Hospital in Fort Lauderdale.</iframe></div></div>';
      //kpr($vars);Uncomment to output the $vars array.
			if($vars['element']['#items']['0']['value'] != ''){
        $vars['items']['0']['#markup']=$prepend.$vars['element']['#items']['0']['value'].$append;
			}
  return;
  }
	if($vars['element']['#field_name'] == 'field_youtubetitle') {
		$prepend='<h3><strong>';
		$append='</strong></h3>';
      //kpr($vars);Uncomment to output the $vars array.
			if($vars['element']['#items']['0']['value'] != ''){
        $vars['items']['0']['#markup']=$prepend.$vars['element']['#items']['0']['value'].$append;
			}
  return;
  }
}

/*function holycrosshospital_preprocess_maintenance_page(&$vars) {
	holycrosshospital_preprocess_html($vars);
}*/

/*function holycrosshospital_preprocess_page(&$vars) {
	$vars['tabs2'] = array(
		'#theme' => 'menu_local_tasks',
		'#secondary' => $vars['tabs']['#secondary'],
	);
	unset($vars['tabs']['#secondary']);

	if (isset($vars['main_menu'])) {
		$vars['primary_nav'] = theme('links__system_main_menu', array(
			'links' => $vars['main_menu'],
			'attributes' => array(
				'class' => array('links', 'inline', 'main-menu'),
			),
			'heading' => array(
				'text' => t('Main menu'),
				'level' => 'h2',
				'class' => array('element-invisible'),
			)
		));
	} else {
		$vars['primary_nav'] = FALSE;
	}
	if (isset($vars['secondary_menu'])) {
		$vars['secondary_nav'] = theme('links__system_secondary_menu', array(
			'links' => $vars['secondary_menu'],
			'attributes' => array(
				'class' => array('links', 'inline', 'secondary-menu'),
			),
			'heading' => array(
				'text' => t('Secondary menu'),
				'level' => 'h2',
				'class' => array('element-invisible'),
			)
		));
	} else {
		$vars['secondary_nav'] = FALSE;
	}

	$site_fields = array();
	if (!empty($vars['site_name'])) {
		$site_fields[] = $vars['site_name'];
	}
	if (!empty($vars['site_slogan'])) {
		$site_fields[] = $vars['site_slogan'];
	}
	$vars['site_title'] = implode(' ', $site_fields);
	if (!empty($site_fields)) {
		$site_fields[0] = '<span>' . $site_fields[0] . '</span>';
	}
	$vars['site_html'] = implode(' ', $site_fields);
	$slogan_text = $vars['site_slogan'];
	$site_name_text = $vars['site_name'];
	$vars['site_name_and_slogan'] = $site_name_text . ' ' . $slogan_text;
	if(!empty($vars['node'])){
		$vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type.'__single';
	}	
	$path = explode('/',str_replace('-','__',$_GET['q']));	
	$vars['theme_hook_suggestions'][] = 'page__'. implode('__',$path);
	if($path[0] == 'node'){
		$_nid = $path[1];
		$_node = node_load($_nid);
		if($_node->field_template && $_node->field_template['und'][0]['value'] != 'default') { 
			$vars['theme_hook_suggestions'][] = 'page__'. $_node->field_template['und'][0]['value'];
		}		
	}
}*/

function holycrosshospital_preprocess_page(&$vars) {
	if(isset($_GET['page']) && $_GET['page'] != '') {
			$myPage = $_GET['page'];
			$output = intval($myPage)+1;
			$newTitle = drupal_get_title();
			//drupal_set_title($newTitle.' - Page '.$output);
			$vars['node']->title = $newTitle.' - Page '.$output;
	}

	if (isset($vars['node']->type) && $vars['node']->type=='video_gallery') {
	    $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
	}
}

function holycrosshospital_preprocess_html(&$vars) {
	if(isset($_GET['page']) && $_GET['page'] != '') {
			$myPage = $_GET['page'];
			$output = intval($myPage)+1;
			$newTitle = $vars['head_title'];
			$vars['head_title'] = $newTitle.' - Page '.$output;
	  }

	// Custom code to check and set the SEO for pages.
  	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
        $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $main_url = $protocol.$domainName.$requestUri;

    //Get the info of the matching custom meta tags
    $custommetatags_info = db_select('custommetatags_table', 'cp')
        ->fields('cp')
        ->condition('cp.page_url',$main_url)
        ->execute()
        ->fetchObject();

    if($custommetatags_info){
        $vars['head_title'] = $custommetatags_info->site_title;
        drupal_set_title($custommetatags_info->site_title);

         //Set meta description and meta keywords in our custom pages
        $description = array(
            '#type' => 'html_tag',
            '#tag' => 'meta',
            '#attributes' => array(
                'name' => 'description',
                'content' => $custommetatags_info->meta_desc,
            )
        );

        $keywords = array(
            '#type' => 'html_tag',
            '#tag' => 'meta',
            '#attributes' => array(
                'name' => 'keywords',
                'content' => $custommetatags_info->meta_key,
            )
        );

        $abstract = array(
            '#type' => 'html_tag',
            '#tag' => 'meta',
            '#attributes' => array(
                'name' => 'abstract',
                'content' => $custommetatags_info->abstract,
            )
        );

        drupal_add_html_head($description, 'description');
        drupal_add_html_head($keywords, 'keywords');
        drupal_add_html_head($abstract, 'abstract');

        $vars['node']->title = $custommetatags_info->site_title;
        $vars['node']->metatags['und']['title']['value'] = $custommetatags_info->site_title;
        $vars['node']->workbench_moderation['published']->title = $custommetatags_info->site_title;
        $vars['node']->workbench_moderation['my_revision']->title = $custommetatags_info->site_title;
    }
}



/**
 * Implementation of hook_preprocess_node
 * sets theme suggestion based on type of content being rendered
*/
/*function holycrosshospital_preprocess_node(&$vars) {
	$vars['submitted'] = $vars['date'] . ' — ' . $vars['name'];	
	$vars['template_files'] = array();
	$vars['template_files'][] = 'node'; 
	if($vars['page']){   
		$vars['template_files'][] = 'node-page';
		$vars['template_files'][] = 'node-'.$vars['node']->type.'-page';
		$vars['template_files'][] = 'node-'.$vars['node']->nid.'-page';
	} else {
		$vars['template_files'][] = 'node-'.$vars['node']->type;
		$vars['template_files'][] = 'node-'.$vars['node']->nid;
	}	
	if(!$vars['view']){
		$vars['theme_hook_suggestions'][] = 'node__' . $node->type;
		$vars['theme_hook_suggestions'][] = 'node__' . $node->nid;
		$vars['theme_hook_suggestions'][] = 'node__' . get_template();
	}
}*/


function holycrosshospital_preprocess_node(&$vars) {
	
	$vars['submitted'] = $vars['date'] . ' — ' . $vars['name'];
	$vars['template_files'] = array();
	$vars['template_files'][] = 'node'; 
	if($vars['page']){   
	
		$vars['template_files'][] = 'node-page';
		$vars['template_files'][] = 'node-'.$vars['node']->type.'-page';
		$vars['template_files'][] = 'node-'.$vars['node']->nid.'-page';
	} else {
		
		$vars['template_files'][] = 'node-'.$vars['node']->type;
		$vars['template_files'][] = 'node-'.$vars['node']->nid;
		//dsm($vars['template_files']);
	}	
	
	if(!isset($vars['view'])){
		if(isset($node)){
			$vars['theme_hook_suggestions'][] = 'node__' . $node->type;
			$vars['theme_hook_suggestions'][] = 'node__' . $node->nid;	
		}
		$vars['theme_hook_suggestions'][] = 'node__default';
	}
	
}



function holycrosshospital_preprocess_comment(&$vars) {
	$vars['submitted'] = $vars['created'] . ' — ' . $vars['author'];
}

function holycrosshospital_preprocess_block(&$vars) {
	$vars['title_attributes_array']['class'][] = 'title';
	$vars['classes_array'][] = 'clearfix';
}

function holycrosshospital_preprocess_region(&$vars) {
	if ($vars['region'] == 'header') {
		$vars['classes_array'][] = 'clearfix';
	}
}

function holycrosshospital_there_search_form($form) {
	return '<!-- search-form --><div class="search-form">'. str_replace(array('value="Search"'),array('value="Go"'),$form) .'</div>';
}

function filter_search_form($text) {
	return str_replace(array('value="Search"'),array('value="Go"'),$text);
}

function holycrosshospital_menu_block_links_footer($variables, $level=1) {  
	$links = $variables['links'];
	$attributes = $variables['attributes'];
	array_pop($links);
	array_pop($links);
	global $language_url;
	$output = '';
	if (count($links) > 0) {
		$output .= '<ul' . drupal_attributes($attributes) . '>';
		$num_links = count($links);
		$c = 0;
		foreach ($links as $link) { $c++;
			$class = $link['#attributes']['class'];
			if(count($class)){
				$class = ' class="'.implode(' ', $class).'"';
			} else {
				$class = '';
			}
			$output .= '<li' . $class . '>';
			if (isset($link['#href'])) {
				$output .= l($link['#title'], $link['#href'], $link);
			}
			$children = $link['#below'];
			if(!empty($children) && count($children) > 0){
				$level++;
				$vars = array();
				$vars['links'] = $children;
				$vars['attributes'] = array('class' => 'level-'.$level);
				$output .= menu_block_links($vars, $level);
				$level--;
			}
			$output .= "</li>\n";
			global $_footer_menu_spaces;
			if(in_array($c,$_footer_menu_spaces)){
				$output .= "</ul><ul>\n";
			}
		}
		$output .= '</ul>';
	}
	return $output;
}

function holycrosshospital_menu_block_links($variables, $level=1) {  
	$links = $variables['links'];
	$attributes = $variables['attributes'];
	array_pop($links);
	array_pop($links);
	global $language_url;
	$output = '';
	if (count($links) > 0) {
		$output .= '<ul' . drupal_attributes($attributes) . '>';
		$num_links = count($links);
		foreach ($links as $link) {
			$class = $link['#attributes']['class'];
			if(count($class)){
				$class = ' class="'.implode(' ', $class).'"';
			} else {
				$class = '';
			}
			$output .= '<li' . $class . '>';
			if (isset($link['#href'])) {
				$output .= l($link['#title'], $link['#href'], $link['#localized_options']);
			}
			$children = $link['#below'];
			if(!empty($children) && count($children) > 0){
				$level++;
				$vars = array();
				$vars['links'] = $children;
				$vars['attributes'] = array('class' => 'level-'.$level);
				$output .= menu_block_links($vars, $level);
				$level--;
			}
			$output .= "</li>\n";
		}
		$output .= '</ul>';
	}
	return $output;
}

function holycrosshospital_menu_block_links_left($variables, $level=1) {  
	$links = $variables['links'];
	$attributes = $variables['attributes'];
	array_pop($links);
	array_pop($links);
	global $language_url;
	$output = '';
	if (count($links) > 0) {
		if($level == 2){
			$output .= '<div class="drop"><div class="holder"><div class="frame"><ul' . drupal_attributes($attributes) . '>';
		} else {
			$output .= '<ul' . drupal_attributes($attributes) . '>';
		}	
		$num_links = count($links);
		foreach ($links as $link) {
			$class = $link['#attributes']['class'];
			if(count($class)){
				$class = ' class="'.implode(' ', $class).'"';
			} else {
				$class = '';
			}
			$output .= '<li' . $class . '>';
			if (isset($link['#href'])) {
				$output .= l($link['#title'], $link['#href'], $link);
			}
			$children = $link['#below'];
			if(!empty($children) && count($children) > 0){
				$level++;
				$vars = array();
				$vars['links'] = $children;
				$vars['attributes'] = array('class' => 'level-'.$level);
				$output .= menu_block_links_left($vars, $level);
				$level--;
			}
			$output .= "</li>\n";
		}
		if($level == 2){
			$output .= '</ul></div></div></div>';
		} else {
			$output .= '</ul>';
		}	
	}
	return $output;
}

function holycrosshospital_menu_block_links_mainmenu($variables, $level=1) {  
	$links = $variables['links'];
	$attributes = $variables['attributes'];
	array_pop($links);
	array_pop($links);
	global $language_url;
	$output = '';
	if (count($links) > 0) {
		if($level == 2){
			$output .= '<div class="drop"><div class="bg"><div class="bg2"><div class="bg3"><div class="holder"><ul' . drupal_attributes($attributes) . '>';
		} else {
			$output .= '<ul' . drupal_attributes($attributes) . '>';
		}		
		$num_links = count($links);
		if($num_links%2 == 0){$mid = intval($num_links/2);} else {$mid = intval($num_links/2) +1;}
		$j = 0;
		foreach ($links as $link) {
			$j++;
			$class = $link['#attributes']['class'];
			if(count($class)){
				$class = ' class="'.implode(' ', $class).'"';
			} else {
				$class = '';
			}
			$output .= '<li' . $class . '>';
			if (isset($link['#href'])) {
				if($level == 1){
					$output .= holycrosshospital_l2($link['#title'], $link['#href'], $link);
				} else {
					$output .= l($link['#title'], $link['#href'], $link['#localized_options']);
				}					
			}
			$children = $link['#below'];
			if(!empty($children) && count($children) > 0){
				$level++;
				$vars = array();
				$vars['links'] = $children;
				$vars['attributes'] = array('class' => 'level-'.$level);
				$output .= holycrosshospital_menu_block_links_mainmenu($vars, $level);
				$level--;
			}
			$output .= "</li>\n";
			if($num_links > 5 && $j == $mid){				
				$output .= "</ul><ul>\n";
			}
		}
		if($level == 2){
			$output .= '</ul></div></div></div></div></div>';
		} else {
			$output .= '</ul>';
		}		
	}
	return $output;
}

function holycrosshospital_l2($text, $path, array $options = array()) {
	global $language_url;
	static $use_theme = NULL;
	$options += array(
		'attributes' => array(),
		'html' => FALSE,
	);
	if (($path == $_GET['q'] || ($path == '<front>' && drupal_is_front_page())) &&
		(empty($options['language']) || $options['language']->language == $language_url->language)) {
		$options['attributes']['class'][] = 'active';
	}
	if (isset($options['attributes']['title']) && strpos($options['attributes']['title'], '<') !== FALSE) {
		$options['attributes']['title'] = strip_tags($options['attributes']['title']);
	}  
	if (!isset($use_theme) && function_exists('theme')) {
		if (variable_get('theme_link', TRUE)) {
			drupal_theme_initialize();
			$registry = theme_get_registry();
			$use_theme = !isset($registry['link']['function']) || ($registry['link']['function'] != 'theme_link');
			$use_theme = $use_theme || !empty($registry['link']['preprocess functions']) || !empty($registry['link']['process functions']) || !empty($registry['link']['includes']);
		} else {
			$use_theme = FALSE;
		}
	}
	// commented out to make floating top nav work on main site
	/*if ($use_theme) {
		return theme('link', array('text' => $text, 'path' => $path, 'options' => $options));
	}*/
	return '<a title="'. check_plain($text) .'" href="' . check_plain(url($path, $options)) . '"' . drupal_attributes($options['attributes']) . '><span>' . ($options['html'] ? $text : check_plain($text)) . '</span></a>';
}

 

function holycrosshospital_more_link ($array)
{
   if (stristr( $array['url'], 'aggregator'))
   {
      return "";
   }
}


function phptemplate_menu_item_link($link) {
if (empty($link['localized_options'])) {
$link['localized_options'] = array();
}

$link['localized_options']= array('html'=>true);
return l($link['title'], $link['href'], $link['localized_options']);
}


/**
 * Theme to use for when one or no locations are supplied.
 *
 */
 
function holycrosshospital_getdirections_show($variables) {
  $form = $variables['form'];
  $width = $variables['width'];
  $height = $variables['height'];
  $nid = $variables['nid'];
  $type =  $variables['type'];
  $output = '';
  $getdirections_returnlink_default = array(
    'page_enable' => 0,
    'page_link' => t('Return to page'),
    'user_enable' => 0,
    'user_link' => t('Return to page'),
    'term_enable' => 0,
    'term_link' => t('Return to page'),
    'comment_enable' => 0,
    'comment_link' => t('Return to page'),
  );
  $getdirections_returnlink = variable_get('getdirections_returnlink', $getdirections_returnlink_default);
  $returnlink = FALSE;
  if (isset($getdirections_returnlink['page_enable']) && $getdirections_returnlink['page_enable'] && $nid > 0 && $type == 'node') {
    $node = node_load($nid);
    if ($node) {
      $linktext = $getdirections_returnlink['page_link'];
      if ( preg_match("/%t/", $linktext)) {
        $linktext = preg_replace("/%t/", $node->title, $linktext);
      }
      $l = l($linktext, 'node/' . $node->nid);
      $returnlink = '<div class="getdirections_returnlink">' . $l . '</div>';
    }
  }
  elseif (isset($getdirections_returnlink['user_enable']) && $getdirections_returnlink['user_enable'] && $nid > 0 && $type == 'user') {
    // $nid is actually uid
    $account = user_load($nid);
    if ($account) {
      $linktext = $getdirections_returnlink['user_link'];
      if ( preg_match("/%n/", $linktext)) {
        $linktext = preg_replace("/%n/", $account->name, $linktext);
      }
      $l = l($linktext, 'user/' . $account->uid);
      $returnlink = '<div class="getdirections_returnlink">' . $l . '</div>';
    }
  }
  elseif (isset($getdirections_returnlink['page_enable']) && $getdirections_returnlink['page_enable'] && $nid > 0 && $type == 'location') {
    // $nid is actually lid
    $id = getdirections_get_nid_from_lid($nid);
    if ($id) {
      $node = node_load($id);
      $linktext = $getdirections_returnlink['page_link'];
      if ( preg_match("/%t/", $linktext)) {
        $linktext = preg_replace("/%t/", $node->title, $linktext);
      }
      $l = l($linktext, 'node/' . $node->nid);
      $returnlink = '<div class="getdirections_returnlink">' . $l . '</div>';
    }
  }
  elseif (isset($getdirections_returnlink['term_enable']) && $getdirections_returnlink['term_enable'] && $nid > 0 && $type == 'term') {
    // $nid is actually tid
    $term = taxonomy_term_load($nid);
    if ($term) {
      $linktext = $getdirections_returnlink['term_link'];
      if ( preg_match("/%n/", $linktext)) {
        $linktext = preg_replace("/%n/", $term->name, $linktext);
      }
      $l = l($linktext, 'taxonomy/term/' . $term->tid);
      $returnlink = '<div class="getdirections_returnlink">' . $l . '</div>';
    }
  }
  elseif (isset($getdirections_returnlink['comment_enable']) && $getdirections_returnlink['comment_enable'] && $nid > 0 && $type == 'comment') {
    // $nid is actually cid
    $comment = comment_load($nid);
    if ($comment) {
      $linktext = $getdirections_returnlink['comment_link'];
      if ( preg_match("/%n/", $linktext)) {
        $linktext = preg_replace("/%n/", $comment->subject, $linktext);
      }
      $l = l($linktext, 'comment/' . $comment->cid);
      $returnlink = '<div class="getdirections_returnlink">' . $l . '</div>';
    }
  }

  if ($returnlink) {
    $output .= $returnlink;
  }

  $output .= $form;

  $getdirections_defaults = getdirections_defaults();
  $getdirections_misc = getdirections_misc_defaults();

  if ($getdirections_misc['show_distance']) {
    $output .= '<div id="getdirections_show_distance"></div>';
  }
  if ($getdirections_misc['show_duration']) {
    $output .= '<div id="getdirections_show_duration"></div>';
  }
  $help = '';
  if (getdirections_is_advanced()) {
    if ($getdirections_defaults['waypoints'] > 0 && ! $getdirections_defaults['advanced_alternate'] ) {
      $help = t('Drag <img src="http://labs.google.com/ridefinder/images/mm_20_!c.png"> to activate a waypoint', array('!c' => $getdirections_defaults['waypoint_color']));
      if ($getdirections_defaults['advanced_autocomplete'] && $getdirections_defaults['advanced_autocomplete_via'] ) {
        $help .= ' ' . t('or use the Autocomplete boxes');
      }
    }
    elseif ($getdirections_defaults['advanced_alternate']) {
      $help = t('You can drag the route to change it');
    }
  }
  $output .= '<div id="getdirections_help">' . $help . '</div>';
  $header = array();
$rows[] = array(
array(
'data' => '<div id="getdirections_map_canvas" style="width: '. $width .'; height: '. $height .'" ></div>',
'valign' => 'top',
'align' => 'center',
'class' => 'getdirections-map',
),
);
$rows[] = array(
array(
'data' => ($getdirections_defaults['advanced_alternate'] ? '<button id="getdirections-undo" onclick="getdirectionsundo()">' . t('Undo') . '</button>' : '') .'<div id="getdirections_directions"></div>',
'valign' => 'top' ,
'align' => 'left',
'class' => 'getdirections-list',
),
);
  $output .= '<div class="getdirections">' . theme('table', array('header' => $header, 'rows' => $rows)) . '</div>';
  return $output;
}



 




