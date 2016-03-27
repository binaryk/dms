<?php namespace App\Repositories\Superadmin\Nomenclatoare\Categories;

use App\Models\Nomenclatoare\Categorie;

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
	    	$this->record(Categorie::find( (int) $id ));
	    }

	    $this->view('superadmin.nomenclatoare.categories.form.index');


	}
}