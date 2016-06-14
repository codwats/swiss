<?php namespace Swiss;

function get_image_sizes( $size = '', $recheck=false) {

    global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

                if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                        $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                        $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                        $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                        $sizes[ $_size ] = array( 
                                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                        );

                }

        }

        // Get only 1 size if found
        if ( $size ) {

                if( isset( $sizes[ $size ] ) ) {
                        return $sizes[ $size ];
                } else {
                        return false;
                }

        }

        return $sizes;
}

function default_img($size='thumbnail', $text='img', $type='default'){

	$sizes = get_image_sizes();

	if(isset($sizes[$size])){
		return sprintf('https://unsplash.it/%sx%s?image='.DEFAULT_IMG_ID, $sizes[$size]['width'], $sizes[$size]['height']);
	}

	return 'https://unsplash.it/850/850?image='.DEFAULT_IMG_ID;
}

function feature_image_url($post, $size='medium-large'){

	$img = wp_get_attachment_image_src(get_post_thumbnail_id($post, $size))[0];

	if(empty($img)){
		$img = default_img($size,'');
	}

	return $img;
}

function is_acf_active(){
	return (function_exists('has_sub_field'))? true : false;
}

function get_acf_options($group_fields){

	if(empty($group_fields) || !is_array($group_fields) || !\Swiss\is_acf_active()){
		return false;
	}

	$group_data = array();

	foreach($group_fields as $field){
		$group_data[$field] = get_field($field, 'option');
	}

	return $group_data;
}

function is_dev(){
	return (defined('WP_ENV') && WP_ENV=='dev')? true : false;
}

function js_log($info=''){
    echo "<script>console.log(".json_encode($info).");</script>";
}

function log($str='', $file='swiss.log'){

	//check is writable and env is correct
	if(!\Swiss\is_dev() || !is_writable(get_template_directory().'/'.$file)){
		return false;
	}

	//if annray then encode
	if(is_array($str)){
		$str = "\r\n".json_encode($str)."\r\n";
	}
	else {
		$str = "\r\n".$str."\r\n";
	}

	//write/append to file
 	$myfile = file_put_contents(get_template_directory().'/'.$file, $str.PHP_EOL , FILE_APPEND);

 	return true;
}

function debug($msg=null){
	if(defined('WP_DEBUG') && WP_DEBUG){
		echo "<pre>"; print_r($msg); echo "</pre>";
		return true;
	}
	return false;
}

function post_blocks($name='blocks'){

	//lets check is ACF available
	if (!\Swiss\is_acf_active()) return false;

	//loop the blocks fields
	while(has_sub_field($name)){
		$template = get_template_directory().'/lib/'.$name.'/'.str_replace(' ', '_', strtolower(get_row_layout())).'/index.php';
		if(!file_exists($template)){
			\Swiss\debug($template ." - Template not found");
			continue;
		}
		include($template);
	}

	return true;
}

/**
 * [animate description]
 * @param  string $classes           [description]
 * @param  array  $defaults_selected [description]
 * @return [type]                    [description]
 */
function animate($classes='animated fadeInUp', $defaults_selected=array()){

	$defaults = array(
		'background'=>'animatedsuperslow fadeIn animateddelay1',
		'heading'=>'animatedslow fadeIn',
		'el-up'=>'animated fadeInUp',
		'el-in'=>'animated fadeIn',
	);

	if(is_array($defaults_selected)){
		foreach ($defaults_selected as $value) {
			if(array_key_exists($value, $defaults)) $classes .= ' '.$defaults[$value];
		}
	}

	//lets cleanse
	$classes = implode(' ', array_unique(explode(' ', $classes)));

	echo sprintf('data-animate="%s"', $classes);
	return true;
}

/**
 * [image description]
 * @param  [type] $obj  [description]
 * @param  string $size [description]
 * @return [type]       [description]
 */
function image($img=null, $size='large', $classes=''){
	if(isset($img) && is_array($img) && isset($img['sizes'][$size])){
		$caption = (!empty($img['cpation']))? $img['cpation'] : basename($img['sizes'][$size]);
		return '<img src="'.$img['sizes'][$size].'" alt="'.$caption.'" class="'.$classes.'" />';
	}
	else {
		return false;
	}
}

/**
 * a generic sprintf for handling both arrays and single strings for quick if templating
 * @param  string $str   [description]
 * @param  [type] $input [description]
 * @return [type]        [description]
 */
function sprint($str='', $input){

	//if an array
	if(is_array($input) && !empty($input)){

		$broken = false;
		$data = array();

		foreach($input as $field){
			if(!empty($field)){
				$data[] = $field;
			}
			else {
				$broken = true;
				break;
			}
		}

		if(!empty($data) && !$broken){
			return vsprintf($str, $data);
		}
	}
	elseif(!empty($input)) {
		//else just a single sprint
		return sprintf($str, $input);
	}

	return null;
}

/**
 * [excerpt description]
 * @param  [type]  $str   [description]
 * @param  integer $limit [description]
 * @return [type]         [description]
 */
function excerpt($str, $limit = 255){
	$strlen = strlen($str);
	return ($strlen>=$limit) ? substr($str, 0, $limit)."&hellip;" : $str;
}

/**
 * [truncate description]
 * @param  [type]  $s      [description]
 * @param  [type]  $l      [description]
 * @param  string  $e      [description]
 * @param  boolean $isHTML [description]
 * @return [type]          [description]
 */
function truncate($s, $l, $e = '...', $isHTML = false){
	$i = 0;
	$tags = array();
	if($isHTML){
		preg_match_all('/<[^>]+>([^<]*)/', $s, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
		foreach($m as $o){
			if($o[0][1] - $i >= $l)
				break;
			$t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
			if($t[0] != '/')
				$tags[] = $t;
			elseif(end($tags) == substr($t, 1))
				array_pop($tags);
			$i += $o[1][1] - $o[0][1];
		}
	}
	return substr($s, 0, $l = min(strlen($s),  $l + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '') . (strlen($s) > $l ? $e : '');
}

function activate_plugin($plugin=null){

	if(empty($plugin) || !is_readable(WP_PLUGIN_DIR.'/'.$plugin)) return false;

	$active_plugins = get_option('active_plugins');

	if(empty($active_plugins)) $active_plugins = [];

	if(!in_array($plugin, $active_plugins)){
		 array_push($active_plugins, $plugin);
	}

	update_option('active_plugins', $active_plugins);

	return true;
}

function cur_page_url() {
	 $pageURL = 'http';
	 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
}

function share_page(){

	$html = null;
	$template = get_template_directory().'/templates/_share-page.php';

	if(is_readable($template)){
		$services = array(
			'facebook'=> array(
				'url'=>'',
				'icon' => 'fa fa-facebook'
			),
			'twitter'=> array(
				'url'=>'',
				'icon' => 'fa fa-twitter'
			),
			'linkedin'=> array(
				'url'=>'',
				'icon' => 'fa fa-linkedin'
			),
			'google'=> array(
				'url'=>'',
				'icon' => 'fa fa-google'
			),
			'email'=> array(
				'url'=>'',
				'icon' => 'fa fa-envelope'
			)
		);

		foreach($services as $key => $value){
			 $services[$key]['url'] = \Swiss\share_link($key);
		}

		ob_start();
		include(get_template_directory().'/templates/_share-page.php');
		$html = ob_get_contents();
		ob_clean();

	}

	return $html;

}

function share_link($type='facebook', $url=null, $title=''){

	$data = array();
	$urls = array(
		'facebook'=> 'http://www.facebook.com/sharer/sharer.php?u=%s',
		'twitter'=> 'http://twitter.com/share?url=%s&text=%s',
		'google'=> 'https://plus.google.com/share?url=%s',
		'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=%s&title=%s&summary=%s&source=%s',
		'email'=> 'mailto:?subject=%s&body=%s'
		);

	if(array_key_exists($type, $urls)){
		$data['url'] = (empty($url))? \Swiss\cur_page_url() : $url;

		if($type=='twitter'){
			$data['title'] = (empty($title))? get_the_title() : $title;
		}

		if($type=='email'){
			$data['body'] = (empty($title))? get_the_title() : $title;

			array_unshift($data, $data['body']);
		}

		if($type=='linkedin'){
			$data['title'] = (empty($title))? get_the_title() : $title;
			$data['summary'] = get_the_excerpt();
			$data['source'] = get_bloginfo('name');
		}

		return vsprintf($urls[$type], $data);
	}

	return null;
}