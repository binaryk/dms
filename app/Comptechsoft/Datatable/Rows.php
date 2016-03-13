<?php namespace App\Comptechsoft\Datatable;

use \App\Comptechsoft\Datatable\Traits\Where;
use \App\Comptechsoft\Datatable\Traits\OrderBy;

class Rows
{

	use Where, OrderBy;
	/*
	 * parameters
	 * ce parametrii (din Input::all() ) vin cu requestul Ajax al Datatable
	 */
	protected $parameters = NULL;
	
	/*
	 * dupa care coloane se poate face cautare (WHERE ...)
	 * [column_index => field_name, column_index => field_name, ...]
	 */
	protected $searcheables = [];

	/*
	 * dupa care coloane se poate face sortarea (ORDER BY ...)
	 * [column_index => field_name, column_index => field_name, ...]
	 */
	protected $orderables = [];

	/*
	 * obiect cu celulele unui rand
	 * trebuie definite
	 */
	protected $cells = NULL; 


	/* =======================================================================================================
	 *
	 * METHODS
	 *
	 * ====================================================================================================== */

	/*
	 * Mai adauga un parametru
	 */
	public function addParameter($property, $value)
	{
		$this->parameters[$property] = $value;
		return $this;
	}

	public function getParameter($property)
	{
		if( ! array_key_exists($property, $this->parameters) )
		{
			throw new \Exception(__CLASS__ . ': Nu avem proprietatea $property in parameters', 1);
		}
		return $this->parameters[$property];
	}

	/*
	 * Se converteste un array de obiecte la un arrai de id-uri
	 */
	function toIds( $data, $field = 'id' )
	{
		$ids = [];
		foreach($data as $i => $item)
		{
			$ids[] = $item->{$field};
		}
		return $ids;
	}

	/*
	 * Adaugarea unei celule
	 */
	public function addCell($i, Cell $cell)
	{
		if( is_null($this->cells) )
		{
			$this->cells = new Cells($this);
		}
		$this->cells->put($i, $cell);
		return $this;
	}

	/*
	 * Adaugarea colectiei de celule
	 */
	public function addCells(array $cells)
	{
		if( ! is_array($cells) )
		{
			throw new \Exception('Please pass a cells collection array to ' . __CLASS__ . '::' . __METHOD__, 1);
		}
		$i = 0;
		foreach($cells as $key => $cell)
		{
			/*
			 * Atasam la coloana id-ul ($key) si indicele ei ($i)
			 */
			$this->addCell($key, $cell->optionIndex($i++)->optionKey($key));
		}
		return $this;
	}

	protected function draw()
	{
		return $this->parameters['draw'];
	}

	public function start()
    {
        return $this->parameters['start'];
    }

    public function length()
    {
        return $this->parameters['length'];
    }

    public function orders()
    {
        return $this->parameters['order'];
    }

    public function search()
    {
        return $this->parameters['search'];
    }

    public function columns()
    {
        return $this->parameters['columns'];
    }

	public function parameters($data)
	{
		$this->parameters = $data;
		return $this;
	}

	public function searcheableColumns( $columns )
	{
		$this->searcheables = $columns;
		return $this;
	}

	public function orderableColumns( $columns )
	{
		$this->orderables = $columns;
		return $this;
	}

	protected function totalRecordsCount()
	{
		throw new \Exception('Metoda Rows::' . __METHOD__ . ' trebuie implementata.');
	}

	protected function filteredRecordsCount()
	{
		throw new \Exception('Metoda Rows::' . __METHOD__ . ' trebuie implementata.');
	}

	protected function getDataSet()
	{
		throw new \Exception('Metoda Rows::' . __METHOD__ . ' trebuie implementata.');
	}

	protected function createRow($i, $record)
	{
		if( is_null($this->cells) )
		{
			throw new \Exception('Nu avem celule definite in obiectul Rows', 1);
		}
		$result = []; 
		$j = 0;
		$recCount = $this->start() + $i + 1;
		$record->properties = new \StdClass();
		foreach($this->cells->get() as $key => $cell)
		{
			/*
			 * Attach extra infos to record
			 */
			$record->properties->i 			= $i;
			$record->properties->j 			= ++$j;
			$record->properties->id 		= $key;
			$record->properties->recCount 	= $recCount;
			/*
			 * Put de cell in resultat
			 */
			$result[$key] = $cell->render($record);
		}
		$result["DT_RowClass"] = 'custom-class';
		$result["DT_RowId"] = 'custom-id';
		return $result;
	}

	protected function prepareDataSet($data)
	{
		$result = [];
		if($data)
		{
			foreach($data as $i => $record)
			{
				$result[] = $this->createRow($i, $record);
			}
		}
		return $result;
	}

	protected function dataSet()
	{
		return $this->prepareDataSet($this->getDataSet());
	}

	public function response()
	{
		return \Response::json([
			'draw'            => $this->draw(),
			'recordsTotal'    => $this->totalRecordsCount(),
			'recordsFiltered' => $this->filteredRecordsCount(),
			'data'            => $this->dataSet(),
		]);
	}
}