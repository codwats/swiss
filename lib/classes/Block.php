<?php
namespace Evermade\Swiss;

/**
 * Block class for keeping data together whilst looping many blocks within a page, and maybe ajax in future
 */
class Block
{
    protected $fields = array(); // for ACF fields only
    protected $data = array(); // for custom data, public accesible
    protected $css = array(); // for css styles

    public function __construct($fields = array())
    {
        if (!empty($fields)) {
            $this->fields = $fields;
            $this->getFields($fields);
        }
    }

    /**
     * [getFields we use get_sub_field be default is we are currently in a loop of a post, so we are getting sub fields of the site blocks object]
     * @param  array   $fields [description]
     * @param  boolean $parent [description]
     * @return [type]          [description]
     */
    public function getFields($fields = array(), $parent = true)
    {
        if (!is_array($fields)) {
            return false;
        }

        foreach ($fields as $field) {
            if ($parent) {
                $this->fields[$field] = get_sub_field($field);
            } else {
                $this->fields[$field] = get_field($field);
            }
        }
        return $this->fields;
    }

    /**
     * [set description]
     * @param [type] $key   [description]
     * @param [type] $value [description]
     */
    public function set($key = null, $value = null, $array = 'data')
    {
        if (!isset($this->{$array})) {
            return false;
        }

        return $this->{$array}[$key] = $value;
    }

    /**
     * [get get our data field, you can pass in data or fields to grab specific array data]
     * @param  [type] $key   [description]
     * @param  string $array [description]
     * @return [type]        [description]
     */
    public function get($key=null, $array = 'fields', $default=null)
    {
        if (!isset($this->{$array}[$key])) {
            return $default;
        }

        return $this->{$array}[$key];
    }

    /**
     * a wrapper function to allow the use of the main ACF function outside of the block context, ie single post etc
     *
     * @param string $size
     * @param [type] $key
     * @param string $class
     * @return void
     */
    public function getImage($size='medium-large', $key=null, $class='')
    {
        return \Evermade\Swiss\Acf\getImage($size, $this->get($key), $class);
    }

    public function getImageUrl($size='original', $key=null)
    {
        return \Evermade\Swiss\Acf\getImageUrl($size, $this->get($key));
    }
}
