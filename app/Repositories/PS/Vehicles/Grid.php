<?php namespace App\Repositories\PS\Vehicles;

use \App\Comptechsoft\Datatable\Column;
use \App\Comptechsoft\Datatable\Header;
use \App\Comptechsoft\Datatable\Ajax;
use \App\Comptechsoft\Datatable\Order;
use \App\Comptechsoft\Datatable\Filter;

class Grid extends \App\Comptechsoft\Datatable\Grid
{

	public function __construct()
	{

		$this->noGlobalFilter();
		/*
		 * II asociez ID la grid
		 */
		$this->id('gridVehicles');

		/*
		 * In ce fisier sa se genereze js-ul pentru .DataTable({...});
		 */
		$this->js( str_replace('\\', '/', public_path('custom/js/ps/grid_vehicles/grid.js') ));

		/*
		 * De la ce ruta vine raspunsul cu randuri
		 */
		$this->ajax( (new Ajax())->setUrl(\URL::route('ps.vehicles.data-source'))->setExtra(['a' => 1, 'b' => 2]) );
		
		/*
		 * Care coloana contine ordinea initiala
		 */
		$this->order( (new Order())->setColumn(1)->setDirection('asc') );

		/*
		 * Definirea coloanelor
		 **/
		$this->addColumns([

			'rec-no' => 
				(new Column())
				->withHeader( 
					(new Header())
					->with(['caption' => '#', 'width' => 5])
				)
				->alignRight(),
			'available' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Available', 'width' => 3])
							->withFilter( (new Filter())->view('ps.vehicles.grid.filters.model') )
					)->orderable(),
			'model' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Model', 'width' => 15])
							->withFilter( (new Filter())->view('ps.vehicles.grid.filters.model') )
					)->orderable(),

			'make' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Make', 'width' => 12])
							->withFilter( (new Filter())->view('ps.vehicles.grid.filters.make') )
					),

			'year' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Year', 'width' => 10])
                            ->withFilter( (new Filter())->view('ps.vehicles.grid.filters.year') )
                    ),

			'location' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Location', 'width' => 17])
                            ->withFilter( (new Filter())->view('ps.vehicles.grid.filters.location') )
                    ),

			'fuel_type' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Fuel', 'width' => 10])
					),

			'vehicle_type' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Vehicle Type', 'width' => 15])
                            ->withFilter( (new Filter())->view('ps.vehicles.grid.filters.vehicle_type') )
                    ),

			'rental_price' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Price', 'width' => 10])
                            ->withFilter( (new Filter())->view('ps.vehicles.grid.filters.price') )
                    ),

			'actions' =>
				(new Column())
				->withHeader(
					(new Header())
					->with(['caption' => 'Actions'])
				),


		
		]);

	}
}