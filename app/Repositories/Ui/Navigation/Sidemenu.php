<?php namespace App\Repositories\Ui\Navigation;

class Sidemenu extends \App\Repositories\Ui\Ui
{
    
    public function __construct( $view, $data )
    {
        parent::__construct($view, $data);
        $this->data['options'] = new \Illuminate\Support\Collection();
    }

    public static function make( $view = NULL, $data = NULL )
    {
        return parent::make( 'ui.navigation.sidebar', $data );
    }

    public function addOption($key, Option $option)
    {
    	$this->data['options']->put( $key, $option);
        return $this;
    }

    public function addDropdown($key, Dropdown $dropdown)
    {
    	$this->data['options']->put( $key, $dropdown);
        return $this;
    }
}