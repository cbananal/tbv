<?php

# ------------------------------------------------------------------------
# Features Layout
# ------------------------------------------------------------------------

$layouts[ 'features' ] = array_merge(
	array(
		'name' => __('Features', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/features.json' ), true )
);
?>