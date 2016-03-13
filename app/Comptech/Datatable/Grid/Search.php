<?php namespace App\Comptech\Datatable\Grid;

class Search
{

	protected $view = NULL;
	protected $data = [];

	public function __construct($view, $data = [])
	{
		$this->view = $view;
		$this->data = $data;
	}

	public function render()
	{
		return 
			view($this->view)
			->with($this->data)
			->render()
		;
	}
}
