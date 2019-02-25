<?php
/**
 * @package create
 */
?>
<?php

global $ttrust_config;
$ttrust_config['name'] = "Trade";


/**
* Defines widgetized areas
*/

function trade_register_sidebars() {

	register_sidebar( array(
		'name' 				=> __( 'Sidebar', 'trade' ),
		'id' 				=> 'sidebar',
		'description' 		=> __( 'This is the widget area for blog posts.', 'trade' ),
		'before_widget' 	=> '<div id="%1$s" class="widget-box widget %2$s"><div class="inside">',
		'after_widget' 		=> '</div></div>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );
	
	register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'trade' ),
		'id' => 'sidebar_shop',
		'description' 		=> __( 'This is the widget area for shop pages.', 'trade' ),
		'before_widget' 	=> '<div id="%1$s" class="widget-box widget %2$s"><div class="inside">',
		'after_widget' 		=> '</div></div>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	));
	
	register_sidebar( array(
		'name' 				=> __( 'Footer', 'trade' ),
		'id' 				=> 'footer',
		'description' 		=> __( 'This is the default widget area for the footer.', 'trade' ),
		'before_widget' 	=> '<div id="%1$s" class="small one-third %2$s footer-box widget-box"><div class="inside">',
		'after_widget' 		=> '</div></div>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );

} // create_register_sidebars()

add_action( 'widgets_init', 'trade_register_sidebars' );


if(!function_exists('tt_add_support_custom_sidebar')) {
    /**
     * Add custom sidebars
     */
    function tt_add_support_custom_sidebar() {
        add_theme_support('tt_sidebar');
        if (get_theme_support('tt_sidebar')) new tt_sidebar();
    }

    add_action('after_setup_theme', 'tt_add_support_custom_sidebar');
}


add_action( 'load-widgets.php', 'load_color_picker' );

function load_color_picker() {    
	wp_enqueue_style( 'wp-color-picker' );        
	wp_enqueue_script( 'wp-color-picker' );    
}
?>