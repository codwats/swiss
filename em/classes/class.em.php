<?php
/**
 * helper class with some static methods for encapsualtion to help us out
 */
class em {

	/**
	 * [blocks description]
	 * @param  string $name [description]
	 * @return [type]       [description]
	 */
	static public function blocks($name='blocks'){

		//lets check is ACF available
		if (!em::is_acf_active()) return false;

		//loop the blocks fields		
		while(has_sub_field($name)){
			$template = get_template_directory().'/em/blocks/'.em::clean_template_name(get_row_layout()).'/index.php';
			if(!file_exists($template)){
				em::log($template ." - Template not found");
				continue;
			}
			include($template);
		}
	}

	/**
	 * [clean_template_name description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	static public function clean_template_name($name){
		return str_replace(' ', '_', strtolower($name));
	}

	/**
	 * [log description]
	 * @param  [type] $msg [description]
	 * @return [type]      [description]
	 */
	static public function log($msg=null){
		if(defined('WP_DEBUG') && WP_DEBUG){
			echo "<pre>"; print_r($msg); echo "</pre>"; 
			return true;
		}
		return false;
	}

	/**
	 * for creating dynamic columns with boostrap grid
	 * @param  [type] $total [description]
	 * @return [type]        [description]
	 */
	static public function number_of_columns($total){
		//need to make some math magic
		$columns = 12;

		if($total>1){
			$columns = 6;
		}
		if($total>2){
			$columns = 4;
		}
		if($total>3){
			$columns = 3;
		}
		if($total>4){
			$columns = 2;	
		}

		return $columns;
	}

	/**
	 * [excerpt description]
	 * @param  [type]  $str   [description]
	 * @param  integer $limit [description]
	 * @return [type]         [description]
	 */
	static public function excerpt($str, $limit = 255){
		$strlen = strlen($str);	
		return ($strlen>=$limit) ? substr($str, 0, $limit)."&hellip;" : $str;		
	}
	
	/**
	 * [spemail description]
	 * @param  [type] $email [description]
	 * @return [type]        [description]
	 */
	static public function spemail($email) {
		$find = array('.', '@');
		$replace   = array('(dot)', '(at)');
		return str_replace($find, $replace, $email);							
	}

	/**
	 * [truncate description]
	 * @param  [type]  $s      [description]
	 * @param  [type]  $l      [description]
	 * @param  string  $e      [description]
	 * @param  boolean $isHTML [description]
	 * @return [type]          [description]
	 */
	public static function truncate($s, $l, $e = '...', $isHTML = false){
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

	/**
	 * lets check if ACF if action
	 * @return boolean [description]
	 */
	static function is_acf_active(){
		if(!function_exists('has_sub_field')){
			em::log("advanced-custom-fields-pro is not installed/active.");
			return false;
		}

		return true;
	}

	/**
	 * get ACF options
	 * @param  [type] $group_fields [description]
	 * @return [type]               [description]
	 */
	static function acf_options($group_fields){
		
		if(empty($group_fields) || !is_array($group_fields) || !em::is_acf_active()){
			return false;
		}

		$group_data = array();

		foreach($group_fields as $field){
			$group_data[$field] = get_field($field, 'option');
		}

		return $group_data;
	}

}