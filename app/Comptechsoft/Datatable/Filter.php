<?php namespace App\Comptechsoft\Datatable;

class Filter
{

	protected $view = NULL;
	protected $data = [];

	public function view($view)
	{
		$this->view = $view;
		return $this;
	}

	public function render()
	{
		return view($this->view)->with($this->data)->render();
	}
}