<?php namespace App\Repositories\Superadmin\Nomenclatoare\CategoriiParteneri;

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
		$this->id('gridCategoriiParteneri');

		/*
		 * In ce fisier sa se genereze js-ul pentru .DataTable({...});
		 */
		$this->js( str_replace('\\', '/', public_path('pages/scripts/superadmin/nomenclatoare/CategoriiParteneri/grid.js') ));

		/*
		 * De la ce ruta vine raspunsul cu randuri
		 */
		$this->ajax( (new Ajax())->setUrl(\URL::route('superadmin.nomenclatoare.categorii-parteneri.data-source'))->setExtra(['a' => 1, 'b' => 2]) );
		
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

			'id' => 
				(new Column())
				->withHeader( 
					(new Header())
					->with(['caption' => 'ID', 'width' => 5])
				)
				->alignCenter()
				->orderable(),

			'categorie' => 
				(new Column())
				->withHeader( 
					(new Header())
					->with(['caption' => 'Denumire', 'width' => NULL]) 
					->withFilter( (new Filter())->view('superadmin.nomenclatoare.categorii-parteneri.grid.filters.categorie') ) 
				)->orderable(),

			// 'actions' =>
			// 	(new Column())
			// 	->withHeader(
			// 		(new Header())
			// 		->with(['caption' => 'Acţiuni'])
			// 	),


		
		]);

	}
}