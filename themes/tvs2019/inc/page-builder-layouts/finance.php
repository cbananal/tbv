<?php

# ------------------------------------------------------------------------
# Finance Homepage Layout
# ------------------------------------------------------------------------

$layouts[ 'finance' ] = array_merge(
	array(
		'name' => __('Finance', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/finance.json' ), true )
);
?>