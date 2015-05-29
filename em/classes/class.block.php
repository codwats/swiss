<?php

/**
 * Block class for keeping data together whilst looping many blocks within a page, and maybe ajax in future
 */
class Block extends BlockHelper{

	var $fields = array(); //for ACF fields only
	var $data = array(); //for custom data, public accesible
	var $repeaters = array(); //for ACF repeater fields
	protected $css = array();

	public function __construct(){
	}

	//we use get_sub_field be default is we are currently in a loop of a post, so we are getting sub fields of the site blocks object
	public function get_fields($fields=array(), $parent=true){

		if(!is_array($fields)) return false;

		foreach($fields as $field){
			if($parent){
				$this->fields[$field] = get_sub_field($field);
			}
			else {
				$this->fields[$field] = get_field($field);
			}
		}
		return $this->fields;
	}

	//set our data field
	public function set($key, $value){
		return $this->data[$key] = $value;
	}

	//get our data field, you can pass in data or fields to grab specific array data
	public function get($key, $array='data'){
		if(!isset($this->{$array}[$key])){
			return null;
		}
		return $this->{$array}[$key];
	}

	//get and setup repeater fields
	public function get_repeater_field($repeaters= array()){

		if(!is_array($repeaters)) return false;

		foreach($repeaters as $repeater){
			$this->repeaters[$repeater] = get_sub_field($repeater);
			$this->data[$repeater.'_total'] = sizeof($this->repeaters[$repeater]);
			$this->setup_grid_columns($repeater);
		}
		
		return true;
	}

}

class BlockHelper {

	//a helper method to dynamically generate boostrap columns classes
	public function setup_grid_columns($repeater=null){
		$this->data[$repeater.'_grid_columns'] = 'col-xs-12'; //default

		if(!isset($this->data[$repeater.'_total'])){
			return $this->data[$repeater.'_grid_columns'];
		}

		if($this->data[$repeater.'_total'] > 1){
			$this->data[$repeater.'_grid_columns'] .= ' col-md-'.em::number_of_columns($this->data[$repeater.'_total']);
		}

		return $this->data[$repeater.'_grid_columns'];
	}

	//a method to build css classes, inline styles for elements
	public function addCss($css=null, $key=null){
		if(empty($css) || empty($key)) return null;

		if(!isset($this->css[$key]) || !is_array($this->css[$key])){
			$this->css[$key] = null;
		}

		$this->css[$key] .= ' '.$css;

		return $this->css[$key];
	}

	//the getter method for the results of the addCss method
	public function getCss($key=null){
		if(!isset($this->css[$key])){
			return null;
		}
		return $this->css[$key];
	}

	//a wrapper function addCss specifically for background images
	public function set_background_image($field){
		if(is_array($this->fields[$field])){
			return $this->addCss('background-image:url('.$this->fields[$field]['sizes']['large'].');', $field);
		}
		return false;
	}

}