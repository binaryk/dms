<?php namespace App\Comptechsoft\Ui\Html;

use App\Comptechsoft\Ui\Ui;
use Illuminate\Support\Collection;

class Styles extends Ui 
{

	protected $files = NULL;

	public function __construct($files)
	{
		$this->files = new Collection();
		$this->add($files);
	}

	protected function add($files)
	{
		$this->addToCollection($this->files, $files);
	}

	public static function make($files = [])
	{
		return new static($files);
	}

	public function render()
	{
		$result = '';
		foreach( $this->files as $key => $file)
		{
			$result .= \Html::style($file . '.css');
		}
		return $result;
	}
}