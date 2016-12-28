<?php namespace Swiss\Acf;

function get_image($key, $size='large'){
	$image = get_field($key);

	if(!empty($image) && isset($image['sizes'][$size])){
		return sprintf('<img src="%s" alt="%s">', $image['sizes'][$size], $image['alt']);
	}

	return null;
}

function get_image_url($key, $size='large'){
	$image = get_field($key);

	if(!empty($image) && isset($image['sizes'][$size])){
		return $image['sizes'][$size];
	}

	return null;
}