<?php

# ------------------------------------------------------------------------
# Services Classic Layout
# ------------------------------------------------------------------------

$layouts[ 'services-classic' ] = array_merge(
	array(
		'name' => __('Services Classic', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/services-classic.json' ), true )
);
?>