<?php namespace App\Repositories\Ui\Alert;

class Alert extends \App\Repositories\Ui\Ui
{
    
    public static function make( $view = NULL, $data = NULL )
    {
        return parent::make( 'ui.alerts.alert', $data );
    }

}
