<?php

# ------------------------------------------------------------------------
# Fitness Homepage Layout
# ------------------------------------------------------------------------

$layouts[ 'fitness' ] = array_merge(
	array(
		'name' => __('Fitness', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/fitness.json' ), true )
);
?>