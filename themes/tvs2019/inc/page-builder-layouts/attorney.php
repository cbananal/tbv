<?php

# ------------------------------------------------------------------------
# Attorney Homepage Layout
# ------------------------------------------------------------------------

$layouts[ 'attorney' ] = array_merge(
	array(
		'name' => __('Attorney', 'trade')
	),
	json_decode( file_get_contents( get_template_directory() . '/inc/page-builder-layouts/attorney.json' ), true )
);
?>