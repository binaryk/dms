<?php namespace App\Repositories\History;

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
		$this->id('gridFileHistory');

		/*
		 * In ce fisier sa se genereze js-ul pentru .DataTable({...});
		 */
		$this->js( str_replace('\\', '/', public_path('custom/js/file-history/grid.js') ));
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

			'name' =>
				(new Column())
				->withHeader( 
					(new Header())
					->with(['caption' => 'Denumire', 'width' => 30])
					->withFilter( (new Filter())->view('file-history.grid.filters.categorie') )
				)->orderable(),

			'description' =>
				(new Column())
				->withHeader(
					(new Header())
					->with(['caption' => 'Descriere', 'width' => 30])
				),

			'version' =>
				(new Column())
				->withHeader(
					(new Header())
					->with(['caption' => 'Versiune', 'width' => 5])
				),

			'author' =>
				(new Column())
				->withHeader(
					(new Header())
					->with(['caption' => 'Autor', 'width' => 10])
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
				),

			'actions' =>
				(new Column())
				->withHeader(
					(new Header())
					->with(['caption' => 'Acţiuni'])
				),
		]);

	}

	public function setUrl()
	{
		/*
		 * De la ce ruta vine raspunsul cu randuri
		 */
		$this->ajax( (new Ajax())->setUrl(\URL::route('file-history.data-source',
			['parent_file_id' => $this->getParameter('parent_file_id'),'grid_id' => $this->id]))
			->setExtra(['a' => 1, 'b' => 2]) );
		return $this;
	}
}