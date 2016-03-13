<?php namespace App\Comptech\Datatable\Rows;

use \App\Comptech\Datatable\Rows\Searchables;
use \App\Comptech\Datatable\Rows\Orderables;

class Input
{

	protected $input       = NULL;
    protected $searchables = NULL;
    protected $orderables  = NULL;
   
    public function __construct( $input, Searchables $searchables, Orderables $orderables )
    {
    	$this->input        = $input;
        $this->searchables  = $searchables;
        $this->orderables   = $orderables;
    }

    protected function get($key)
    {
        return array_key_exists($key, $this->input) ? $this->input[$key] : NULL;
    }

    protected function draw()
    {
        return $this->get('draw');
    }

    public function columns()
    {
        return $this->get('columns');
    }

    public function column($i)
    {
        if( ! is_array($columns = $this->columns()) )
        {
            return NULL;
        }
        if( ! array_key_exists($i, $columns) )
        {
            return NULL;
        }
        return $columns[$i];
    }

    /*
     *  Existing properties: data, name, searchable, orderable, search[value | regex]
     */
    public function getColumnProperty($i, $property)
    {
        $column = $this->column($i);
        if( ! $column )
        {
            return NULL;
        }
        if( ! array_key_exists($property, $column) )
        {
            return NULL;
        }
        return $column[$property];
    }

    public function orders()
    {
        return $this->get('order');
    }

    public function order($i)
    {
        if( ! is_array($orders = $this->orders()) )
        {
            return NULL;
        }
        if( ! array_key_exists($i, $orders) )
        {
            return NULL;
        }
        return $orders[$i];
    }

    /*
     *  Existing properties: column, dir
     */
    public function getOrderProperty($i, $property)
    {
        $order = $this->order($i);
        if( ! $order )
        {
            return NULL;
        }
        if( ! array_key_exists($property, $order) )
        {
            return NULL;
        }
        return $order[$property];
    }

    public function start()
    {
        return $this->get('start');
    }

    public function length()
    {
        return $this->get('length');
    }

    public function search()
    {
        return $this->get('search');
    }

    /*
     *  Existing properties: value, regex
     */
    public function getSearchProperty($property)
    {
        $search = $this->search();
        if( ! $search )
        {
            return NULL;
        }
        if( ! array_key_exists($property, $search) )
        {
            return NULL;
        }
        return $search[$property];
    }

    /* -----------------------------------------------------------------------------------------------------------
     *
     * WHERE
     *
     * ----------------------------------------------------------------------------------------------------------- */
    public function whereExpressionRecordCount()
    {
        return $this->whereFilteredProgramatically();
    } 

    protected function whereFilteredBySearch()
    {
        $search = $this->getSearchProperty('value');
        if( is_null($search) || (strlen($search) == 0) )
        {
            return NULL;
        }
        if( is_null($this->searchables->fields()) )
        {
            return NULL;
        }
        $search = \DB::getPdo()->quote($search);
        $search = "'%" . substr($search, 1, strlen($search) - 2) . "%'";
        $result = '';
        foreach($this->searchables->fields() as $i => $field)
        {
            $result .= "(CAST(`" . $field . "` AS CHAR) LIKE " . $search . ") OR ";
        }
        if( strlen($result) == 0)
        {
            return NULL;
        }
        return substr($result, 0, strlen($result) - 4);
    }

    protected function whereFilteredByColumns()
    {
        $result = '';
        foreach($this->searchables->fields() as $i => $field)
        {
            $property = $this->getColumnProperty($i, 'search');
            if( strlen($property['value']) > 0 )
            {
                $search = \DB::getPdo()->quote($property['value']);
                $search = "'%" . substr($search, 1, strlen($search) - 2) . "%'";
                $result .= "(CAST(`" . $field . "` AS CHAR) LIKE " . $search . ") AND ";
            }
        }
        if( strlen($result) == 0)
        {
            return NULL;
        }
        return substr($result, 0, strlen($result) - 5);
    }

    protected function rawFilterExpression($filter)
    {
        $result = '';
        $value  = $filter['value'];
        $field  = $filter['field'];
        $type   = $filter['type'];
        switch( $filter['operator'] )
        {
            case '=' :
                if( is_null($value) )
                {
                    $result = $field . ' is null';
                }
                else
                {
                    if($type == 'N')
                    {
                        $result = $field . '=' . $value;
                    }
                    else
                        if($type == 'C')
                        {
                            $result = $field . "='" . $value . "'";
                        }
                }
                break;
        }
        return $result;
    }

    protected function whereFilteredProgramatically()
    {
        $result = '';
        if( array_key_exists('filters', $this->input) )
        {
            foreach($this->input['filters'] as $i => $filter)
            {
                $expression = $this->rawFilterExpression( $filter );
                if($expression)
                {
                    $result .= '(' . $expression . ') AND ';
                }
            }
        }
        if( strlen($result) == 0)
        {
            return NULL;
        }
        return substr($result, 0, strlen($result) - 5);
    }

    public function whereExpression()
    {
        $result = '';
        foreach( $wheres = [ 
            $this->whereFilteredBySearch(),
            $this->whereFilteredByColumns(),
            $this->whereFilteredProgramatically()
        ] as $i => $expression)
        {
            if($expression)
            {
                $result .= '(' . $expression . ') AND ';
            }
        }   
        if( strlen($result) == 0)
        {
            return NULL;
        }
        return substr($result, 0, strlen($result) - 5);
    }

    /* -------------------------------------------------------------------------------------------------------------------
     *
     * ORDER
     *
     * ------------------------------------------------------------------------------------------------------------------ */
    protected function getOrderBy($map, $direction)
    {
        if( is_string($map) )
        {
            return $map . ' ' . $direction;
        }
        if( is_array($map) )
        {
            if(array_key_exists(0, $map) )
            {
                $result = $map[0] . ' ' . $direction . ', ';
                array_shift($map);
                foreach($map as $field => $dir)
                {
                    $result .= $this->getOrderBy($field, $dir) . ', ';
                }
                return substr($result, 0, strlen($result) - 2 );
            }
        }
        return NULL;
    }

    public function orderByExpression()
    {
        $result = '';

        foreach($this->orders() as $i => $item)
        {
            $order_column_index = $this->getOrderProperty($i, 'column');
            $order_direction    = $this->getOrderProperty($i, 'dir');
            if( $this->orderables->fields()->has($order_column_index) )
            {
                $map = $this->orderables->fields()->get($order_column_index);
                $part = $this->getOrderBy($map, $order_direction);
                if( ! is_null($part) )
                {
                    $result .= $part . ', ';
                }
            }
        }
        if( strlen($result) == 0 )
        {
            return NULL;
        }
        return substr($result, 0, strlen($result) - 2 );
    }
}
