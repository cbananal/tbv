<?php

# ------------------------------------------------------------------------
# Contact Modern Layout
# ------------------------------------------------------------------------

$layouts[ 'contact-modern' ] = array_merge(
	array(
		'name' => __('Contact Modern', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/contact-modern.json' ), true )
);
?>