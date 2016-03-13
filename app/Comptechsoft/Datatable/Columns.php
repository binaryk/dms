<?php namespace App\Comptechsoft\Datatable;

class Columns
{
	protected $columns = NULL;
	protected $grid    = NULL;  

	/*
	 * un obiect colectie de coloane apartine unui grid
	 */
	public function __construct(Grid $grid)
	{
		$this->grid = $grid;
		$this->columns = new \Illuminate\Support\Collection();
	}

	/*
	 * Adaugarea unei coloane la grid
	 */
	public function put($i, Column $column)
	{
		$this->columns->put($i, $column->columns($this));
		return $this;
	}

	/*
	 *
	 */
	public function get()
	{
		return $this->columns;
	}
	/*
	 * 
	 */
	public function header()
	{
		$result = '';
		$width  = 100;
		$additional = '';
		foreach($this->columns as $i => $column)
		{
			$width  -= ($column_width = $column->getWidth());
			if( $width <= 0)
			{
				throw new \Exception('Latimea totala a gridului este depasita cu ' . abs($width) . '%', 1);
			}
			
			if( ! $column_width )
			{
				$column->setWidth($width);
			}
			$result     .= $column->header();

			$additional .= '<th rowspan="1" style="width:' . ($column_width ? $column_width : $width) . '%">' . $column->filter() . '</th>';
		}
		if($result)
		{
			$result = '<thead><tr>' . $additional . '</tr><tr>' . $result . '</tr></thead>';
		}
		return $result;
	}
}