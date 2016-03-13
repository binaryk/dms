<?php namespace App\Comptech\Actions;

/**
 * -> Implementeaza actiuni (actions) elementare asupra unui model
 * -> Actiunile elementare sunt considerate: insert, update|edit, delete
 * -> Aceastea clasa se va extinde in folderul Repositories\Actions pentru fiecare model in parte
 **/

class Actions
{

	protected $model    = NULL; // modelul care executa actiunea
	protected $id       = NULL; // id-ul inregistrarii
	protected $action   = NULL; // actiunea executata: insert, update, delete
	protected $data     = NULL; // datele transmise
	protected $rules    = NULL; // reguli de validare (vezi clasa Rules)

	public function __construct($model, $action, $data, $id)
	{
		$this->model  = $model;
		$this->action = $action;
		$this->data   = $data;
		$this->id     = $id;
	}

	protected function rules()
	{
		return $this->rules->rules($this->action);
	}

	protected function messages()
	{
		return $this->rules->messages($this->action);
	}

	public function doIt()
	{
		if( $this->action != 'delete' )
		{
			$validator = \Validator::make( $this->data, $this->rules(), $this->messages() );
			if ($validator->fails() )
			{
				return [
					'success'     => false,
					'record'      => NULL,
					'error-type'  => 'rules',
					'errors'      => $validator->messages(),
					'messges'     => [],
				];
			}
		}
		try
		{
			$record = call_user_func( [$this->model, $this->action . 'Record' ], $this->data, $this->id);
            return [
            	'success'     => true,
            	'record'      => $record,
            	'error-type'  => '',
            	'errors'      => [],
            	'messages'    => [],
            ];
        }
		catch(\Exception $e)
		{
			return [
            	'success'     => false,
            	'record'      => NULL,
            	'error-type'  => 'exception',
            	'errors'      => [ $e->getMessage() ],
            	'messages'    => [],
            ];
		}

	}
}