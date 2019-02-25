<?php

# ------------------------------------------------------------------------
# Contact Simple Layout
# ------------------------------------------------------------------------

$layouts[ 'contact-simple' ] = array_merge(
	array(
		'name' => __('Contact Simple', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/contact-simple.json' ), true )
);
?>