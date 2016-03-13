<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class Button extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('button');

		// $this->name('email');
		// $this->value(1);
		// $this->nochecked();
		$this->addClass('btn');
		// $this->label( trans('comptech.ui.email-label') );
		// $this->placeholder( trans('comptech.ui.email-placeholder') );
		// $this->noautocomplete();
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}