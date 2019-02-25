<?php
/**
 * @category Trade
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}


//Header Options

add_action( 'cmb2_init', 'trade_register_header_metabox' );
function trade_register_header_metabox() {
	
	$prefix = '_trade_header_';

	$cmb_header = new_cmb2_box( array(
		'id'            => $prefix . 'options',
		'title'         => __( 'Header Options', 'trade' ),
		'object_types'  => array( 'project','page','post', 'product' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true
	) );
	
	$cmb_header->add_field( array(
		'name'             => __( 'Hide Header', 'trade' ),
		'desc'             => __( 'Choose to hide or show the header on this page.', 'trade' ),
		'id'               => $prefix . 'hide',
		'type'             => 'select',
		'options'          => array(
			'no'   => __( 'No', 'trade' ),
			'yes' => __( 'Yes', 'trade' )
		),
	) );
	
	$cmb_header->add_field( array(
		'name'             => __( 'Show Top Bar', 'trade' ),
		'desc'             => __( 'Choose to hide or show the top bar on this page.', 'trade' ),
		'id'               => $prefix . 'show_top_bar',
		'type'             => 'select',
		'options'          => array(
			'default'   => __( 'Default', 'trade' ),
			'no'   => __( 'No', 'trade' ),
			'yes' => __( 'Yes', 'trade' )
		),
	) );
	
	$cmb_header->add_field( array(
		'name'             => __( 'Transparent Background', 'trade' ),
		'desc'             => __( 'Make the site header background transparent on this page.', 'trade' ),
		'id'               => $prefix . 'transparent_bg',
		'type'             => 'select',
		'options'          => array(
			'no' => __( 'No', 'trade' ),
			'yes'   => __( 'Yes', 'trade' )
		),
	) );
	
	$cmb_header->add_field( array(
		'name'             => __( 'Color Scheme', 'trade' ),
		'desc'             => __( 'Make the contents of the header light or dark for this page. Only applies if Transparent Background is enabled.', 'trade' ),
		'id'               => $prefix . 'color_scheme',
		'type'             => 'select',
		'options'          => array(
			'dark' => __( 'Dark', 'trade' ),
			'light'   => __( 'Light', 'trade' )
		),
	) );
	
	$cmb_header->add_field( array(
	    'name' => __( 'Menu Color', 'trade' ),
	    'id'   => $prefix . 'menu_color',
	    'type' => 'colorpicker',
	    'default'  => ''
	) );
	
	$cmb_header->add_field( array(
	    'name' => __( 'Menu Color Hover', 'trade' ),
	    'id'   => $prefix . 'menu_hover_color',
	    'type' => 'colorpicker',
	    'default'  => ''
	) );
	
	$cmb_header->add_field( array(
		'name'             => __( 'Main Menu', 'trade' ),
		'desc'             => __( 'Select a different main menu to show on this page.', 'trade' ),
		'id'               => $prefix . 'menu_main',
		'type'             => 'select',
		'options'          => customMenus(),
	) );
	
	$cmb_header->add_field( array(
		'name'             => __( 'Mobile Menu', 'trade' ),
		'desc'             => __( 'Select a different mobile menu to show on this page.', 'trade' ),
		'id'               => $prefix . 'menu_mobile',
		'type'             => 'select',
		'options'          => customMenus(),
	) );
	
	$cmb_header->add_field( array(
		'name'             => __( 'Left Menu (Split Header)', 'trade' ),
		'desc'             => __( 'Select a different left menu to show on this page. For use with Split Header layout.', 'trade' ),
		'id'               => $prefix . 'menu_left',
		'type'             => 'select',
		'options'          => customMenus(),
	) );
	
	$cmb_header->add_field( array(
		'name'             => __( 'Show Top Bar', 'trade' ),
		'desc'             => __( 'Choose to show or hide the top bar.', 'trade' ),
		'id'               => $prefix . 'show_top_bar',
		'type'             => 'select',
		'options'          => array(
			'default' => __( 'Default', 'trade' ),
			'no' => __( 'No', 'trade' ),
			'yes'   => __( 'Yes', 'trade' )
		),
	) );
}

//Title Options

add_action( 'cmb2_init', 'trade_register_title_metabox' );
function trade_register_title_metabox() {

	$prefix = '_trade_title_';

	$cmb_title = new_cmb2_box( array(
		'id'            => $prefix . 'options',
		'title'         => __( 'Title Area Options', 'trade' ),
		'object_types'  => array( 'page', 'project', 'post', 'product'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true
	) );
	
	$cmb_title->add_field( array(
		'name'             => __( 'Show Title Area', 'trade' ),
		'desc'             => __( 'Hide or show the page title area.', 'trade' ),
		'id'               => $prefix . 'show',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'yes' => __( 'Yes', 'trade' ),
			'no'   => __( 'No', 'trade' ),
		),
	) );
	
	$cmb_title->add_field( array(
		'name'       => __( 'Subtitle Text', 'trade' ),
		'desc'       => __( 'This text will be displayed below the title on pages and projects.', 'trade' ),
		'id'         => $prefix . 'subtitle',
		'type'       => 'text'
	) );
	
	$cmb_title->add_field( array(
		'name'             => __( 'Hide Text', 'trade' ),
		'id'               => $prefix . 'hide_text',
		'type'             => 'select',
		'options'          => array(
			'no'     => __( 'No', 'trade' ),
			'yes'   => __( 'Yes', 'trade' ),
		),
	) );
	
	$cmb_title->add_field( array(
		'name' => __( 'Title Image', 'trade' ),
		'desc' => __( 'This image will appear above the title text.', 'trade' ),
		'id'   => $prefix . 'img',
		'type' => 'file',
	) );
	
	$cmb_title->add_field( array(
		'name'             => __( 'Title Alignment', 'trade' ),
		'id'               => $prefix . 'alignment',
		'type'             => 'select',
		'options'          => array(
			''     => __( 'Default', 'trade' ),
			'center'     => __( 'Center', 'trade' ),
			'left'   => __( 'Left', 'trade' ),
			'right'   => __( 'Right', 'trade' )
		),
	) );

	$cmb_title->add_field( array(
		'name' => __( 'Title Area Height', 'trade' ),
		'desc' => __( 'Set the height of the title area in pixels. (ex. 400)', 'trade' ),
		'id'   => $prefix . 'area_height',
		'type' => 'text_small'
	) );
	
	$cmb_title->add_field( array(
		'name' => __( 'Title Background Image', 'trade' ),
		'desc' => __( 'Upload an image or enter a URL.', 'trade' ),
		'id'   => $prefix . 'bg_img',
		'type' => 'file',
	) );
	
	$cmb_title->add_field( array(
		'name'             => __( 'Enable Background Parallax', 'trade' ),
		'id'               => $prefix . 'parallax',
		'type'             => 'select',
		'options'          => array(
			'no'     => __( 'No', 'trade' ),
			'yes'   => __( 'Yes', 'trade' ),
		),
	) );
	
	$cmb_title->add_field( array(
	    'name' => __( 'Title Text Color', 'trade' ),
	    'id'   => $prefix . 'color',
	    'type' => 'colorpicker',
	    'default'  => '#191919'
	) );
	
}

//Project Options

add_action( 'cmb2_init', 'trade_register_project_metabox' );
function trade_register_project_metabox() {
	
	$prefix = '_trade_project_';

	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'options',
		'title'         => __( 'Project Options', 'trade' ),
		'object_types'  => array( 'project', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true
	) );
	
	$cmb_project->add_field( array(
		'name'             => __( 'Featured Image Size', 'trade' ),
		'desc'             => __( 'Select the size of the featured image for this project.', 'trade' ),
		'id'               => $prefix . 'featured_image_size',
		'type'             => 'select',
		'options'          => array(
			'square' => __( 'Default', 'trade' ),
			'wide'   => __( 'Wide', 'trade' ),
			'tall'     => __( 'Tall', 'trade' ),
			'wide_tall'     => __( 'Wide and Tall', 'trade' ),
		),
	) );
	
	$cmb_project->add_field( array(
		'name' => __( 'Lightbox Image', 'trade' ),
		'desc' => __( 'This image will open if lightbox mode is enabled.', 'trade' ),
		'id'   => $prefix . 'lightbox_img',
		'type' => 'file',
	) );
	
	$cmb_project->add_field( array(
		'name' => __( 'Lightbox Video', 'trade' ),
		'desc' => __( 'Enter the URL of your video. This video will open if lightbox mode is enabled.', 'trade' ),
		'id'   => $prefix . 'lightbox_video',
		'type' => 'text',
	) );
}

//Blog Options

add_action( 'cmb2_init', 'trade_register_blog_metabox' );
function trade_register_blog_metabox() {
	
	$prefix = '_trade_blog_';

	$cmb_blog = new_cmb2_box( array(
		'id'            => $prefix . 'options',
		'title'         => __( 'Blog Options', 'trade' ),
		'object_types'  => array( 'page', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true
	) );
	
	$cmb_blog->add_field( array(
		'name'             => __( 'Posts per Page', 'trade' ),
		'desc'             => __( 'Select the number of posts per page.', 'trade' ),
		'id'               => $prefix . 'posts_per_page',
		'type'             => 'text_small',
		'default' => '10'
	) );
	
	$cmb_blog->add_field( array(
		'name'             => __( 'Show Excerpt', 'trade' ),
		'desc'             => __( 'Show an excerpt for each post.', 'trade' ),
		'id'               => $prefix . 'show_excerpt',
		'type'             => 'select',
		'options'          => array(
			'yes' => __( 'Yes', 'trade' ),
			'no'   => __( 'No', 'trade' )
		),
	) );
	
	$cmb_blog->add_field( array(
		'name'             => __( 'Featured Image Size', 'trade' ),
		'desc'             => __( 'Select the size of the featured image for standard blog layouts.', 'trade' ),
		'id'               => $prefix . 'featured_img_size',
		'type'             => 'select',
		'options'          => array(
			'large' => __( 'Large', 'trade' ),
			'small'   => __( 'Small', 'trade' )
		),
	) );
}

//Post Options

add_action( 'cmb2_init', 'trade_register_post_metabox' );
function trade_register_post_metabox() {
	
	$prefix = '_trade_post_';

	$cmb_post = new_cmb2_box( array(
		'id'            => $prefix . 'options',
		'title'         => __( 'Post Options', 'trade' ),
		'object_types'  => array( 'post', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true
	) );
	
	$cmb_post->add_field( array(
		'name'             => __( 'Metro Size', 'trade' ),
		'desc'             => __( 'Select the size of the post for Metro layouts.', 'trade' ),
		'id'               => $prefix . 'metro_image_size',
		'type'             => 'select',
		'options'          => array(
			'square' => __( 'Default', 'trade' ),
			'wide'   => __( 'Wide', 'trade' ),
			'tall'     => __( 'Tall', 'trade' ),
			'wide_tall'     => __( 'Wide and Tall', 'trade' ),
		),
	) );
	
	$cmb_post->add_field( array(
		'name'             => __( 'Show Featured Image', 'trade' ),
		'desc'             => __( 'Show featured image on single post.', 'trade' ),
		'id'               => $prefix . 'show_featured_img',
		'type'             => 'select',
		'options'          => array(
			'yes' => __( 'Yes', 'trade' ),
			'no'   => __( 'No', 'trade' )
		),
	) );
	
	$cmb_post->add_field( array(
		'name'             => __( 'Full Width Content', 'trade' ),
		'desc'             => __( 'Make the content full width with no sidebar.', 'trade' ),
		'id'               => $prefix . 'full_width',
		'type'             => 'select',
		'options'          => array(
			'no'   => __( 'No', 'trade' ),
			'yes' => __( 'Yes', 'trade' )
		),
	) );
		
}

//Sidebar Options

add_action( 'cmb2_init', 'trade_register_sidebar_metabox' );
function trade_register_sidebar_metabox() {

	$prefix = '_trade_sidebar_';

	$cmb_title = new_cmb2_box( array(
		'id'            => $prefix . 'options',
		'title'         => __( 'Sidebar Options', 'trade' ),
		'object_types'  => array( 'page', 'post'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true
	) );
	
	$cmb_title->add_field( array(
		'name'             => __( 'Custom Widget Area', 'trade' ),
		'desc'             => __( 'Select a custom widget area to show in this sidebar.', 'trade' ),
		'id'               => $prefix . 'custom_widget_area',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array_merge(array('' => ''), get_custom_sidebars()),
	) );
	
}

//Footer Options

add_action( 'cmb2_init', 'trade_register_footer_metabox' );
function trade_register_footer_metabox() {

	$prefix = '_trade_footer_';

	$cmb_footer = new_cmb2_box( array(
		'id'            => $prefix . 'options',
		'title'         => __( 'Footer Options', 'trade' ),
		'object_types'  => array( 'page', 'post', 'project'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true
	) );
	
	$cmb_footer->add_field( array(
		'name'             => __( 'Hide Footer', 'trade' ),
		'desc'             => __( 'Choose to hide or show the footer on this page.', 'trade' ),
		'id'               => $prefix . 'hide',
		'type'             => 'select',
		'options'          => array(
			'no'   => __( 'No', 'trade' ),
			'yes' => __( 'Yes', 'trade' )
		),
	) );
	
	$cmb_footer->add_field( array(
		'name'             => __( 'Custom Widget Area', 'trade' ),
		'desc'             => __( 'Select a custom widget area to show in this footer.', 'trade' ),
		'id'               => $prefix . 'custom_widget_area',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array_merge(array('' => ''), get_custom_sidebars()),
	) );
	
}

