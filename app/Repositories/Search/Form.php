<?php namespace App\Repositories\Search;

use App\Models\File;

class Form extends \App\Comptechsoft\Form\Form
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);
		
		$this->substantiv = 'File fisiere';

		$this->captions = [
	        'insert' => 'Adăugare ' . $this->substantiv,
	        'update' => 'Modificare ' . $this->substantiv . ' (#' . $this->id . ')',
	        'delete' => 'Ştergere ' . $this->substantiv,
	    ];

	    if( $id )
	    {
	    	$this->record(File::find( (int) $id ));
	    }

	    $this->view('search.form.index');


	}
}