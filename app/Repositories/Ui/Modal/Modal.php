<?php namespace App\Repositories\Ui\Modal;

class Modal extends \App\Repositories\Ui\Ui
{
    
    public static function make( $view = NULL, $data = NULL )
    {
        return parent::make( 'ui.modals.modal', $data );
    }
}