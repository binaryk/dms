<?php namespace App\Comptechsoft\Datatable;

class Grid
{
	/*-----------------------------------------------------------------------------------------
	 * PROPERTIES
	 *-----------------------------------------------------------------------------------------/

	/*
	 * asociem un id la grid-ul datatable
	 */
	protected $id = NULL;
	
	/*
	 * view-ul de unde se randeaza tabelul
	 */
	protected $view = NULL; 

	/*
	 * coloanele gridului
	 */
	protected $columns = NULL;

	/*
	 * parameters; usual: \Input::all()
	 */
	protected $parameters = NULL;

	/*
	 * fisierul in care se face js-ul pentru initializare datatable
	 */
	protected $js_file = NULL;

	/*
	 * Parametrii Datatable
	 */
	protected $displayStart = 0;
	protected $pageLength   = 10;
	protected $dom          = '<"row"<"col-xs-12"lfp<"comptech-soft-toolbar pull-right">>><"row"<"col-sm-12 galonline-datatable-container"t>>';
		/**
		GALONLINE ==> '<"row"<"col-xs-12"pl<"dataTables_refresh"><"dataTables_toolbar">>><"row comptech-datatable-row"<"col-xs-12 comptech-datatable-container"t>>'
		**/
	protected $ajax         = NULL;
	protected $order        = NULL;
	
	/*-----------------------------------------------------------------------------------------
	 * METHODS
	 *-----------------------------------------------------------------------------------------*/

	/*
	 * Mai adauga un parametru
	 */
	public function withParameter($property, $value)
	{
		$this->parameters[$property] = $value;
		return $this;
	}

	public function getParameter($property)
	{
		if( ! array_key_exists($property, $this->parameters) )
		{
			throw new \Exception(__CLASS__ . ': Nu avem proprietatea '.$property.' in parameters', 1);
		}
		return $this->parameters[$property];
	}
	/*
	 * Nu vrem filtrare globala
	 */
	public function noGlobalFilter()
	{
		$this->dom = str_replace('lfp', 'lp', $this->dom);
		return $this;
	}
	/*
	 *
	 */
	public function js($file)
	{
		$this->js_file = $file;
		return $this;
	}

	/*
	 *
	 **/
	public function ajax(Ajax $ajax)
	{
		$this->ajax = $ajax;
		return $this;
	}

	/*
	 *
	 **/
	public function order(Order $order)
	{
		$this->order = $order;
		return $this;
	}

	/*
	 * Adaugarea unei coloane
	 */
	public function addColumn($i, Column $column)
	{
		if( is_null($this->columns) )
		{
			$this->columns = new Columns($this);
		}
		$this->columns->put($i, $column);
		return $this;
	}

	/*
	 * Adaugarea colectiei de coloane
	 */
	public function addColumns(array $columns)
	{
		if( ! is_array($columns) )
		{
			throw new \Exception('Please pass a columns collection array to ' . __CLASS__ . '::' . __METHOD__, 1);
		}
		$i = 0;
		foreach($columns as $key => $column)
		{
			/*
			 * Atasam la coloana id-ul ($key) si indicele ei ($i)
			 */
			$this->addColumn($key, $column->optionIndex($i++)->optionKey($key));
		}
		return $this;
	}

	/*
	 * pregateste tabelul pentru popularea ajax
	 */
	public function render()
	{
		if( ! is_string($this->id) )
        {
            throw new \Exception('Invalid grid id or not setted.', 1);
        }
        if( is_string($this->view) )
        {
        	/*
        	 * am posibilitatea sa am view-ul intr-un blade, daca nu-mi convine cel default
        	 */
        	return view($this->view)->withId($this->id)->withHeader('H')->render();
        }
		return 
			\App\Comptechsoft\Ui\Tags\Table::make()
			->class('datatable table table-bordered table-condensed table-striped')
			->header($this->columns->header())
			->id($this->id)
			->render();
	}

	/**
	 * css-ul pentru datatable
	 * 'plugins/dataTables/css/jquery.dataTables.min.css',
	 * 'plugins/dataTables/css/dataTables.bootstrap.css',
	 */
	public function styles()
	{
		return \App\Comptechsoft\Ui\Html\Styles::make([
			'plugins/dataTables/css/jquery.dataTables.min',
			'plugins/dataTables/css/dataTables.bootstrap',
			'plugins/dataTables/css/jquery.dataTables.yadcf'
		])->render();
	}

	/**
	 * js-ul pentru datatable
	 * 'plugins/dataTables/js/jquery.dataTables.min.js',
	 * 'plugins/dataTables/js/dataTables.bootstrap.min.js',
	 */
	public function scripts()
	{
		return \App\Comptechsoft\Ui\Html\Scripts::make([
			'plugins/dataTables/js/jquery.dataTables.min', 
			'plugins/dataTables/js/dataTables.bootstrap.min',
			'plugins/dataTables/js/jquery.dataTables.yadcf',
			str_replace( [str_replace('\\', '/', public_path()) . '/', '.js'], '', $this->js_file)
		])->render();
	}

	/*
	 *
	 */
	protected function columns()
	{
		$result = '';
        foreach( $this->columns->get() as $key => $column)
        {
            $result .= $column->render();
        }
        return $result;
	}

	/**
	 * genereaza js-ul pentru initializare datatable
	 **/
	public function create($forceCreate = false)
	{
		if(1 || ! file_exists($this->js_file) )
		{
			$myfile = fopen($this->js_file, "w");
			fwrite($myfile, view('vendor.comptech.datatable.init-js')->with([
				'id'           => $this->id,
				'displayStart' => $this->displayStart,
				'pageLength'   => $this->pageLength,
				'dom'          => $this->dom,
				'ajax'         => $this->ajax,
				'order'        => $this->order,
				'columns'      => $this->columns(),
			])->render() );
			fclose($myfile);
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function __call( $method, $arguments)
	{
		if( property_exists( $this, $method = strtolower($method)) )
		{
			if( is_array($arguments) )
			{
				if( array_key_exists(0, $arguments) )
				{
					$this->{$method} = $arguments[0];
					return $this;
				}
			}
			return $this->{$method};
		}
		throw new \Exception('Call invalid method ' . $method . ' on class  ' . __CLASS__ . '.', 1);
	}


}
