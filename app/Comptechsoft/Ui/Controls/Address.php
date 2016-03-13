<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class Address extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('textbox');
		$this->name('address');
		$this->value('');
		$this->addClass('form-control');
		$this->label( trans('comptech.ui.address-label') );
		$this->placeholder( trans('comptech.ui.address-placeholder') );
		$this->icon('check');
		$this->noautocomplete();
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}