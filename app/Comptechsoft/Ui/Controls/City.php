<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class City extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('textbox');
		$this->name('city');
		$this->value('');
		$this->addClass('form-control');
		$this->label( trans('comptech.ui.city-label') );
		$this->placeholder( trans('comptech.ui.city-placeholder') );
		$this->icon('location-arrow');
		$this->noautocomplete();
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}