<?php

# ------------------------------------------------------------------------
# About Me Layout
# ------------------------------------------------------------------------

$layouts[ 'about-me' ] = array_merge(
	array(
		'name' => __('About Me', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/about-me.json' ), true )
);
?>