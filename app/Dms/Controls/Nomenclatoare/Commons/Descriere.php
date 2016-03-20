<?php namespace App\Dms\Controls\Nomenclatoare\Commons;

class Descriere extends \App\Comptechsoft\Ui\Ui
{
	use \App\Comptechsoft\Ui\Controls\Traits\Control;

	public function __construct($file = NULL)
	{
		parent::__construct('editbox');

		$this->name('descriere');
		$this->value('');
		$this->addClass('form-control');
		$this->label('Descriere');
		$this->placeholder('Descriere');
		$this->icon('');
		$this->addClass('form-data-source');
		$this->withAttribute('data-type', 'textbox');
		$this->noautocomplete();
	}

	public static function make($file = NULL)
	{
		return new static( $file );
	}


}