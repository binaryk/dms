<?php namespace App\Repositories\Ui\Navigation;

class Option extends \App\Repositories\Ui\Ui
{
    
    public static function make( $view = NULL, $data = NULL )
    {
        return parent::make( 'ui.navigation.option', $data );
    }


}