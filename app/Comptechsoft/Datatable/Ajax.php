<?php namespace App\Comptechsoft\Datatable;

class Ajax
{
	protected $url   = NULL;
    protected $extra = NULL;

    public function url()
    {
    	return $this->url;
    } 

    public function extra()
    {
    	return $this->extra;
    }

    public function setUrl( $url )
    {
        $this->url = $url;
        return $this;
    }

    public function setExtra( $data )
    {
        $this->extra = $data;
        return $this;
    }
}