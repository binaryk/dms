<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class Checkbox extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('checkbox');
		// $this->name('email');
		$this->value(1);
		$this->nochecked();
		// $this->addClass('form-control');
		// $this->label( trans('comptech.ui.email-label') );
		// $this->placeholder( trans('comptech.ui.email-placeholder') );
		// $this->noautocomplete();
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}