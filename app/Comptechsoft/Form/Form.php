<?php namespace App\Comptechsoft\Form;

use Illuminate\Support\Facades\File;

class Form
{
    protected $id     = NULL;
    protected $grid_id= NULL;
    protected $action = NULL;
    protected $view   = NULL;
    protected $route  = NULL;
    protected $record = NULL;
    protected $parameters = NULL;

    protected $captions = [
        'insert' => 'insert',
        'update' => 'update',
        'delete' => 'delete',
    ];

    protected $action_captions = [
        'insert' => 'Adaugă',
        'update' => 'Salvează',
        'delete' => 'Şterge',
    ];

    public function getParameter($property)
    {
        if( ! array_key_exists($property, $this->parameters) )
        {
            throw new \Exception(__CLASS__ . ': Nu avem proprietatea '.$property.' in parameters', 1);
        }
        return $this->parameters[$property];
    }

    public function setParameter($property, $value)
    {
        $this->parameters[$property] = $value;
        return $this;
    }

    public function setGridId($id)
    {
        $this->grid_id = $id;
        return $this;
    }

    public function getGridId()
    {
        return $this->grid_id;
    }


    public function __construct($action, $id, $record = NULL, $grid_id = NULL)
    {
        $this->id     = $id;
        $this->action = $action;
        $this->grid_id = $grid_id;
    }

    public function __call( $method, $arguments)
    {
        if( property_exists( $this, $method = strtolower($method)) )
        {
            if( is_array($arguments) )
            {
                if( array_key_exists(0, $arguments) )
                {
                    $this->{$method} = $arguments[0];
                    return $this;
                }
            }
            return $this->{$method};
        }
        throw new \Exception('Call invalid method ' . $method . ' on class  ' . __CLASS__ . '.', 1);
    }

    public function caption()
    {
        return $this->captions[$this->action];
    }

    public function actionCaption()
    {
        return $this->action_captions[$this->action];
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function render()
    {
        return '<form enctype="multipart/form-data" role="form" method="POST" id="'.($this->grid_id ? $this->grid_id : "gridDefault").'">' . view($this->view)->withAction($this->action)->withRecord($this->record)->withData($this->parameters)->render() . '</form>';
    }
}