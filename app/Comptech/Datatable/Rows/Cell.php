<?php namespace App\Comptech\Datatable\Rows;

class Cell
{

    protected $id        = NULL;
    protected $presenter = NULL;
    protected $infos     = [];

    public function __construct( $id, $presenter = NULL, $infos = [])
    {
        $this->id 	     = $id;
        $this->presenter = $presenter;
        $this->infos     = $infos;
    }

    public function id()
    {
        return $this->id;
    }

    public function setPresenter($presenter)
    {
        $this->presenter = $presenter;
        return $this;
    }

    public function setData($infos)
    {
        $this->infos = $infos;
        return $this;
    }

    public function render($record)
    {
        if( ! is_null($this->presenter) )
        {
            /**
             * View
             **/
            if( is_string($this->presenter) ) 
            {
                return view($this->presenter)->with([ 'record' => $record, 'infos' => $this->infos])->render();
            }
            /**
             * Closure
             **/
            $reflection = new \ReflectionFunction($this->presenter);
            if( $reflection->isClosure() )
            {
                $presenter = $this->presenter;
                return $presenter($record);
            }
        }
        return NULL;
    }

}
