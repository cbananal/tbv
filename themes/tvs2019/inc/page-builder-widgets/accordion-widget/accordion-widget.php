<?php

/*
Widget Name: Trade Accordion
Description: Displays collapsible content.
Author: ThemeTrust & Live Mesh
Author URI: http://themetrust.com
*/

if (class_exists('SiteOrigin_Widget')) {
class Trade_Accordion_Widget extends SiteOrigin_Widget {

    function __construct() {
        parent::__construct(
            'trade-accordion',
            __('Trade Accordion', 'trade'),
            array(
                'description' => __('Displays collapsible content.', 'trade'),
                'panels_icon' => 'dashicons dashicons-list-view',
                'help' => ''
            ),
            array(),
            array(
                'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'trade'),
                ),

                'style' => array(
                    'type' => 'select',
                    'label' => __('Choose Accordion Style', 'trade'),
                    'state_emitter' => array(
                        'callback' => 'select',
                        'args' => array('style')
                    ),
                    'default' => 'style1',
                    'options' => array(
                        'style1' => __('Gray', 'trade'),
                        'style2' => __('Contrast', 'trade'),
                        'style3' => __('Minimal', 'trade'),
                    )
                ),

                'toggle' => array(
                    'type' => 'checkbox',
                    'label' => __('Allow to function like toggle?', 'trade'),
                    'description' => __('Check if multiple panels can be opened.', 'trade')
                ),

				'open_first' => array(
                    'type' => 'checkbox',
                    'label' => __('Expand first panel?', 'trade'),
                    'description' => __('Check if you want first panel to be open by default.', 'trade')
                ),

                'accordion' => array(
                    'type' => 'repeater',
                    'label' => __('Accordion', 'trade'),
                    'item_name' => __('Panel', 'trade'),
                    'item_label' => array(
                        'selector' => "[id*='accordion-title']",
                        'update_event' => 'change',
                        'value_method' => 'val'
                    ),
                    'fields' => array(
                        'title' => array(
                            'type' => 'text',
                            'label' => __('Panel Title', 'trade'),
                            'description' => __('The title for the panel.', 'trade'),
                        ),

                        'panel_content' => array(
                            'type' => 'tinymce',
                            'label' => __('Panel Content', 'trade'),
                            'description' => __('The content in the panel.', 'trade'),
                        ),
                    )
                ),
            )
        );
    }

    function initialize() {


        $this->register_frontend_scripts(
            array(
                array(
                    'create-accordion',
                    get_template_directory_uri() . '/inc/page-builder-widgets/accordion-widget/js/accordion' . '.js',
                    array('jquery')
                ),
            )
        );

        $this->register_frontend_styles(array(
            array(
                'create-accordion',
                get_template_directory_uri() . '/inc/page-builder-widgets/accordion-widget/css/style.css'
            )
        ));
    }

    function get_template_variables($instance, $args) {
        return array(
            'style' => $instance['style'],
            'toggle' => $instance['toggle'],
            'accordion' => !empty($instance['accordion']) ? $instance['accordion'] : array()
        );
    }

}

siteorigin_widget_register('trade-accordion', __FILE__, 'Trade_Accordion_Widget');
}