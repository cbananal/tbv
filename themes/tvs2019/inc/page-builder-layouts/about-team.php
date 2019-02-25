<?php

# ------------------------------------------------------------------------
# About Team Layout
# ------------------------------------------------------------------------

$layouts[ 'about-team' ] = array_merge(
	array(
		'name' => __('About Team', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/about-team.json' ), true )
);
?>