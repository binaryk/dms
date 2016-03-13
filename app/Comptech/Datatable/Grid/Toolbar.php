<?php namespace App\Comptech\Datatable\Grid;

class Toolbar
{

    protected $view = NULL;
    protected $data = NULL;

    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function with($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function render()
    {
        return str_replace([Chr(13), Chr(10), Chr(9)], '', view($this->view)->with($this->data)->render() );
    }

}
