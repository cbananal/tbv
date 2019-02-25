<?php

# ------------------------------------------------------------------------
# Restaurant Homepage Layout
# ------------------------------------------------------------------------

$layouts[ 'restaurant' ] = array_merge(
	array(
		'name' => __('Restaurant', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/restaurant.json' ), true )
);
?>