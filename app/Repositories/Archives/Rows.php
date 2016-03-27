<?php namespace App\Repositories\Archives;

use App\Models\Access\User\User;
use \App\Models\Archive;
use \App\Comptechsoft\Datatable\Cell;

class Rows extends \App\Comptechsoft\Datatable\Rows
{

	public function __construct()
	{

		$this->searcheableColumns([1 => 'id', 2 => 'name', 3 => 'description', 4 => 'version', 5 => 'author', 6 => 'extention']);
		$this->orderableColumns([1 => 'id', 2 => 'name', 3 => 'description', 4 => 'version', 5 => 'author', 6 => 'extention']);


	}

	public function postAddCells()
	{
		$this->addCells([
			'rec-no'     	=> (new Cell())->source(function($record){ return $record->properties->recCount . '.'; }),
			'id'         	=> (new Cell())->source(function($record){ return $record->id; }),
			'name'      	=> (new Cell())->source(function($record){ return view('archives.grid.columns.name')->withName($record->name)->withLocation($record->location)->render(); }),
			'description'   => (new Cell())->source(function($record){ return $record->description; }),
			'version'       => (new Cell())->source(function($record){ return $record->version; }),
			'author'      	=> (new Cell())->source(function($record){ return @User::find($record->author)->name; }),
			'path'      	=> (new Cell())->source(function($record){ return $record->path; }),
			'extention'     => (new Cell())->source(function($record){ return $record->extention; }),
			'actions'    	=> (new Cell())->source(function($record){
				return
					view('archives.actions')
						->withRecord($record)
						->withDeleteRoute(\URL::route('archives.get-action-form',
							['action' => 'delete', 'id' => $record->id]))
						->render();
			}),
		]);

		return $this;
	}

	/*
	 * Toate inregistrarile din tabela ferme 
	 */
	protected function totalRecordsCount()
	{
		return Archive::count();
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
			return Archive::count();
		}
		return Archive::whereRaw($where)->count();
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
			Archive::where('author', access()->user()->id)->orderBy( $order_criteria['field'], $order_criteria['direction'] )
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