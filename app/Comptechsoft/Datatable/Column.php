<?php namespace App\Comptechsoft\Datatable;

class Column
{
	/*
	 * colectia din care face parte
	 */
	protected $columns = NULL;
	
	/*
	 * Header object
	 */
	protected $header = NULL;
	
	/*
	 *
	 */
	protected $orderable = false;
	
	/*
	 *
	 */
	protected $class = NULL;


	public function columns(Columns $columns)
	{
		$this->columns = $columns;
		return $this;
	}

	/*
	 * Ataseaza headerul la coloana
	 */
	public function withHeader(Header $header)
	{
		$this->header = $header->column($this);;
		return $this;
	}

	public function getWidth()
	{
		return $this->header->width();
	}

	public function setWidth($width)
	{
		$this->header->setWidth($width);
		return $this;
	}

	public function orderable()
	{
		$this->orderable = true;
		return $this;
	}

	public function header()
	{
		if( ! $this->header )
		{
			return '<th></th>';
		}
		return $this->header->render();
	}

	/*
	 * Doar continutul lui th, fara tagurile <th></th>
	 */
	public function filter()
	{
		if( ! $this->header )
		{
			return '';
		}
		if( ! $this->header->hasFilter() )
		{
			return '';
		}
		return $this->header->renderFilter();
	}

	public function alignRight()
	{
		$this->class = trim(trim($this->class) . ' cell-right');
		return $this;
	}

	public function alignLeft()
	{
		$this->class = trim(trim($this->class) . ' cell-left');
		return $this;
	}

	public function alignCenter()
	{
		$this->class = trim(trim($this->class) . ' cell-center');
		return $this;
	}

	public function render()
    {
    	return "{data : '" . $this->key . "', orderable:" . ($this->orderable ? 'true' : 'false') . ", className:'" . $this->class . "'},";
    }

	public function __call($method, $arguments)
	{
		if( substr($method, 0, 6) == 'option' )
		{
			$property = strtolower(substr($method, 6));
			if( is_array($arguments) )
			{
				if( array_key_exists(0, $arguments) )
				{
					$this->{$property} = $arguments[0];
					return $this;	
				}
				return $this->{$property};
			}
			return $this->{$property}; 
		}
		throw new \Exception('Invalid method ' . $method . '::' .__CLASS__, 1);
	}
}