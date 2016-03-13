<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class Fullname extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('textbox');
		$this->name('fullname');
		$this->value('');
		$this->addClass('form-control');
		$this->label( trans('comptech.ui.fullname-label') );
		$this->placeholder( trans('comptech.ui.fullname-placeholder') );
		$this->icon('font');
		$this->noautocomplete();
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}