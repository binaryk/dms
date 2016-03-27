<?php namespace App\Repositories\Superadmin\Nomenclatoare\Categories;

use \App\Models\Nomenclatoare\Categorie;
use \App\Comptechsoft\Datatable\Cell;

class Rows extends \App\Comptechsoft\Datatable\Rows
{

	public function __construct()
	{
		$this->searcheableColumns([1 => 'id', 2 => 'denumire']);
		$this->orderableColumns([1 => 'id', 2 => 'denumire']);

		$this->addCells([
			'rec-no'     => (new Cell())->source(function($record){ return $record->properties->recCount . '.'; }),
			'id'         => (new Cell())->source(function($record){ return $record->id; }),
			'denumire'      => (new Cell())->source(function($record){ return $record->denumire; }),
			'actions'    => (new Cell())->source(function($record){

				return 
					view('__layouts.pages.datatable.cells.actions')
					->withRecord($record)
					->withUpdateRoute(\URL::route('superadmin.nomenclatoare.categories.get-action-form', ['action' => 'update', 'id' => $record->id]))
					->withDeleteRoute(\URL::route('superadmin.nomenclatoare.categories.get-action-form', ['action' => 'delete', 'id' => $record->id]))
					->render();
			}),
		]);
	}

	/*
	 * Toate inregistrarile din tabela ferme 
	 */
	protected function totalRecordsCount()
	{
		return Categorie::count();
	}

	/*
	 * Toate inregistrarile obtinute in urma unei filtrari Datatable
	 */
	protected function filteredRecordsCount()
	{
		/*
		 * WhereRaw
		 */
		$where = $this->where();
		if( ! $where )
		{
			return Categorie::count();
		}
		return Categorie::whereRaw($where)->count();
	}

	/*
	 * Setul de date care trebuie trimis catre Datatable
	 */
	protected function getDataSet()
	{
		/*
		 * OrderBy
		 */
		$order_criteria = $this->orderBy();
		$result = 
			Categorie::orderBy( $order_criteria['field'], $order_criteria['direction'] )
			;
		/*
		 * WhereRaw
		 */
		$where = $this->where();
		if( ! $where )
		{
			return $result->skip($this->start())->take($this->length())->get();
		}
		return $result->whereRaw($where)->skip($this->start())->take($this->length())->get();
	}
}