<?php namespace App\Comptechsoft\Form;

class Form
{
    protected $id     = NULL;
    protected $action = NULL;
    protected $view   = NULL;
    protected $route  = NULL;
    protected $record = NULL;

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

    public function __construct($action, $id, $record = NULL)
    {
        $this->id     = $id;
        $this->action = $action;
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
        return view($this->view)->withAction($this->action)->withRecord($this->record)->render();
    }
}