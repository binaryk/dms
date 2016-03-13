<?php namespace App\Comptech\Actions;

class Upload
{
	protected $file       = NULL;
	protected $rules      = [];
	protected $messages   = [];
	protected $path       = NULL;
	protected $file_name  = NULL;

	public function __construct($file)
	{
		$this->file = $file;
	}

	protected function data()
	{
		return [
			'file'      => $this->file,
			'name'      => $this->file->getClientOriginalName(),
			'extension' => strtolower($this->file->getClientOriginalExtension()),
		];
	}

	public function rules($rules)
	{
		$this->rules = $rules;
		return $this;
	}

	public function messages($messages)
	{
		$this->messages = $messages;
		return $this;
	}

	public function path($path)
	{
		$this->path = $path;
		return $this;
	}

	public function filename($name)
	{
		$this->file_name = $name;
		return $this;
	}

	public function upload()
	{
		if( is_null($this->file) )
		{
			return ['success'=> false, 'error' => 'file-not-found'];
		}
		$validator = \Validator::make($this->data(), $this->rules, $this->messages);
		if( $validator->fails() )
		{
			return ['success'=> false, 'error' => $validator->messages()->all()];
		}
		try
		{
			$this->file->move( $this->path,  $this->file_name );
			$result = ['success' => true, 'message' => 'upload-success'];
		}
		catch(\Exception $e)
		{
			$result = ['success' => false, 'error' => $e->getMessage()];
		}
		return $result;
	}
}