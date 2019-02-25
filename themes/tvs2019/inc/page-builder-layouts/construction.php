<?php

# ------------------------------------------------------------------------
# Construction Homepage Layout
# ------------------------------------------------------------------------

$layouts[ 'construction' ] = array_merge(
	array(
		'name' => __('Construction', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/construction.json' ), true )
);
?>