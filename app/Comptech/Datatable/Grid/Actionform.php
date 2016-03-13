<?php namespace App\Comptech\Datatable\Grid;

class Actionform
{

    protected $config_file = NULL;

    protected $action = NULL;
    protected $id     = NULL;
    protected $model  = NULL;
    protected $record = NULL;

    protected $title  = NULL;
    protected $views  = [
        'insert' => NULL,
        'update' => NULL,
        'delete' => NULL
    ];
    protected $data   = NULL;
    protected $footers = [
        'insert' => NULL,
        'update' => NULL,
        'delete' => NULL
    ];
    protected $titles = [
        'insert' => 'Insert',
        'update' => 'Update',
        'delete' => 'Delete'
    ];
    protected $url = NULL;

    protected function makeFromConfig($configs)
    {
        $lang  = config($this->config_file . '.lang_path');
        $views = config($this->config_file . '.views_path');        
        foreach(['insert', 'update', 'delete'] as $i => $key)
        {
            $this->setTitle($key, trans($lang . '.actions.titles.' . $key));
            $this->setView($key, $views . '.form.' . $configs[$key]['view-form'] );
            $this->setFooter($key, $this->btnDo($key, \URL::route($configs[$key]['route'])) . $this->btnCancel() );
        }
    }

    protected function getRecord()
    {
        if( $this->id != 0)
        {
            return call_user_func([$this->model, 'find'], $this->id);
        }
        return NULL;
    }

    public function __construct($data = [])
    {
        $this->data   = $data;
        $this->action = $data['action'];
        $this->id     = $data['id'];
        $this->model  = $data['model'];
        $this->record = $this->getRecord();
        if( $configs = config($this->config_file . '.actions') )
        {
            $this->makeFromConfig($configs);
        }
    }

    protected function getTitle()
    {
        return $this->titles[$this->action];
    }

    protected function getBody()
    {
        return view($this->views[$this->action])->with($this->data + ['record' => $this->record])->render();
    }

    protected function getFooter()
    {
        return $this->footers[$this->action];
    }

    protected function setTitle($action, $title)
    {
        $this->titles[$action] = $title;
        return $this;
    }

    protected function setView($action, $title)
    {
        $this->views[$action] = $title;
        return $this;
    }

    protected function setFooter($action, $title)
    {
        $this->footers[$action] = $title;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this; 
    }

    protected function btnDo( $action, $url )
    {
        if( $this->url )
        {
            $url = $this->url;
        }
        return '<button type="button" class="btn btn-primary btn-action ladda-button" data-route="' . $url . '" data-action="' . $action . '" data-id="' . ($this->record ? $this->record->id : 0) . '" data-style="expand-left"><span class="ladda-label">' . trans('actions.' . $action ) . '</span></button>';
    }

    protected function btnCancel()
    {
        return '<button type="button" class="btn btn-default" data-dismiss="modal">' . trans('actions.cancel') . '</button>';
    }

    public function render()
    {
        return [
            'title'  => $this->getTitle(),
            'body'   => $this->getBody(),
            'footer' => $this->getFooter(),
            'action' => $this->action,
            'record' => $this->record,
        ];
    }

}
