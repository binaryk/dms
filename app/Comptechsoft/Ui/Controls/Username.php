<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class Username extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('textbox');
		$this->name('username');
		$this->value('');
		$this->addClass('form-control');
		$this->label( trans('comptech.ui.username-label') );
		$this->placeholder( trans('comptech.ui.username-placeholder') );
		$this->icon('user');
		$this->noautocomplete();
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}