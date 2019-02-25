<?php

# ------------------------------------------------------------------------
# Medical Homepage Layout
# ------------------------------------------------------------------------

$layouts[ 'medical' ] = array_merge(
	array(
		'name' => __('Medical', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/medical.json' ), true )
);
?>