<?php

# ------------------------------------------------------------------------
# Pricing Table Layout
# ------------------------------------------------------------------------

$layouts[ 'pricing-table' ] = array_merge(
	array(
		'name' => __('Pricing Table', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/pricing-table.json' ), true )
);
?>