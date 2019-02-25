<?php

//Add project post type to page builder defaults
function trade_siteorgin_defaults($defaults){
	// Post types
	$defaults['post-types'] = array('page', 'post', 'project');
	return $defaults;
}
add_filter( 'siteorigin_panels_settings_defaults', 'trade_siteorgin_defaults' );

//Remove the built-in posts carousel widget
function trade_panels_widgets( $widgets ){
	unset($widgets['SiteOrigin_Widget_PostCarousel_Widget']);
	return $widgets;
}
add_filter( 'siteorigin_panels_widgets', 'trade_panels_widgets', 11);



function trade_filter_siteorigin_active_widgets($active){
    $active['so-price-table-widget'] = true;
	$active['so-headline-widget'] = true;
	$active['so-social-media-buttons-widget'] = true;
	$active['so-post-carousel-widget'] = false;
    return $active;
}
add_filter('siteorigin_widgets_active_widgets', 'trade_filter_siteorigin_active_widgets');


//Add custom row styles
function trade_panels_custom_row_styles($fields) {
	$fields['row_margin_top'] = array(
	        'name'      => __('Top Margin', 'trade'),
	        'type'      => 'measurement',
	        'group'     => 'layout',
	        'priority'  => 4,
		);
  $fields['background_image'] = array(
        'name'      => __('Background Image', 'trade'),
        'group'     => 'design',
        'type'      => 'image',
        'priority'  => 5,
      );
  $fields['background_image_position'] = array(
        'name'      => __('Background Image Position', 'trade'),
        'type'      => 'select',
        'group'     => 'design',
        'default'   => 'center top',
        'priority'  => 6,
        'options'   => array(
               "left top"       => __("Left Top", "trade"),
               "left center"    => __("Left Center", "trade"),
               "left bottom"    => __("Left Bottom", "trade"),
               "center top"     => __("Center Top", "trade"),
               "center center"  => __("Center Center", "trade"),
               "center bottom"  => __("Center Bottom", "trade"),
               "right top"      => __("Right Top", "trade"),
               "right center"   => __("Right Center", "trade"),
               "right bottom"   => __("Right Bottom", "trade")
                ),
      );
  $fields['background_image_style'] = array(
        'name'      => __('Background Image Style', 'trade'),
        'type'      => 'select',
        'group'     => 'design',
        'default'   => 'cover',
        'priority'  => 6,
        'options'   => array(
             "cover"      => __("Cover", "trade"),
             "parallax"   => __("Parallax", "trade"),
             "no-repeat"  => __("No Repeat", "trade"),
             "repeat"     => __("Repeat", "trade"),
             "repeat-x"   => __("Repeat-X", "trade"),
             "repeat-y"   => __("Repeat-y", "trade"),
              ),
        );
  $fields['border_top'] = array(
        'name'      => __('Border Top Size', 'trade'),
        'type'      => 'measurement',
        'group'     => 'design',
        'priority'  => 8,
  );
  $fields['border_top_color'] = array(
        'name'      => __('Border Top Color', 'trade'),
        'type'      => 'color',
        'group'     => 'design',
        'priority'  => 8.5,
      );
  $fields['border_bottom'] = array(
        'name'      => __('Border Bottom Size', 'trade'),
        'type'      => 'measurement',
        'group'     => 'design',
        'priority'  => 9,
  );
  $fields['border_bottom_color'] = array(
        'name' => __('Border Bottom Color', 'trade'),
        'type' => 'color',
        'group' => 'design',
        'priority' => 9.5,
  );

	$fields['equal_column_height'] = array(
	        'name'      => __('Equal Column Height', 'trade'),
	        'type'      => 'select',
	        'group'     => 'layout',
	        'default'   => 'no',
	        'priority'  => 10,
	        'options'   => array(
	             "no"      => __("No", "trade"),
	             "yes"   => __("Yes", "trade"),
	              ),
	  );
  return $fields;
}
add_filter('siteorigin_panels_row_style_fields', 'trade_panels_custom_row_styles');

function trade_panels_remove_row_styles($fields) {
 unset( $fields['background_image_attachment'] );
 unset( $fields['background_display'] );
 //unset( $fields['padding'] );
 unset( $fields['border_color'] );
 return $fields;
}
add_filter('siteorigin_panels_row_style_fields', 'trade_panels_remove_row_styles');

function trade_panels_row_styles_attributes($attributes, $args) {
  	if(!empty($args['row_margin_top'])) {
	    if( function_exists('is_numeric' ) ) {
	      if (is_numeric($args['row_margin_top'])) {
	        $attributes['style'] .= 'margin-top: '.esc_attr($args['row_margin_top']).'px !important; ';
	      } else {
	         $attributes['style'] .= 'margin-top: '.esc_attr($args['row_margin_top']).' !important; ';
	      }
	    } else {
	       $attributes['style'] .= 'margin-top: '.esc_attr($args['row_margin_top']).' !important; ';
	    }
	  }
  if(!empty($args['background_image'])) {
    $url = wp_get_attachment_image_src( $args['background_image'], 'full' );
	$unique_class = 'row-'.uniqid();
    if(empty($url) || $url[0] == site_url() ) {
		$bg_img = $args['background_image'];
      } else {
		$bg_img = $url[0];
      }
	  $attributes['style'] .= 'background-image: url(' . $bg_img . ');';
      if(!empty($args['background_image_style'])) {
            switch( $args['background_image_style'] ) {
              case 'no-repeat':
                $attributes['style'] .= 'background-repeat: no-repeat;';
				$attributes['style'] .= 'background-size: auto;';
				$attributes['style'] .= 'background-position: ' . $args['background_image_position'] .';';
                break;
              case 'repeat':
				$attributes['style'] .= 'background-size: auto;';
                $attributes['style'] .= 'background-repeat: repeat;';
                break;
              case 'repeat-x':
                $attributes['style'] .= 'background-repeat: repeat-x;';
				$attributes['style'] .= 'background-size: auto;';
                break;
              case 'repeat-y':
                $attributes['style'] .= 'background-repeat: repeat-y;';
				$attributes['style'] .= 'background-size: auto;';
                break;
              case 'cover':
                $attributes['style'] .= 'background-size: cover;';
				$attributes['style'] .= 'background-position: ' . $args['background_image_position'] .';';
                break;
              case 'parallax':
				//$attributes['style'] = '';
				wp_enqueue_script( 'trade-parallax-scroll');
                $attributes['class'][] .= 'parallax-section';
				$attributes['class'][] .= $unique_class;
				$attributes['data-parallax-image'] = $bg_img;
				$attributes['data-parallax-id'] = '.'.$unique_class;
				$attributes['style'] .= 'background-position: ' . $args['background_image_position'] .';';
                break;
            }
        }
  }

	if(!empty($args['equal_column_height'])){
		if($args['equal_column_height']=="yes"){
	   		$attributes['class'][] = 'equal-column-height';
		}
	  }

  return $attributes;
}
add_filter('siteorigin_panels_row_style_attributes', 'trade_panels_row_styles_attributes', 10, 2);

//Add custom widget styles
function trade_panels_widget_styles($fields) {

  	$fields['widget_margin_top'] = array(
	        'name'      => __('Margin Top', 'trade'),
	        'type'      => 'measurement',
	        'group'     => 'layout',
	        'priority'  => 8.3,
	  );
	$fields['widget_margin_bottom'] = array(
	        'name'      => __('Margin Bottom', 'trade'),
	        'type'      => 'measurement',
			'default'   => '20px',
	        'group'     => 'layout',
	        'priority'  => 8.4,
	  );
  return $fields;
}
add_filter('siteorigin_panels_widget_style_fields', 'trade_panels_widget_styles');

function trade_panels_widget_styles_attributes($attributes, $args) {
   if(!empty($args['widget_margin_bottom'])) {
    if( function_exists('is_numeric' ) ) {
      if (is_numeric($args['widget_margin_bottom'])) {
        $attributes['style'] .= 'margin-bottom: '.esc_attr($args['widget_margin_bottom']).'px !important; ';
      } else {
         $attributes['style'] .= 'margin-bottom: '.esc_attr($args['widget_margin_bottom']).' !important; ';
      }
    } else {
       $attributes['style'] .= 'margin-bottom: '.esc_attr($args['widget_margin_bottom']).' !important; ';
    }
  }
  if(!empty($args['widget_margin_top'])) {
    if( function_exists('is_numeric' ) ) {
      if (is_numeric($args['widget_margin_top'])) {
        $attributes['style'] .= 'margin-top: '.esc_attr($args['widget_margin_top']).'px !important; ';
      } else {
         $attributes['style'] .= 'margin-top: '.esc_attr($args['widget_margin_top']).' !important; ';
      }
    } else {
       $attributes['style'] .= 'margin-top: '.esc_attr($args['widget_margin_top']).' !important; ';
    }
  }

  return $attributes;
}
add_filter('siteorigin_panels_widget_style_attributes', 'trade_panels_widget_styles_attributes', 10, 2);

//////////////////////////////////////////////
// Prebuilt Layouts
//////////////////////////////////////////////
function trade_prebuilt_layouts($layouts) {
		$layout_dir = get_template_directory() . '/inc/page-builder-layouts/';
		require_once( $layout_dir . 'attorney.php');
		require_once( $layout_dir . 'construction.php');
		require_once( $layout_dir . 'finance.php');
		require_once( $layout_dir . 'fitness.php');
		require_once( $layout_dir . 'restaurant.php');
		require_once( $layout_dir . 'medical.php');
		require_once( $layout_dir . 'about-us.php');
		require_once( $layout_dir . 'about-me.php');
		require_once( $layout_dir . 'about-team.php');
		require_once( $layout_dir . 'services-classic.php');
		require_once( $layout_dir . 'services-minimal.php');
		require_once( $layout_dir . 'services-modern.php');
		require_once( $layout_dir . 'contact-simple.php');
		require_once( $layout_dir . 'contact-modern.php');
		require_once( $layout_dir . 'pricing-table.php');
		require_once( $layout_dir . 'features.php');
		return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts','trade_prebuilt_layouts');



?>