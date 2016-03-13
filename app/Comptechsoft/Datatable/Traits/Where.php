<?php namespace App\Comptechsoft\Datatable\Traits;

trait Where
{

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
     * Aceasta se apeleaza cand omul baga text in filter-ul global al datatable
     * Returneaza string: whereRaw
     */
    protected function FilteredBySearch()
    {
        $search = $this->getSearchProperty('value');
        if( is_null($search) || (strlen($search) == 0) )
        {
            return NULL;
        }
        if( is_null($this->searcheables) )
        {
            return NULL;
        }
        $search = \DB::getPdo()->quote('%' . $search. '%');
        $result = '';
        foreach($this->searcheables as $i => $field)
        {
            $result .= "(CAST(`" . $field . "` AS CHAR) LIKE " . $search . ") OR ";
        }
        if( strlen($result) == 0)
        {
            return NULL;
        }
        return substr($result, 0, strlen($result) - 4);
    }

    protected function makeWhereExpression( $filter )
    {
        if( ! $filter )
        {
            return '';
        }
        if( strlen($filter->value) == 0 )
        {
            return '';
        }
        if($filter->type == 'string')
        {
            $filter->value = "'" . $filter->value . "'";
        }
        return $filter->field . $filter->operator . $filter->value;
    }

    /*
     * Aceasta sa apeleaza cond se face cautare din headerul coloanei cu YADCF
     *
     */
    protected function FilteredByColumns()
    {
        $result = '';
        foreach($this->searcheables as $i => $field)
        {
            $property = $this->getColumnProperty($i, 'search');
            if( strlen($property['value']) > 0 )
            {
                $value = $property['value']; 
                if( substr($value, 0, 4) == 'sql:' )
                {
                    // am primit direct un sql 
                    $expression = $this->makeWhereExpression(  json_decode( str_replace("'", '"', substr($value, 4) )) ); 
                    if( $expression )
                    {
                        $result .= '(' . $expression . ') AND ';
                    }
                }
                else
                {
                    $search = \DB::getPdo()->quote('%' . $property['value'] . '%');
                    $result .= "(CAST(`" . $field . "` AS CHAR) LIKE " . $search . ") AND ";
                }               
            }
        }
        if( strlen($result) == 0)
        {
            return NULL;
        }
        return substr($result, 0, strlen($result) - 5);
    }


    protected function getFilters()
    {
        return [
            'global-datatable-filter'  => $this->FilteredBySearch(),
            'columns-datatable-filter' => $this->FilteredByColumns()
        ];
    }

	public function Where()
	{
		$result = '';
        foreach($this->getFilters() as $i => $expression)
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

}
