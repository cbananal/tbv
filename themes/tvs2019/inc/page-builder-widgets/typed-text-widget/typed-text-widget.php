<?php

/*
Widget Name: Typed Text
Description: An example widget which displays 'Hello world!'.
Author: Me
Author URI: http://example.com
*/
if (class_exists('SiteOrigin_Widget')) {
class Typed_Text_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'typed_text_widget',
			__('Typed Text Widget', 'trade'),
			array(
				'description' => __('A hello world widget.', 'trade'),
			),
			array(

			),
			array(
                'text_1' => array(
					'type' => 'text',
					'label' => __( 'Text 1', 'trade' ),
				),
				'text_2' => array(
					'type' => 'text',
					'label' => __( 'Text 2', 'trade' ),
				),
				'text_3' => array(
					'type' => 'text',
					'label' => __( 'Text 3', 'trade' ),
				),
				'text_4' => array(
					'type' => 'text',
					'label' => __( 'Text 4', 'trade' ),
				),
				'color' => array(
					'type' => 'color',
					'label' => __('Color', 'trade'),
				),
				'font' => array(
					'type' => 'font',
					'label' => __( 'Font', 'trade' ),
					'default' => 'default'
				),
				'font_size' => array(
					'type' => 'measurement',
					'label' => __('Font Size', 'trade')
				),
				'tablet_font_size' => array(
					'type' => 'measurement',
					'label' => __('Tablet Font Size', 'trade')
				),
				'mobile_font_size' => array(
					'type' => 'measurement',
					'label' => __('Mobile Font Size', 'trade')
				),
				'align' => array(
					'type' => 'select',
					'label' => __( 'Alignment', 'trade' ),
					'default' => 'center',
					'options' => array(
						'center' => __( 'Center', 'trade' ),
						'left' => __( 'Left', 'trade' ),
						'right' => __( 'Right', 'trade' ),
						'justify' => __( 'Justify', 'trade' )
					)
				),
				'line_height' => array(
					'type' => 'measurement',
					'label' => __('Line Height', 'trade')
				),
            ),
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'typed-text-widget-template';
	}

	function get_style_name($instance) {
	    return 'default';
	}
	
	function initialize() {

        $this->register_frontend_scripts(
            array(
                array(
                    'trade-typed-text',
                    get_template_directory_uri() . '/inc/page-builder-widgets/typed-text-widget/js/typed.min.js',
                    array('jquery')
                ),
            )
        );
    }

	function get_template_variables($instance, $args) {
        return array(
            'text_1' => $instance['text_1'],
            'text_2' => $instance['text_2'],
            'text_3' => $instance['text_3'],
			'text_4' => $instance['text_4'],
			'color' => $instance['color'],
			'font_size' => $instance['font_size'],
			'align' => $instance['align'],
			'font' => $instance['font'],
			'line_height' => $instance['line_height'],
        );
    }

	function get_less_variables( $instance ) {
		$less_vars = array();

		// All the headline attributes
		$less_vars['color'] = isset( $instance['color'] ) ? $instance['color'] : false;
		$less_vars['align'] = isset( $instance['align'] ) ? $instance['align'] : false;
		$less_vars['font_size'] = isset( $instance['font_size'] ) ? $instance['font_size'] : false;
		$less_vars['tablet_font_size'] = isset( $instance['tablet_font_size'] ) ? $instance['tablet_font_size'] : false;
		$less_vars['mobile_font_size'] = isset( $instance['mobile_font_size'] ) ? $instance['mobile_font_size'] : false;
		$less_vars['line_height'] = isset( $instance['line_height'] ) ? $instance['line_height'] : false;

		// Font family and weight
		if ( ! empty( $instance['font'] ) ) {
			$font = siteorigin_widget_get_font( $instance['font'] );
			$less_vars['font'] = $font['family'];
			if ( ! empty( $font['weight'] ) ) {
				$less_vars['font_weight'] = $font['weight'];
			}
		}
		return $less_vars;
	}

	function get_google_font_fields( $instance ) {
		return array(
			$instance['font'],
		);
	}

}

siteorigin_widget_register('typed_text_widget', __FILE__, 'Typed_Text_Widget');
}