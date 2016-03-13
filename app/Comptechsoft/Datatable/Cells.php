<?php namespace App\Comptechsoft\Datatable;

class Cells
{
	protected $cells = NULL;
	protected $rows  = NULL;  

	/*
	 * un obiect colectie de celule apartine unui obiect rows
	 */
	public function __construct(Rows $rows)
	{
		$this->rows = $rows;
		$this->cells = new \Illuminate\Support\Collection();
	}

	/*
	 * Adaugarea unei coloane la grid
	 */
	public function put($i, Cell $cell)
	{
		$this->cells->put($i, $cell->cells($this));
		return $this;
	}

	/*
	 *
	 */
	public function get()
	{
		return $this->cells;
	}
	
	
}