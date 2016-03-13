<?php namespace App\Comptech\Datatable\Grid;

class Ajax
{

    protected $url   = NULL;
    protected $extra = NULL;

    public function __construct( $url, $extra = NULL)
    {
    	$this->url   = $url;
    	$this->extra = $extra;
    }

    public function url()
    {
    	return $this->url;
    } 

    public function extra()
    {
    	return NULL;
    }

    public function setUrl( $url )
    {
        $this->url = $url;
        return $this;
    }
}
