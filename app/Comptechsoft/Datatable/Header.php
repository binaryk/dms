<?php namespace App\Comptechsoft\Datatable;

/**
 Ar mai putea primi:
 #1. blade
 #2. closure
 **/
class Header
{

	/*
	 * referinta catre coloana
	 */
	protected $column = NULL;

	/*
	 * textul
	 */
	protected $caption = NULL;
    
    /*
     * stylul css
     */
    protected $style   = NULL;

    /*
     * clasa xss
     */
    protected $class   = NULL;
    
    /* 
     * latimea in procente
     */
    protected $width   = NULL;

    /*
     * obiectul filter
     */
    protected $filter = NULL;


	public function column(Column $column)
	{
		$this->column = $column;
		return $this;
	}

	public function width()
	{
		return $this->width;
	}

	public function setWidth($width)
	{
		$this->width = $width;
		return $this;
	}

	public function render()
	{
		/*
		 * $this->column->index - indicele coloanei (0, 1, 2, ...)
		 * $this->column->key   - id-ul coloanei
		 */
		return '<th style="width:' . $this->width . '%">' . $this->caption . '</th>';
	}

	public function with(array $properties)
	{
		foreach($properties as $property => $value)
		{
			$this->{$property} = $value;
		}
		return $this;
	}

	public function withFilter(Filter $filter)
	{
		$this->filter = $filter;
		return $this;
	}

	public function hasFilter()
	{
		return (bool) $this->filter;
	}

	public function renderFilter()
	{
		return $this->filter->render();
	}
}