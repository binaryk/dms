<?php namespace App\Comptechsoft\Datatable;

class Order
{

    protected $column    = NULL;
    protected $direction = NULL;

    public function setColumn($index)
    {
        $this->column = $index;
        return $this;
    }

     public function setDirection($direction)
    {
        $this->direction = $direction;
        return $this;
    }

    public function order()
    {
    	return "[" . $this->column . ", '" . $this->direction . "']";
    } 

}
