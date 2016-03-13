<?php namespace App\Repositories\Ui\Navigation;

class Dropdown extends \App\Repositories\Ui\Ui
{
    
    public function __construct( $view, $data )
    {
        parent::__construct($view, $data);
        $this->data['options'] = new \Illuminate\Support\Collection();
    }
    
    public static function make( $view = NULL, $data = NULL )
    {
        return parent::make( 'ui.navigation.dropdown', $data );
    }

    public function addOption($key, Option $option)
    {
    	$this->data['options']->put( $key, $option);
        return $this;
    }
}