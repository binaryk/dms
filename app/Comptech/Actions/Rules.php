<?php namespace App\Comptech\Actions;

class Rules
{
	protected $rules    = NULL;
	protected $messages = NULL;
	protected $id       = NULL;

	public function __construct($id)
	{
		$this->rules    = [
			'insert'  => [],
			'update'  => [],
			'delete'  => [],
		];
		$this->messages = [
			'insert'  => [],
			'update'  => [],
			'delete'  => [],
		];
		$this->id = $id;
	}

	public function add($actions, $field, $rule, $message)
	{
		foreach($actions as $i => $action)
		{
			$this->rules[$action][$field][] = $rule;
			$pos = strpos($rule,':');
			if( $pos === false )
			{
				$key = $rule;
			}
			else
			{
				$key = substr( $rule, 0, $pos );
			}
			$this->messages[$action][$field][$key] = $message;
		}
		return $this;
	}

	public function rules( $action )
	{
		return $this->rules[$action];
	}

	public function messages( $action )
	{
		$result = [];
		foreach($this->messages[$action] as $field => $messages)
		{
			foreach($messages as $rule => $message)
			{
				$result[$field . '.' . $rule] = $message;
			}
		}
		return $result;
	}
}