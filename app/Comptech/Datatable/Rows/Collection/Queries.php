<?php namespace App\Comptech\Datatable\Rows\Collection;

use \App\Comptech\Datatable\Rows\Searchables;
use \App\Comptech\Datatable\Rows\Orderables;
use \App\Comptech\Datatable\Rows\Input;

class Queries
{

    protected $input          = NULL;

    protected $totalQuery     = NULL;
    protected $filteredQuery  = NULL;
    protected $rowsQuery      = NULL;

    /*
     * constructor
     *  $input                   - Datatable input
     *  $totalQuery              - query pentru total
     *  $filteredQuery           - query pentru filtrate
     *  $rowsQuery               - query pentru date (rows)
     *  Searchables $searchables - coloanele de sortare
     *  Orderables $orderables   - coloanele de cautare
     */
    public function __construct($input, $totalQuery, $filteredQuery, $rowsQuery, Searchables $searchables, Orderables $orderables)
    {
        $this->input            = $input;
    	$this->totalQuery       = $totalQuery;
        $this->filteredQuery    = $filteredQuery;
        $this->rowsQuery        = $rowsQuery;

        $this->processInfo      = new Input($this->input, $searchables, $orderables);
    }

    public function totalRecordsCount()
    {
    	return call_user_func(
            $this->totalQuery, 
            $this->processInfo->whereExpressionRecordCount()
        );
    }

    public function filteredRecordsCount()
    {
    	return call_user_func(
            $this->filteredQuery, 
            $this->processInfo->whereExpression() 
        );
    }

    public function dataSet( )
    {
        return call_user_func(
            $this->rowsQuery, 
            $this->processInfo->start(), 
            $this->processInfo->length(), 
            $this->processInfo->whereExpression(), 
            $this->processInfo->orderByExpression(),
            $this->input
        );
    }
}
