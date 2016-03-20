<?php namespace App\Dms\Controls\Nomenclatoare\Commons;

class Denumire extends \App\Comptechsoft\Ui\Ui
{
	use \App\Comptechsoft\Ui\Controls\Traits\Control;

	public function __construct($file = NULL)
	{
		parent::__construct('textbox');
		$this->value('');
		$this->addClass('form-control');
		$this->icon('');
		$this->noautocomplete();
		$this->label('Denumire');
		$this->name('denumire');
		$this->maxlength(128);
		$this->addClass('form-data-source');
		$this->withAttribute('data-type', 'textbox');
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}