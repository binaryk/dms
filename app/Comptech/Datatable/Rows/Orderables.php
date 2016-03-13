<?php namespace App\Comptech\Datatable\Rows;

class Orderables
{

	protected $fields = NULL;
   
    public function __construct( )
    {
    	$this->fields = new \Illuminate\Support\Collection();
    }

    public function add( $column_index, $field )
    {
        $this->fields->put($column_index, $field);
        return $this;
    }

    public function fields()
    {
        return $this->fields;
    }

}
