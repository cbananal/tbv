<?php

# ------------------------------------------------------------------------
# Services Modern Layout
# ------------------------------------------------------------------------

$layouts[ 'services-modern' ] = array_merge(
	array(
		'name' => __('Services Modern', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/services-modern.json' ), true )
);
?>