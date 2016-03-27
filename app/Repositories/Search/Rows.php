<?php namespace App\Repositories\Search;

use App\Models\Access\User\User;
use \App\Models\File;
use \App\Comptechsoft\Datatable\Cell;

class Rows extends \App\Comptechsoft\Datatable\Rows
{

	public function __construct()
	{
		$this->searcheableColumns([1 => 'id', 2 => 'name', 3 => 'description', 4 => 'version', 5 => 'author', 6 => 'extention']);
		$this->orderableColumns([1 => 'id', 2 => 'name', 3 => 'description', 4 => 'version', 5 => 'author', 6 => 'extention']);

		$this->addCells([
			'rec-no'     => (new Cell())->source(function($record){ return $record->properties->recCount . '.'; }),
			'id'         => (new Cell())->source(function($record){ return $record->id; }),
			'name'      	=> (new Cell())->source(function($record){ return view('file-history.grid.columns.name')->withName($record->name)->withLocation($record->location)->render(); }),
			'description'   => (new Cell())->source(function($record){ return $record->description; }),
			'version'       => (new Cell())->source(function($record){ return $record->version; }),
			'author'      	=> (new Cell())->source(function($record){ return @User::find($record->author)->name; }),
			'path'      	=> (new Cell())->source(function($record){ return $record->path; }),
			'extention'     => (new Cell())->source(function($record){ return $record->extention; }),
			'actions'    	=> (new Cell())->source(function($record){
				return
					view('search.actions')
						->withRecord($record)
						->withArchiveRoute(\URL::route('director-files.archive-file',
							[
								'id' => $record->id,
							]))
						->withEmailRoute(\URL::route('search.send_file',
							[
								'id' => $record->id,
							]))
						->render();
			}),
		]);
	}

	/*
	 * Toate inregistrarile din tabela ferme 
	 */
	protected function totalRecordsCount()
	{
		return File::count();
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
			return File::count();
		}
		return File::whereRaw($where)->count();
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
			File::orderBy( $order_criteria['field'], $order_criteria['direction'] )
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