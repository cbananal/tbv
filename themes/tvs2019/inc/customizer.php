<?php
/**
 * Trade Theme Customizer
 *
 * @package create
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trade_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// remove controls
	$wp_customize->remove_control('blogdescription');

	// -- Sanitization Callbacks

	/**
	 * Sanitize boolean
	 *
	 * @param $input
	 *
	 * @return bool
	 */
	function trade_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return 0;
	    }
	}

	/**
	 * Sanitize numbers
	 *
	 * @param int $input
	 *
	 * @return int
	 */
	function trade_sanitize_number( $input ) {
		if ( is_numeric( $input ) ) {
			return $input;
		} else {
			return '';
		}
	}

	/**
	 * Sanitize banner type
	 *
	 * @param string $input
	 *
	 * @return string
	 */
	function trade_sanitize_banner_type( $input ){

		if( 'static' == $input || 'campaign' == $input )
			return $input;
		else
			return '';

	} // create_sanitize_banner_type()

	if ( ! class_exists( 'WP_Customize_Control' ) )
		return NULL;

	/**
	 * Class to add a text area for page and section descriptions
	 */

	class Trade_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	} // Trade_Textarea_Control

	/**
	 * Class to add a header to certain sections
	 */
	class Trade_Header_Control extends WP_Customize_Control {
		public $type = 'tag';
		public function render_content() {
			?>
			<h3 class="customize-control-title"><?php echo esc_html( $this->label ); ?></h3>
		<?php
		}
	}

	//Text Area Control
	class TTrust_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	
	
	// -- General --------------------------------------------------------------------------------------------------

	$wp_customize->add_panel( 'trade_general', array(
		'priority'		 => 1,
	    'title'     	 => __( 'General', 'trade' )
	) );
	
	// -- Loader
	
	$wp_customize->add_section( 'trade_loader', array(
		'priority'		 => 1,
	    'title'     	 => __( 'Loader', 'trade' ),
		'panel'			=> 'trade_general'
	) );
	
	$wp_customize->add_setting( 'trade_loader_enabled' , array(
	    'default'     		=> __( 'yes', 'trade' ),
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_loader_enabled', array(
		'type'      => 'select',
		'label'     => __( 'Enable Loader', 'trade' ),
		'section'   => 'trade_loader',
		'settings'  => 'trade_loader_enabled',
		'choices'   => array(
		            'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_loader_animation' , array(
	    'default'     		=> __( 'rotating-plane', 'trade' ),
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_loader_animation', array(
		'type'      => 'select',
		'label'     => __( 'Loader Animation', 'trade' ),
		'section'   => 'trade_loader',
		'settings'  => 'trade_loader_animation',
		'choices'   => array(
		            'loading' => 'Spinner',
		            'loading loading--double' => 'Double Spinner',
					'loading-pulse' => 'Pulse',
		        ),
		'priority'   => 2
	) );
	
	$wp_customize->add_setting( 'trade_loader_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_loader_color', array(
			'label'      => __( 'Loader Icon Color', 'trade' ),
			'section'    => 'trade_loader',
			'settings'   => 'trade_loader_color',
			'priority'   => 3
		) )
	);
	
	$wp_customize->add_setting( 'trade_loader_bkg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_loader_bkg_color', array(
			'label'      => __( 'Loader Background Color', 'trade' ),
			'section'    => 'trade_loader',
			'settings'   => 'trade_loader_bkg_color',
			'priority'   => 4
		) )
	);
	
	
	
	// -- Layout --------------------------------------------------------------------------------------------------
	
	$wp_customize->add_section( 'trade_layout', array(
		'priority'		 => 3,
	    'title'     	 => __( 'Layout', 'trade' )
	) );
	
	$wp_customize->add_setting( 'trade_site_width' , array(
	    'default'     		=> __( 'full-width', 'trade' ),
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_site_width', array(
		'type'      => 'select',
		'label'     => __( 'Site Container', 'trade' ),
		'section'   => 'trade_layout',
		'settings'  => 'trade_site_width',
		'choices'   => array(
		            'full-width' => 'Full Width',
		            'boxed' => 'Boxed'
		        ),
		'priority'   => 31
	) );
	
	
	
	// -- Header & Navigation --------------------------------------------------------------------------------------------------

	$wp_customize->add_panel( 'trade_header_navigation', array(
		'priority'		 => 4,
	    'title'     	 => __( 'Header & Navigation', 'trade' )
	) );
	
	// -- Logos
	
	$wp_customize->add_section( 'trade_logos', array(
		'priority'		 => 1,
	    'title'     	 => __( 'Logos', 'trade' ),
		'panel'			=> 'trade_header_navigation'
	) );
	
	$wp_customize->add_setting( 'trade_logo_top' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'trade_top_logo', array(
		'label'      => __('Header Logo - Dark', 'trade'),
		'section'    => 'trade_logos',
		'settings'   => 'trade_logo_top',
	    'priority'   => 1
	) ) );
	
	$wp_customize->add_setting( 'trade_logo_top_width' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_logo_top_width', array(
		'label'     => __( 'Header Logo Width - Dark', 'trade' ),
		'type'      => 'text',
		'description'     => __( 'Enter the actual width of your logo image in pixels. Used for retina displays.', 'trade' ),
		'section'   => 'trade_logos',
		'settings'  => 'trade_logo_top_width',
		'priority'   => 2
	) );
	
	$wp_customize->add_setting( 'trade_logo_top_light' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'trade_logo_top_light', array(
		'label'      => __('Header Logo - Light', 'trade'),
		'section'    => 'trade_logos',
		'settings'   => 'trade_logo_top_light',
	    'priority'   => 2.5
	) ) );
	
	$wp_customize->add_setting( 'trade_logo_top_width_light' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_logo_top_width_light', array(
		'label'     => __( 'Header Logo Width - Light', 'trade' ),
		'type'      => 'text',
		'description'     => __( 'Enter the actual width of your logo image in pixels. Used for retina displays.', 'trade' ),
		'section'   => 'trade_logos',
		'settings'  => 'trade_logo_top_width_light',
		'priority'   => 2.7
	) );
	
	$wp_customize->add_setting( 'trade_logo_sticky' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'trade_top_sticky', array(
		'label'      => __('Sticky Header Logo', 'trade'),
		'section'    => 'trade_logos',
		'settings'   => 'trade_logo_sticky',
	    'priority'   => 3
	) ) );
	
	$wp_customize->add_setting( 'trade_logo_sticky_width' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_logo_sticky_width', array(
		'label'     => __( 'Sticky Header Logo Width', 'trade' ),
		'type'      => 'text',
		'description'     => __( 'Enter the actual width of your logo image in pixels. Used for retina displays.', 'trade' ),
		'section'   => 'trade_logos',
		'settings'  => 'trade_logo_sticky_width',
		'priority'   => 4
	) );
	
	$wp_customize->add_setting( 'trade_logo_mobile_width' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_logo_mobile_width', array(
		'label'     => __( 'Mobile Logo Max Width ', 'trade' ),
		'type'      => 'text',
		'description'     => __( 'Set the max width of logo for mobile.', 'trade' ),
		'section'   => 'trade_logos',
		'settings'  => 'trade_logo_mobile_width',
		'priority'   => 5
	) );
	
	$wp_customize->add_setting( 'trade_favicon' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'trade_favicon', array(
		'label'      => __('Favicon', 'trade'),
		'section'    => 'trade_logos',
		'settings'   => 'trade_favicon',
	    'priority'   => 7
	) ) );
	
	
	
	// -- Position & Style
	
	$wp_customize->add_section( 'trade_header', array(
		'priority'		 => 1,
	    'title'     	 => __( 'Position & Style', 'trade' ),
		'panel'			=> 'trade_header_navigation'
	) );
	
	$wp_customize->add_setting( 'trade_header_top_layout' , array(
	    'default'     		=> __( 'full-width', 'trade' ),
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_header_top_layout', array(
		'type'      => 'select',
		'label'     => __( 'Header Layout', 'trade' ),
		'section'   => 'trade_header',
		'settings'  => 'trade_header_top_layout',
		'choices'   => array(
		            'inline-header' => 'Inline',
					'stacked-header' => 'Stacked',
					'split-header inline-header' => 'Split'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_sticky_header' , array(
	    'default'     		=> __( 'full-width', 'trade' ),
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_sticky_header', array(
		'type'      => 'select',
		'label'     => __( 'Enable Sticky Header', 'trade' ),
		'section'   => 'trade_header',
		'settings'  => 'trade_sticky_header',
		'choices'   => array(
		            '' => 'No',
					'sticky-header' => 'Yes'
		        ),
		'priority'   => 2
	) );
	
	$wp_customize->add_setting( 'trade_top_header_height' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_top_header_height', array(
		'label'     => __( 'Top Header Height', 'trade' ),
		'type'      => 'text',
		'description'     => __( 'Enter the height of your top header in pixels.', 'trade' ),
		'section'   => 'trade_header',
		'settings'  => 'trade_top_header_height',
		'priority'   => 2.7
	) );
	
	$wp_customize->add_setting( 'trade_sticky_header_height' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_sticky_header_height', array(
		'label'     => __( 'Sticky Header Height', 'trade' ),
		'type'      => 'text',
		'description'     => __( 'Enter the height of your sticky header in pixels.', 'trade' ),
		'section'   => 'trade_header',
		'settings'  => 'trade_sticky_header_height',
		'priority'   => 2.8
	) );
	
	$wp_customize->add_setting( 'trade_header_bkg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_header_bkg_color', array(
			'label'      => __( 'Header Background Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_header_bkg_color',
			'priority'   => 3
		) )
	);
	
	$wp_customize->add_setting( 'trade_sticky_header_bkg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_sticky_header_bkg_color', array(
			'label'      => __( 'Sticky Header Background Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_sticky_header_bkg_color',
			'priority'   => 4
		) )
	);
	
	
	$wp_customize->add_setting( 'trade_main_menu_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_main_menu_color', array(
			'label'      => __( 'Main Menu Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_main_menu_color',
			'priority'   => 5
		) )
	);
	
	$wp_customize->add_setting( 'trade_main_menu_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_main_menu_hover_color', array(
			'label'      => __( 'Main Menu Hover Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_main_menu_hover_color',
			'priority'   => 6
		) )
	);
	
	$wp_customize->add_setting( 'trade_sticky_main_menu_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_sticky_main_menu_color', array(
			'label'      => __( 'Sticky Main Menu Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_sticky_main_menu_color',
			'priority'   => 7
		) )
	);
	
	$wp_customize->add_setting( 'trade_sticky_main_menu_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_sticky_main_menu_hover_color', array(
			'label'      => __( 'Sticky Main Menu Hover Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_sticky_main_menu_hover_color',
			'priority'   => 8
		) )
	);
	
	$wp_customize->add_setting( 'trade_site_title_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_site_title_color', array(
			'label'      => __( 'Site Title Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_site_title_color',
			'priority'   => 9
		) )
	);
	
	$wp_customize->add_setting( 'trade_sticky_site_title_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_sticky_site_title_color', array(
			'label'      => __( 'Sticky Site Title Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_sticky_site_title_color',
			'priority'   => 10
		) )
	);
	
	$wp_customize->add_setting( 'trade_drop_down_bg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_drop_down_bg_color', array(
			'label'      => __( 'Drop Down Background Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_drop_down_bg_color',
			'priority'   => 11
		) )
	);
	
	$wp_customize->add_setting( 'trade_drop_down_link_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_drop_down_link_color', array(
			'label'      => __( 'Drop Down Link Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_drop_down_link_color',
			'priority'   => 12
		) )
	);
	
	$wp_customize->add_setting( 'trade_drop_down_link_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_drop_down_link_hover_color', array(
			'label'      => __( 'Drop Down Link Hover Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_drop_down_link_hover_color',
			'priority'   => 13
		) )
	);
	
	$wp_customize->add_setting( 'trade_drop_down_divider_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_drop_down_divider_color', array(
			'label'      => __( 'Drop Down Divider Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_drop_down_divider_color',
			'priority'   => 14
		) )
	);
	
	$wp_customize->add_setting( 'trade_header_accent_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_header_accent_color', array(
			'label'      => __( 'Accent Color', 'trade' ),
			'section'    => 'trade_header',
			'settings'   => 'trade_header_accent_color',
			'priority'   => 15
		) )
	);
	
	// -- Top Bar
	
	$wp_customize->add_section( 'trade_top_bar', array(
		'priority'		 => 2,
	    'title'     	 => __( 'Top Bar', 'trade' ),
		'panel'			=> 'trade_header_navigation'
	) );
	
	$wp_customize->add_setting( 'trade_top_bar_show' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );
	
	$wp_customize->add_control( 'trade_top_bar_show', array(
		'type'      => 'select',
		'label'     => __( 'Show Top Bar', 'trade' ),
		'section'   => 'trade_top_bar',
		'settings'  => 'trade_top_bar_show',
		'choices'   => array(
		            'no' => 'No',
					'yes' => 'Yes'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_top_bar_left' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );
	
	$wp_customize->add_control( new Trade_Textarea_Control( $wp_customize, 'top_bar_left', array(
		'label'     => __( 'Left Content', 'trade' ),
		'description'     => __( 'Enter text that will appear on the left side of the top bar.', 'trade' ),
		'section'   => 'trade_top_bar',
		'settings'  => 'trade_top_bar_left',
		'priority'   => 1
	) ) );
	
	$wp_customize->add_setting( 'trade_top_bar_right' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );
	
	$wp_customize->add_control( new Trade_Textarea_Control( $wp_customize, 'top_bar_right', array(
		'label'     => __( 'Right Content', 'trade' ),
		'description'     => __( 'Enter text that will appear on the left side of the top bar.', 'trade' ),
		'section'   => 'trade_top_bar',
		'settings'  => 'trade_top_bar_right',
		'priority'   => 1
	) ) );
	
	$wp_customize->add_setting( 'trade_enable_header_search_top_bar' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_enable_header_search_top_bar', array(
		'type'      => 'select',
		'label'     => __( 'Enable Search Icon in Top Bar', 'trade' ),
		'description'     => __( 'Shows the search icon in the top bar.', 'trade' ),
		'section'   => 'trade_top_bar',
		'settings'  => 'trade_enable_header_search_top_bar',
		'choices'   => array(
		            'no' => 'No',
					'yes' => 'Yes'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_enable_header_cart_top_bar' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_enable_header_cart_top_bar', array(
		'type'      => 'select',
		'label'     => __( 'Show Cart Icon', 'trade' ),
		'description'     => __( 'Shows the cart icon in the top bar.', 'trade' ),
		'section'   => 'trade_top_bar',
		'settings'  => 'trade_enable_header_cart_top_bar',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	// -- Slide Panel
	
	$wp_customize->add_section( 'trade_slide_panel', array(
		'priority'		 => 2,
	    'title'     	 => __( 'Slide Panel', 'trade' ),
		'panel'			=> 'trade_header_navigation'
	) );
	
	$wp_customize->add_setting( 'trade_slide_panel_background', array(
		'default'     		=> '',
		'type'				=> 'theme_mod',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'trade_slide_panel_background', array(
		'label'      => __( 'Slide Panel Background Image', 'trade' ),
		'section'    => 'trade_slide_panel',
		'settings'   => 'trade_slide_panel_background',
		'priority'   => 3
	) ) );
	
	$wp_customize->add_setting( 'trade_slide_panel_bg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_slide_panel_bg_color', array(
			'label'      => __( 'Slide Panel Background Color', 'trade' ),
			'section'    => 'trade_slide_panel',
			'settings'   => 'trade_slide_panel_bg_color',
			'priority'   => 4
		) )
	);
	
	$wp_customize->add_setting( 'trade_slide_panel_text_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_slide_panel_text_color', array(
			'label'      => __( 'Slide Panel Text Color', 'trade' ),
			'section'    => 'trade_slide_panel',
			'settings'   => 'trade_slide_panel_text_color',
			'priority'   => 5
		) )
	);
	
	$wp_customize->add_setting( 'trade_slide_panel_link_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_slide_panel_link_color', array(
			'label'      => __( 'Slide Panel Link Color', 'trade' ),
			'section'    => 'trade_slide_panel',
			'settings'   => 'trade_slide_panel_link_color',
			'priority'   => 6
		) )
	);
	
	$wp_customize->add_setting( 'trade_slide_panel_link_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_slide_panel_link_hover_color', array(
			'label'      => __( 'Slide Panel Link Hover Color', 'trade' ),
			'section'    => 'trade_slide_panel',
			'settings'   => 'trade_slide_panel_link_hover_color',
			'priority'   => 7
		) )
	);
	
	$wp_customize->add_setting( 'trade_slide_panel_divider_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_slide_panel_divider_color', array(
			'label'      => __( 'Slide Panel Divider Color', 'trade' ),
			'section'    => 'trade_slide_panel',
			'settings'   => 'trade_slide_panel_divider_color',
			'priority'   => 8
		) )
	);
	
	
	// -- Search
	
	$wp_customize->add_section( 'trade_header_search', array(
		'priority'		 => 3,
	    'title'     	 => __( 'Search', 'trade' ),
		'panel'			=> 'trade_header_navigation'
	) );
	
	$wp_customize->add_setting( 'trade_enable_header_search' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_enable_header_search', array(
		'type'      => 'select',
		'label'     => __( 'Enable Search Icon', 'trade' ),
		'description'     => __( 'Shows the search icon in the top header.', 'trade' ),
		'section'   => 'trade_header_search',
		'settings'  => 'trade_enable_header_search',
		'choices'   => array(
		            'no' => 'No',
					'yes' => 'Yes'
		        ),
		'priority'   => 1
	) );
	
	// -- Cart
	
	$wp_customize->add_section( 'trade_header_cart', array(
		'priority'		 => 3,
	    'title'     	 => __( 'Cart', 'trade' ),
		'panel'			=> 'trade_header_navigation'
	) );
	
	$wp_customize->add_setting( 'trade_enable_header_cart' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_enable_header_cart', array(
		'type'      => 'select',
		'label'     => __( 'Show Cart Icon', 'trade' ),
		'description'     => __( 'Shows the cart icon in the top header.', 'trade' ),
		'section'   => 'trade_header_cart',
		'settings'  => 'trade_enable_header_cart',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	// -- Scroll To Top
	
	$wp_customize->add_section( 'trade_header_scroll_to_top', array(
		'priority'		 => 3.5,
	    'title'     	 => __( 'Scroll to Top Button', 'trade' ),
		'panel'			=> 'trade_header_navigation'
	) );
	
	$wp_customize->add_setting( 'trade_enable_header_scroll_to_top' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_enable_header_scroll_to_top', array(
		'type'      => 'select',
		'label'     => __( 'Enable Scroll to Top Button', 'trade' ),
		'description'     => __( 'Shows a button in the lower right that allows the user to scroll to the top.', 'trade' ),
		'section'   => 'trade_header_scroll_to_top',
		'settings'  => 'trade_enable_header_scroll_to_top',
		'choices'   => array(
		            'yes' => 'Yes',
					'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_scroll_to_top_bg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_scroll_to_top_bg_color', array(
			'label'      => __( 'Scroll to Top Background Color', 'trade' ),
			'section'    => 'trade_header_scroll_to_top',
			'settings'   => 'trade_scroll_to_top_bg_color',
			'priority'   => 2
		) )
	);
	
	$wp_customize->add_setting( 'trade_scroll_to_top_arrow_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_scroll_to_top_arrow_color', array(
			'label'      => __( 'Scroll to Top Arrow Color', 'trade' ),
			'section'    => 'trade_header_scroll_to_top',
			'settings'   => 'trade_scroll_to_top_arrow_color',
			'priority'   => 3
		) )
	);
	
	// -- Mobile
	
	$wp_customize->add_section( 'trade_mobile_header', array(
		'priority'		 => 4,
	    'title'     	 => __( 'Mobile', 'trade' ),
		'panel'			=> 'trade_header_navigation'
	) );
	
	$wp_customize->add_setting( 'trade_mobile_header_breakpoint' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_mobile_header_breakpoint', array(
		'label'     => __( 'Custom Mobile Breakpoint', 'trade' ),
		'type'      => 'text',
		'description'     => __( 'Enter a custom mobile break point in pixels. (ex. 590)', 'trade' ),
		'section'   => 'trade_mobile_header',
		'settings'  => 'trade_mobile_header_breakpoint',
		'priority'   => 1
	) );
	
	// -- Page Titles --------------------------------------------------------------------------------------------------
	
	$wp_customize->add_section( 'trade_page_titles', array(
		'priority'		 => 4.2,
	    'title'     	 => __( 'Page Titles', 'trade' )
	) );
	
	$wp_customize->add_setting( 'trade_page_title_alignment' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_page_title_alignment', array(
		'type'      => 'select',
		'label'     => __( 'Text Alignment', 'trade' ),
		'description'     => __( 'Set the text alignment of all page titles.', 'trade' ),
		'section'   => 'trade_page_titles',
		'settings'  => 'trade_page_title_alignment',
		'choices'   => array(
					'left' => 'Left',
		            'center' => 'Center',
					'right' => 'Right'
		        ),
		'priority'   => 1
	) );
	
	// Page Title Text Color
	$wp_customize->add_setting( 'trade_page_title_text_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_page_title_text_color', array(
			'label'      => __( 'Text Color', 'trade' ),
			'section'    => 'trade_page_titles',
			'settings'   => 'trade_page_title_text_color',
			'priority'   => 2
		) )
	);
	
	// Page Title Area Background Color
	$wp_customize->add_setting( 'trade_page_title_bg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_page_title_bg_color', array(
			'label'      => __( 'Background Color', 'trade' ),
			'section'    => 'trade_page_titles',
			'settings'   => 'trade_page_title_bg_color',
			'priority'   => 3
		) )
	);
	
	// -- Blog --------------------------------------------------------------------------------------------------

	$wp_customize->add_panel( 'trade_blog', array(
		'priority'		 => 4.5,
	    'title'     	 => __( 'Blog', 'trade' )
	) );
	
	// -- General
	
	$wp_customize->add_section( 'trade_blog_general', array(
		'priority'		 => .5,
	    'title'     	 => __( 'General', 'trade' ),
		'panel'			=> 'trade_blog'
	) );
	
	$wp_customize->add_setting( 'trade_show_full_posts' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_full_posts', array(
		'type'      => 'select',
		'label'     => __( 'Show Full Posts', 'trade' ),
		'description'     => __( 'Show full posts on blog pages.', 'trade' ),
		'section'   => 'trade_blog_general',
		'settings'  => 'trade_show_full_posts',
		'choices'   => array(
					'no' => 'No',
		            'yes' => 'Yes'
		        ),
		'priority'   => 1
	) );
	
	// -- Meta
	
	$wp_customize->add_section( 'trade_post_meta', array(
		'priority'		 => 1,
	    'title'     	 => __( 'Post Meta', 'trade' ),
		'panel'			=> 'trade_blog'
	) );
	
	$wp_customize->add_setting( 'trade_show_meta_date' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_meta_date', array(
		'type'      => 'select',
		'label'     => __( 'Show Date', 'trade' ),
		'description'     => __( 'Show the date on each post', 'trade' ),
		'section'   => 'trade_post_meta',
		'settings'  => 'trade_show_meta_date',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_show_meta_author' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_meta_author', array(
		'type'      => 'select',
		'label'     => __( 'Show Author', 'trade' ),
		'description'     => __( 'Show the author on each post.', 'trade' ),
		'section'   => 'trade_post_meta',
		'settings'  => 'trade_show_meta_author',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_show_meta_categories' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_meta_categories', array(
		'type'      => 'select',
		'label'     => __( 'Show Categories', 'trade' ),
		'description'     => __( 'Show the categories on each post.', 'trade' ),
		'section'   => 'trade_post_meta',
		'settings'  => 'trade_show_meta_categories',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_show_meta_comments' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_meta_comments', array(
		'type'      => 'select',
		'label'     => __( 'Show Comment Count', 'trade' ),
		'description'     => __( 'Show the comment count on each post.', 'trade' ),
		'section'   => 'trade_post_meta',
		'settings'  => 'trade_show_meta_comments',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	
	// -- Archive Layout
	
	$wp_customize->add_section( 'trade_archives', array(
		'priority'		 => 2,
	    'title'     	 => __( 'Archives', 'trade' ),
		'panel'			=> 'trade_blog'
	) );	
	
	$wp_customize->add_setting( 'trade_archive_layout' , array(
	    'default'     		=> __( 'full-width', 'trade' ),
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_archive_layout', array(
		'type'      => 'select',
		'label'     => __( 'Archive Layout', 'trade' ),
		'section'   => 'trade_archives',
		'settings'  => 'trade_archive_layout',
		'choices'   => array(
		            'standard' => 'Standard',
					'full-width' => 'Full Width',
		            'masonry' => 'Masonry',
					'masonry-full-width' => 'Masonry Full Width',
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_archive_show_excerpt' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_archive_show_excerpt', array(
		'type'      => 'select',
		'label'     => __( 'Show Excerpts', 'trade' ),
		'section'   => 'trade_archives',
		'settings'  => 'trade_archive_show_excerpt',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 2
	) );
	
	
	// -- Shop --------------------------------------------------------------------------------------------------

	$wp_customize->add_panel( 'trade_shop', array(
		'priority'		 => 4.7,
	    'title'     	 => __( 'Shop', 'trade' )
	) );
	
	// -- Layout
	
	$wp_customize->add_section( 'trade_shop_layout_section', array(
		'priority'		 => 1,
	    'title'     	 => __( 'Layout', 'trade' ),
		'panel'			=> 'trade_shop'
	) );
	
	$wp_customize->add_setting( 'trade_shop_layout' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_shop_layout', array(
		'type'      => 'select',
		'label'     => __( 'Layout', 'trade' ),
		'description'     => __( 'Choose the layout of your shop pages.', 'trade' ),
		'section'   => 'trade_shop_layout_section',
		'settings'  => 'trade_shop_layout',
		'choices'   => array(
					'full-width' => 'Full Width',
		            'has-sidebar' => 'With Sidebar'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_shop_product_count' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control('trade_shop_product_count', array(
	        'label' => __( 'Products Per Page', 'trade' ),
	        'section' => 'trade_shop_layout_section',
	        'type' => 'text',
	    )
	);
	
	// -- Style
	
	$wp_customize->add_section( 'trade_shop_style_section', array(
		'priority'		 => 2,
	    'title'     	 => __( 'Style', 'trade' ),
		'panel'			=> 'trade_shop'
	) );
	
	// Product Hover Color
	$wp_customize->add_setting( 'trade_product_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_product_hover_color', array(
			'label'      => __( 'Product Hover Color', 'trade' ),
			'section'    => 'trade_shop_style_section',
			'settings'   => 'trade_product_hover_color',
			'priority'   => 1
		) )
	);
	
	// Shop Accent Color
	$wp_customize->add_setting( 'trade_shop_accent_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_shop_accent_color', array(
			'label'      => __( 'Accent Color', 'trade' ),
			'section'    => 'trade_shop_style_section',
			'settings'   => 'trade_shop_accent_color',
			'priority'   => 2
		) )
	);
	
	
	
	// -- Social Sharing --------------------------------------------------------------------------------------------------
	
	$wp_customize->add_section( 'trade_social_sharing', array(
		'priority'		 => 5,
	    'title'     	 => __( 'Social Sharing', 'trade' )
	) );
	
	$wp_customize->add_setting( 'trade_show_social_on_posts' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_social_on_posts', array(
		'type'      => 'select',
		'label'     => __( 'Show Sharing Links on Posts', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_social_on_posts',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_setting( 'trade_show_social_on_projects' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_social_on_projects', array(
		'type'      => 'select',
		'label'     => __( 'Show Sharing Links on Projects', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_social_on_projects',
		'choices'   => array(
					'no' => 'No',
					'yes' => 'Yes'
		        ),
		'priority'   => 1.1
	) );
	
	$wp_customize->add_setting( 'trade_show_social_on_pages' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_social_on_pages', array(
		'type'      => 'select',
		'label'     => __( 'Show Sharing Links on Pages', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_social_on_pages',
		'choices'   => array(
					'no' => 'No',
					'yes' => 'Yes'
		        ),
		'priority'   => 1.2
	) );
	
	$wp_customize->add_setting( 'trade_show_facebook' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_facebook', array(
		'type'      => 'select',
		'label'     => __( 'Show Facebook', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_facebook',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 2
	) );
	
	$wp_customize->add_setting( 'trade_show_twitter' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_twitter', array(
		'type'      => 'select',
		'label'     => __( 'Show Twitter', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_twitter',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 3
	) );
	
	$wp_customize->add_setting( 'trade_show_google' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_google', array(
		'type'      => 'select',
		'label'     => __( 'Show Google Plus', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_google',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 4
	) );
	
	$wp_customize->add_setting( 'trade_show_linkedin' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_linkedin', array(
		'type'      => 'select',
		'label'     => __( 'Show LinkedIn', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_linkedin',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 5
	) );
	
	$wp_customize->add_setting( 'trade_show_pinterest' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_pinterest', array(
		'type'      => 'select',
		'label'     => __( 'Show Pinterest', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_pinterest',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 6
	) );
	
	$wp_customize->add_setting( 'trade_show_tumblr' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_show_tumblr', array(
		'type'      => 'select',
		'label'     => __( 'Show Tumblr', 'trade' ),
		'section'   => 'trade_social_sharing',
		'settings'  => 'trade_show_tumblr',
		'choices'   => array(
					'yes' => 'Yes',
		            'no' => 'No'
		        ),
		'priority'   => 7
	) );
	
	// -- Other Styles Panel
	
	$wp_customize->add_panel( 'trade_other_styles', array(
		'priority'		 => 5.5,
	    'title'     	 => __( 'Other Styles', 'trade' )
	) );
	
	// Global Text
	$wp_customize->add_section( 'trade_base_text', array(
		'priority'		 => 1,
	    'title'     	 => __( 'Text', 'trade' ),
		'panel'          => 'trade_other_styles'
	) );
	
	// Link Color
	$wp_customize->add_setting( 'trade_base_text_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_base_text_color', array(
			'label'      => __( 'Color', 'trade' ),
			'section'    => 'trade_base_text',
			'settings'   => 'trade_base_text_color',
			'description'     	 => __( 'Set the base text color of your site.', 'trade' ),
			'priority'   => 1
		) )
	);

	// Links
	$wp_customize->add_section( 'trade_links', array(
		'priority'		 => 2,
	    'title'     	 => __( 'Links', 'trade' ),
		'description'     	 => __( 'Set the color of links that appear in the content text.', 'trade' ),
		'panel'          => 'trade_other_styles'
	) );
	
	// Link Color
	$wp_customize->add_setting( 'trade_link_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_link_color', array(
			'label'      => __( 'Link Color', 'trade' ),
			'section'    => 'trade_links',
			'settings'   => 'trade_link_color',
			'priority'   => 1
		) )
	);

	// Link Hover Color (Incl. Active)
	$wp_customize->add_setting( 'trade_link_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_link_hover_color', array(
			'label'      => __( 'Link Hover Color', 'trade' ),
			'section'    => 'trade_links',
			'settings'   => 'trade_link_hover_color',
			'priority'   => 2
		) )
	);
	
	// Buttons
	$wp_customize->add_section( 'trade_buttons', array(
		'priority'		 => 3,
	    'title'     	 => __( 'Buttons', 'trade' ),
		'description'     	 => __( 'Set the color of buttons that appear on the site. This includes form and pagination buttons.', 'trade' ),
		'panel'          => 'trade_other_styles'
	) );
	
	// Button Color
	$wp_customize->add_setting( 'trade_button_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_button_color', array(
			'label'      => __( 'Button Color', 'trade' ),
			'section'    => 'trade_buttons',
			'settings'   => 'trade_button_color',
			'priority'   => 1
		) )
	);
	
	// Button Text Color
	$wp_customize->add_setting( 'trade_button_text_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_button_text_color', array(
			'label'      => __( 'Button Text Color', 'trade' ),
			'section'    => 'trade_buttons',
			'settings'   => 'trade_button_text_color',
			'priority'   => 2
		) )
	);
	
	
	// -- Custom  CSS Section

	$wp_customize->add_section( 'trade_css' , array(
	    'title'     	=> __( 'Custom CSS', 'trade' ),
	    'description'	=> __('Add your own custom CSS.', 'trade'),
	    'priority'   	=> 59,
	) );
	
	$wp_customize->add_setting( 'trade_custom_css' , array(
	    'default'     => __('', 'trade'),
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new TTrust_Textarea_Control( $wp_customize, 'trade_custom_css', array(
		'label'        => __('CSS', 'trade'),
		'section'    => 'trade_css',
		'settings'   => 'trade_custom_css',
		'priority'   => 62
	) ) );

	// -- Footer Section -----------------------------------

	$wp_customize->add_panel( 'trade_footer' , array(
	    'title'      => __( 'Footer', 'port' ),
	    'priority'   => 62.5,
	) );
	
	$wp_customize->add_section( 'trade_footer_layout', array(
		'priority'		 => 1,
		'panel'		 => 'trade_footer',
	    'title'     	 => __( 'Layout', 'trade' )
	) );
	
	$wp_customize->add_setting( 'trade_footer_columns' , array(
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );
	
	$wp_customize->add_control( 'trade_footer_columns', array(
		'type'      => 'select',
		'label'     => __( 'Widget Columns', 'trade' ),
		'section'   => 'trade_footer_layout',
		'settings'  => 'trade_footer_columns',
		'choices'   => array(
					'3' => '3',
					'4' => '4',
					'1' => '1',
		            '2' => '2',
					'5' => '5'
		        ),
		'priority'   => 1
	) );
	
	$wp_customize->add_section( 'trade_footer_style', array(
		'priority'		 => 2,
		'panel'		 => 'trade_footer',
	    'title'     	 => __( 'Style', 'trade' )
	) );
	
	// Footer Background Color
	$wp_customize->add_setting( 'trade_footer_bg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_footer_bg_color', array(
			'label'      => __( 'Background Color', 'trade' ),
			'section'    => 'trade_footer_style',
			'settings'   => 'trade_footer_bg_color',
			'priority'   => 1
		) )
	);
	
	// Footer Widget Title Color
	$wp_customize->add_setting( 'trade_footer_widget_title_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_footer_widget_title_color', array(
			'label'      => __( 'Widget Title Color', 'trade' ),
			'section'    => 'trade_footer_style',
			'settings'   => 'trade_footer_widget_title_color',
			'priority'   => 1.5
		) )
	);
	
	// Footer Text Color
	$wp_customize->add_setting( 'trade_footer_text_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_footer_text_color', array(
			'label'      => __( 'Text Color', 'trade' ),
			'section'    => 'trade_footer_style',
			'settings'   => 'trade_footer_text_color',
			'priority'   => 2
		) )
	);
	
	// Footer Link Color
	$wp_customize->add_setting( 'trade_footer_link_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_footer_link_color', array(
			'label'      => __( 'Link Color', 'trade' ),
			'section'    => 'trade_footer_style',
			'settings'   => 'trade_footer_link_color',
			'priority'   => 3
		) )
	);

	// Footer Link Hover Color
	$wp_customize->add_setting( 'trade_footer_link_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trade_footer_link_hover_color', array(
			'label'      => __( 'Link Hover Color', 'trade' ),
			'section'    => 'trade_footer_style',
			'settings'   => 'trade_footer_link_hover_color',
			'priority'   => 4
		) )
	);
	
	// Footer Content
	$wp_customize->add_section( 'trade_footer_text', array(
		'priority'		 => 2,
		'panel'		 => 'trade_footer',
	    'title'     	 => __( 'Content', 'trade' )
	) );

	// Left Footer Text (Custom Control)
	$wp_customize->add_setting( 'trade_footer_left' , array(
	    'default'     => '',
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new Trade_Textarea_Control( $wp_customize, 'footer_left', array(
	    'label'   => __('Primary Footer Text', 'port'),
	    'section' => 'trade_footer_text',
	    'settings'   => 'trade_footer_left',
	    'priority'   => 71
	) ) );

	// Right Footer Text (Custom Control)
	$wp_customize->add_setting( 'trade_footer_right' , array(
	    'default'     => '',
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new Trade_Textarea_Control( $wp_customize, 'footer_right', array(
	    'label'   => __('Secondary Footer Text', 'port'),
	    'section' => 'trade_footer_text',
	    'settings'   => 'trade_footer_right',
	    'priority'   => 72
	) ) );

}
add_action( 'customize_register', 'trade_customize_register' );

// Require the gfonts picker class
require_once('google-fonts/gfonts.class.php');


// Instantiate the class
$tt_gfp = new create_gfonts();


