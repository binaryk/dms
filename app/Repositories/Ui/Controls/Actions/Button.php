<?php namespace App\Repositories\Ui\Controls\Actions;

class Button extends \App\Repositories\Ui\Ui
{
    
    public static function make( $view = NULL, $data = NULL )
    {
        return parent::make( 'ui.controls.flat-admin.actions.button', $data );
    }

}