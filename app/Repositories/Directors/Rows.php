<?php namespace App\Repositories\Directors;

use \App\Models\DirectorFiles;
use \App\Comptechsoft\Datatable\Cell;

class Rows extends \App\Comptechsoft\Datatable\Rows
{

	public function __construct()
	{
		$this->searcheableColumns([1 => 'id', 2 => 'name']);
		$this->orderableColumns([1 => 'id', 2 => 'name']);

		$this->addCells([
			'rec-no'     => (new Cell())->source(function($record){ return $record->properties->recCount . '.'; }),
			'id'         => (new Cell())->source(function($record){ return $record->id; }),
			'name'      => (new Cell())->source(function($record){ return $record->name; }),
			'description'      => (new Cell())->source(function($record){ return $record->description; }),
			'version'      => (new Cell())->source(function($record){ return $record->version; }),
			'author'      => (new Cell())->source(function($record){ return $record->author; }),
			'path'      => (new Cell())->source(function($record){ return $record->path; }),
			'extention'      => (new Cell())->source(function($record){ return $record->extention; }),
			'actions'    => (new Cell())->source(function($record){

				return 
					view('__layouts.pages.datatable.cells.actions')
					->withRecord($record)
					->withUpdateRoute(\URL::route('director-files.get-action-form', ['action' => 'update', 'id' => $record->id]))
					->withDeleteRoute(\URL::route('director-files.get-action-form', ['action' => 'delete', 'id' => $record->id]))
					->render();
			}),
		]);
	}

	/*
	 * Toate inregistrarile din tabela ferme 
	 */
	protected function totalRecordsCount()
	{
		return DirectorFiles::count();
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
			return DirectorFiles::count();
		}
		return DirectorFiles::whereRaw($where)->count();
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
			DirectorFiles::orderBy( $order_criteria['field'], $order_criteria['direction'] )
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