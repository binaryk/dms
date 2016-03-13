<?php namespace App\Http\Controllers\Basic;

class DatatableController extends BaseController
{

    protected $config_file = NULL;
    protected $config_keys = ['views_path', 'repo_path', 'lang_path', 'model', 'parent_model'];

	protected $views_path = NULL;
	protected $repo_path  = NULL;
	protected $lang_path  = NULL;
	protected $model      = NULL;

    protected $parent_model = NULL;
    protected $record       = NULL;

    public function __construct()
    {
        parent::__construct();
        if($this->config_file)
        {
            $configs = config($this->config_file);
            foreach($this->config_keys as $i => $key)
            {
                if( array_key_exists($key, $configs) )
                {
                    $this->{$key} = $configs[$key];
                }
            }
        }
    } 

	protected function data()
	{
		return 
			parent::data() + 
			[
                'datatable'   => (new \ReflectionClass($this->repo_path . '\Grid'))->newInstanceArgs([\Input::all() + $this->gridExtraData()]),
                'title'       => trans($this->lang_path . '.datatable.title'),
                'description' => trans($this->lang_path . '.datatable.description'),
                'record'      => $this->record,
            ];
	}

    public function index($id = NULL)
    {
        if( ! is_null($id) )
        {
            $this->record = call_user_func([$this->parent_model, 'find'], (int) $id);
        }
       	$this->beforeIndex();
        return view($this->views_path . '.index')->with($this->data());
    }

    public function rows($id = NULL)
    {
        $rows = (new \ReflectionClass($this->repo_path . '\Rows'))->newInstanceArgs([\Input::all() + $this->rowsExtraData($id) ]);
        return $rows->response();
    }

    public function getActionForm($id = NULL)
    {
    	$form = (new \ReflectionClass($this->repo_path . '\ActionForm'))->newInstanceArgs([[
            'action' => \Input::get('action'),
            'id'     => \Input::get('id'),
            'model'  => $this->model,
        ] + $this->actionFormExtraData($id) ]);
        return \Response::json( $form->render() );
    }

    public function doAction($id = NULL)
    {
    	$action = (new \ReflectionClass($this->repo_path . '\Actions'))->newInstanceArgs([
    		$this->model,
            \Input::get('action'), 
            \Input::get('data'),
            \Input::get('id')
        ]);
        return \Response::json($action->doIt());
    }

    public function getFilterByForm()
    {
    	$form = (new \ReflectionClass($this->repo_path . '\Filterform'))->newInstanceArgs([$this->views_path . '.filter.form', []]);
        return \Response::json( $form->render() );
    }

    protected function gridExtraData()
    {
        return [];
    }

    protected function rowsExtraData($id)
    {
        return [];
    }

    protected function actionFormExtraData($id)
    {
        return [];
    }
}
