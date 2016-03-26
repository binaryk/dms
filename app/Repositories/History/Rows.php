<?php namespace App\Repositories\History;

use App\Models\Access\User\User;
use \App\Models\FileHistory;
use \App\Comptechsoft\Datatable\Cell;

class Rows extends \App\Comptechsoft\Datatable\Rows
{

	public function __construct()
	{
		$this->searcheableColumns([1 => 'id', 2 => 'name']);
		$this->orderableColumns([1 => 'id', 2 => 'name']);


	}

	public function postAddCells()
	{
		$this->addCells([
			'rec-no'     	=> (new Cell())->source(function($record){ return $record->properties->recCount . '.'; }),
			'id'         	=> (new Cell())->source(function($record){ return $record->id; }),
			'name'      	=> (new Cell())->source(function($record){ return view('file-history.grid.columns.name')->withName($record->name)->withLocation($record->location)->render(); }),
			'description'   => (new Cell())->source(function($record){ return $record->description; }),
			'version'       => (new Cell())->source(function($record){ return $record->version; }),
			'author'      	=> (new Cell())->source(function($record){ return @User::find($record->author)->name; }),
			'path'      	=> (new Cell())->source(function($record){ return $record->path; }),
			'extention'     => (new Cell())->source(function($record){ return $record->extention; }),
			'actions'    	=> (new Cell())->source(function($record){

				return
					view('__layouts.pages.datatable.cells.actions')
						->withRecord($record)
						//file-history-get-action-form/{parent_file_id}/{action}/{grid_id}/{id?}
						->withUpdateRoute(null)
						/*\URL::route('file-history.get-action-form',
							[
								'parent_file_id' => $this->getParameter('parent_file_id'),
								'action' => 'update',
								'grid_id' => $this->getParameter('grid_id'),
								'id' => $record->id
							])*/
						->withDeleteRoute(\URL::route('file-history.get-action-form',
							[
								'parent_file_id' => $this->getParameter('parent_file_id'),
								'action' => 'delete',
								'grid_id' => $this->getParameter('grid_id'),
								'id' => $record->id
							]))
						->render();
			}),
		]);

		return $this;
	}

	/*
	 * Toate inregistrarile din tabela
	 */
	protected function totalRecordsCount()
	{
		return FileHistory::count();
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
			return FileHistory::count();
		}
		return FileHistory::whereRaw($where)->count();
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
		$result =  FileHistory::where('file_id', $this->getParameter('parent_file_id'))->orderBy( 'id', 'desc' );
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