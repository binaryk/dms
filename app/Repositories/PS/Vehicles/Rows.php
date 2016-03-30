<?php namespace App\Repositories\PS\Vehicles;

use App\Models\Access\User\User;
use \App\Models\PS\Vehicle;
use \App\Comptechsoft\Datatable\Cell;

class Rows extends \App\Comptechsoft\Datatable\Rows
{

	public function __construct()
	{
		$this->searcheableColumns([1 => 'id', 2 => 'model', 3 => 'make', 4 => 'year', 5 => 'location', 6 => 'vehicle_type', 7 => 'rental_price']);
		$this->orderableColumns([1 => 'id', 2 => 'model', 3 => 'make', 4 => 'year', 5 => 'location', 6 => 'vehicle_type', 7 => 'rental_price']);


	}

	public function postAddCell()
	{
		$this->addCells([
			'rec-no'     => (new Cell())->source(function($record){ return $record->properties->recCount . '.'; }),
			'id'         => (new Cell())->source(function($record){ return $record->id; }),
			'available'      	=> (new Cell())->source(function($record){ return view('ps.vehicles.grid.columns.available')->withAvailable(!$record->is_blocked)->render(); }),
			'model'      	=> (new Cell())->source(function($record){ return $record->model; }),
			'make'   => (new Cell())->source(function($record){ return $record->make; }),
			'year'       => (new Cell())->source(function($record){ return $record->year; }),
			'location'      	=> (new Cell())->source(function($record){ return $record->location; }),
			'fuel_type'      	=> (new Cell())->source(function($record){ return $record->fuel_type; }),
			'rental_price'     => (new Cell())->source(function($record){ return $record->rental_price; }),
			'vehicle_type'     => (new Cell())->source(function($record){ return $record->vehicle_type; }),
			'is_blocked'     => (new Cell())->source(function($record){ return $record->is_blocked; }),
			'actions'    	=> (new Cell())->source(function($record){
				return
					view('ps.vehicles.actions')
						->withRecord($record)
						->withUpdateRoute(\URL::route('ps.vehicles.get-action-form', ['action' => 'update', 'id' => $record->id]) )
						->withDeleteRoute( $this->getParameter('admin') ? \URL::route('ps.vehicles.get-action-form', ['action' => 'delete', 'id' => $record->id]) : null)
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
		return Vehicle::count();
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
			return Vehicle::count();
		}
		return Vehicle::whereRaw($where)->count();
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
			Vehicle::orderBy( $order_criteria['field'], $order_criteria['direction'] )
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