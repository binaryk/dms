<?php namespace App\Comptechsoft\Ui\Tags;

use App\Comptechsoft\Ui\Ui;

class Table extends Ui
{

	public function __construct($file = NULL)
	{
		parent::__construct('table');
		$this->controls_view_path = 'vendor/comptech/tags';
		$this->cellspacing(0);
		$this->width('100%');
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}