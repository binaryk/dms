<?php namespace App\Repositories\Ui\Controls;

class Filebox extends \App\Repositories\Ui\Ui
{

    public static function make( $view = NULL, $data = NULL )
    {
        return parent::make( 'ui.controls.flat-admin.filebox', $data );
    }
}