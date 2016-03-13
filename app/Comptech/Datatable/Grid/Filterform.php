<?php namespace App\Comptech\Datatable\Grid;

class Filterform
{

    protected $title  = NULL;
    protected $view   = NULL;
    protected $data   = NULL;
    protected $footer = NULL;

    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;    
    }

    public function render()
    {
        $this->footer = '<button type="button" class="btn btn-primary btn-filter" data-action="filter">' . trans('actions.filter-by') . '</button><button type="button" class="btn btn-default" data-dismiss="modal">'. trans('actions.cancel') . '</button>';

        return [
            'title' => $this->title,
            'body'  => view($this->view)->with($this->data)->render(),
            'footer' => $this->footer,
        ];
    }

}
