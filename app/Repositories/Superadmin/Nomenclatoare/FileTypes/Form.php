<?php namespace App\Repositories\Superadmin\Nomenclatoare\FileTypes;

use App\Models\Nomenclatoare\FileTypes;

class Form extends \App\Comptechsoft\Form\Form
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);
		
		$this->substantiv = 'Categorie fisiere';

		$this->captions = [
	        'insert' => 'Adăugare ' . $this->substantiv,
	        'update' => 'Modificare ' . $this->substantiv . ' (#' . $this->id . ')',
	        'delete' => 'Ştergere ' . $this->substantiv,
	    ];

	    if( $id )
	    {
	    	$this->record(FileTypes::find( (int) $id ));
	    }

	    $this->view('superadmin.nomenclatoare.file-types.form.index');


	}
}