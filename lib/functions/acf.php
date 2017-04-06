<?php namespace Swiss\Acf;

function get_image($size='large', $key, $type='img', $class=null){

	//allows us to pass an array or a key to fetch
	$image = (is_string($key))? get_field($key) : $key;

	if(!empty($image) && isset($image['sizes'][$size])){

		//if an image is requested do so, else return a url
		if($type == 'img'){
			return sprintf('<img src="%s" alt="%s" class="%s" %s>', $image['sizes'][$size], $image['alt'], $class, $data_attrs);
		}
		else {
			return $image['sizes'][$size];
		}

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