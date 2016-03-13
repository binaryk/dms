<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class Password extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('password');
		$this->name('password');
		$this->value('');
		$this->addClass('form-control');
		$this->label( trans('comptech.ui.password-label') );
		$this->placeholder( trans('comptech.ui.password-placeholder') );
		$this->noautocomplete();
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}