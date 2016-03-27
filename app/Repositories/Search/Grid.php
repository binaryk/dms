<?php namespace App\Repositories\Search;

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
		$this->id('gridSearch');

		/*
		 * In ce fisier sa se genereze js-ul pentru .DataTable({...});
		 */
		$this->js( str_replace('\\', '/', public_path('custom/js/search/grid.js') ));

		/*
		 * De la ce ruta vine raspunsul cu randuri
		 */
		$this->ajax( (new Ajax())->setUrl(\URL::route('search.data-source'))->setExtra(['a' => 1, 'b' => 2]) );
		
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

			'name' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Denumire', 'width' => 30])
							->withFilter( (new Filter())->view('search.grid.filters.categorie') )
					)->orderable(),

			'description' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Descriere', 'width' => 30])
							->withFilter( (new Filter())->view('search.grid.filters.descriere') )
					),

			'version' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Versiune', 'width' => 5])
                            ->withFilter( (new Filter())->view('search.grid.filters.versiune') )
                    ),

			'author' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Autor', 'width' => 7])
                            ->withFilter( (new Filter())->view('search.grid.filters.author') )
                    ),

			'path' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Path', 'width' => 5])
					),

			'extention' =>
				(new Column())
					->withHeader(
						(new Header())
							->with(['caption' => 'Extensiune', 'width' => 5])
                            ->withFilter( (new Filter())->view('search.grid.filters.extensie') )
                    ),

			'actions' =>
				(new Column())
				->withHeader(
					(new Header())
					->with(['caption' => 'Acţiuni'])
				),


		
		]);

	}
}