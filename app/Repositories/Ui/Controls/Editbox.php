<?php namespace App\Repositories\Ui\Controls;

class Editbox extends \App\Repositories\Ui\Ui
{

    public static function make( $view = NULL, $data = NULL )
    {
        return parent::make( 'ui.controls.flat-admin.editbox', $data );
    }
}