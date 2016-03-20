<?php namespace App\Repositories\Directors;

use App\Models\DirectorFiles;

class Form extends \App\Comptechsoft\Form\Form
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);
		
		$this->substantiv = 'Fisiere din folder';

		$this->captions = [
	        'insert' => 'Adăugare ' . $this->substantiv,
	        'update' => 'Modificare ' . $this->substantiv . ' (#' . $this->id . ')',
	        'delete' => 'Ştergere ' . $this->substantiv,
	    ];

	    if( $id )
	    {
	    	$this->record(DirectorFiles::find( (int) $id ));
	    }

	    $this->view('director-files.form.index');


	}
}