<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class Country extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('selectbox');
		$this->name('country');
		$this->value('');
		$this->addClass('form-control');
		$this->label( trans('comptech.ui.country-label') );
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}