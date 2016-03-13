<?php namespace App\Comptech\Datatable\Grid;

class Order
{

    protected $column    = NULL;
    protected $direction = NULL;

    public function __construct( $column, $direction = 'asc')
    {
    	$this->column    = $column;
    	$this->direction = $direction;
    }

    public function order()
    {
    	return "[" . $this->column . ", '" . $this->direction . "']";
    } 

}
