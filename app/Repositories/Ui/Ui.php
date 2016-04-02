<?php namespace App\Repositories\Ui;

class Ui 
{
    protected $view = NULL;
    protected $data = NULL;
    
    public function __construct( $view, $data )
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function __call( $method, $args )
    {
        if(! isset($args[0]))
            return $this;
       $this->data[$method] = $args[0];
       return $this;
    }

    public static function make( $view = NULL, $data = NULL )
    {
        return new static( $view, $data );
    }

    public function setFlag( $key, $flag )
    {
        if( $flag )
        {
            $this->data['attributes'][$key] = true;
        }
        else
        {
            if( array_key_exists($key, $this->data['attributes']) )
            {
                $this->data['attributes'][$key] = NULL;
                unset($this->data['attributes'][$key]);
            }
        }
        return $this;
    }

    public function readonly( $flag )
    {
       return $this->setFlag('readonly', $flag);
    }

    public function render()
    {
        return view($this->view)->with($this->data)->render();
    }
}
