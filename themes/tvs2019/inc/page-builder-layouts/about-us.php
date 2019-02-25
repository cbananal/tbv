<?php

# ------------------------------------------------------------------------
# About Us Layout
# ------------------------------------------------------------------------

$layouts[ 'about-us' ] = array_merge(
	array(
		'name' => __('About Us', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/about-us.json' ), true )
);
?>