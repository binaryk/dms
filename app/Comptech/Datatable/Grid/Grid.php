<?php namespace App\Comptech\Datatable\Grid;

abstract class Grid
{

    protected $config_file         = NULL;
    protected $config_keys         = ['name', 'id', 'dom', 'iDisplayLength'];

    protected $input               = NULL; // inputul preluat din request
    protected $name                = NULL; // numele variabilei javascript
    protected $id                  = NULL; // id-ul <table>
    protected $ajax                = NULL; // obiect "Ajax" - pentru obtinerea datelor
    protected $order               = NULL; // obiect "Order" - pentru criteriul de sortare curent
    protected $columns             = NULL; // colectie cu definirea coloanelor

    protected $styles              = NULL; // ce fisiere css
    protected $scripts             = NULL; // ce fisiere js

    /*
     * Parametrii jQuery Datatable
     */
    protected $processing          = true;
    protected $serverSide          = true;
    protected $stateSave           = false;
    protected $autoWidth           = false;
    protected $pagingType          = 'full_numbers';
    protected $lengthMenu          = '[[5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 100], [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 100]]';
    protected $iDisplayStart       = 0;
    protected $iDisplayLength      = 25;
    // protected $dom                 = '<"top"fl<"clear">>rt<"bottom"ip<"clear">>';
    protected $dom                 = 
            '<"row"<"col-xs-12"plf<"dataTables_refresh"><"dataTables_toolbar">>>' . 
            '<"row comptech-datatable-row"<"col-xs-12 comptech-datatable-container"t>>'
        ;
    
    /*
     * view-uri folosite
     */
	protected $table_view          = NULL;
    protected $javascript_view     = NULL;

    /*
     * accesarea unei proprietati nepublice (protected|private)
     */
    public function __get( $property )
    {
        return $this->{$property};
    }

    protected function makeColumnsFromConfig( $columns )
    {
        foreach( $columns as $key => $properties)
        {
            $searcheable = NULL;
            if( $properties['searcheable'] )
            {
                $searcheable = new Search( config($this->config_file . '.views_path' ) . '.search.' . $properties['searcheable']['view'], array_key_exists('data', $properties['searcheable']) ? $properties['searcheable']['data'] : NULL );
            }

            $this->addColumn($key, new Column(
                new Header( 
                    $properties['header']['caption'], 
                    $properties['header']['id'], 
                    $properties['header']['width']),
                $searcheable, 
                $properties['orderable'], 
                $properties['class']
            ));
        }
    }
    /*
     * constructor
     */
    public function __construct($input)
    {
        $this->input = $input;
        $this->columns = new \Illuminate\Support\Collection();

        if( $this->config_file)
        {
            $configs = config($this->config_file . '.grid');
            foreach($this->config_keys as $i => $key)
            {
                $this->{$key} = $configs[$key];
            }
            $this->ajax  = new Ajax(\URL::route($configs['route']));
            $this->order = new Order($configs['order']['column'], $configs['order']['direction']);
            $this->addToolbar(new Toolbar(config($this->config_file . '.views_path' ) . '.toolbar.toolbar'));

            if( array_key_exists('columns', $configs) && $configs['columns'])
            {
                $this->makeColumnsFromConfig($configs['columns']);
            }
        }
    }

    /*
     * adaugarea unei coloane la colectia "columns"
     */
    protected function addColumn($key, Column $column)
    {
        $this->columns->put( $key, $column);
        return $this;
    }    

    public function setHeaderCaption($key, $caption)
    {
        $column = $this->columns->get($key);
        $column->setHeaderCaption($caption);
        return $this;
    }

    /*
     * adaugarea unui toolbar
     */
    protected function addToolbar(Toolbar $toolbar)
    {
        $this->toolbar = $toolbar;
    }

    protected function renderColumns()
    {
        $result = '';
        foreach( $this->columns as $key => $column)
        {
            $result .= $column->render($key);
        }
        return $result;
    }

    protected function renderHeader()
    {
        $result = ''; 
        $width  = 100;
        foreach($this->columns as $key => $column)
        {
            $columnWidth = $column->width();
            $width -= $columnWidth;
            if($columnWidth == 0)
            {
                $column->setWidth($width);
            }
            $result .= $column->renderHeader();
        }
        return $result;
    }

    public function renderTable()
    {
        if( is_null($this->id) )
        {
            throw new \Exception("The id can not be NULL", 1);
        }
        if( is_null($this->table_view) )
        {
            $this->table_view = \Config::get('datatable.table-view');
        }
        return 
            view($this->table_view)->with([
                'id'     => $this->id,
                'header' => $this->renderHeader(),
            ])->render();
    }

    public function renderScript()
    {
    	if( is_null($this->id) )
    	{
    		throw new \Exception("The id can not be NULL", 1);
    	}
    	if( is_null($this->javascript_view) )
    	{
    		$this->javascript_view = \Config::get('datatable.javascript-view');
    	}
        if( is_null($this->name) )
        {
            $this->name = 'dt';
        }
    	return 
            view($this->javascript_view)->with([
                'name'         => $this->name,
                'id'           => $this->id,
                'processing'   => $this->processing ? 'true' : 'false',
                'serverSide'   => $this->serverSide ? 'true' : 'false',
                'stateSave'    => $this->stateSave ? 'true' : 'false',
                'autoWidth'    => $this->autoWidth ? 'true' : 'false',
                'pagingType'   => $this->pagingType,
                'lengthMenu'   => $this->lengthMenu,
                'displayStart' => $this->iDisplayStart,
                'pageLength'   => $this->iDisplayLength,
                'ajax'         => $this->ajax,
                'order'        => $this->order,
                'columns'      => $this->renderColumns(),
                'dom'          => $this->dom,
                'toolbar'      => $this->toolbar,
            ])->render()
        ;
    }
    
    public function styles()
    {
        if( is_null( $this->styles) )
        {
            $this->styles = \Config::get('datatable.assets.css');
        }
        if( is_array($this->styles) )
        {
            $result = '';
            foreach($this->styles as $i => $file)
            {
                $result .= \Html::style($file);
            }
            return $result;
        }
        return NULL;
    }

    public function scripts()
    {
        if( is_null( $this->scripts) )
        {
            $this->scripts = \Config::get('datatable.assets.js');
        }
        if( is_array($this->scripts) )
        {
            $result = '';
            foreach($this->scripts as $i => $file)
            {
                $result .= \Html::script($file);
            }
            return $result;
        }
        return NULL;
    }

}
