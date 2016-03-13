<?php namespace App\Comptechsoft\Ui\Controls;

use App\Comptechsoft\Ui\Ui;
use App\Comptechsoft\Ui\Controls\Traits\Control;

class Editbox extends Ui
{
	use Control;

	public function __construct($file = NULL)
	{
		parent::__construct('editbox');
		$this->addClass('form-control');
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}