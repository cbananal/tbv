<?php

# ------------------------------------------------------------------------
# Services Minimal Layout
# ------------------------------------------------------------------------

$layouts[ 'services-minimal' ] = array_merge(
	array(
		'name' => __('Services Minimal', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/services-minimal.json' ), true )
);
?>