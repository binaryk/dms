<?php namespace App\Repositories\Superadmin\Nomenclatoare\CategoriiParteneri;

use App\Models\Nomenclatoare\Categoriepartener;

class Form extends \App\ComptechSoft\Form\Form
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);
		
		$this->substantiv = 'Categorie partener';

		$this->captions = [
	        'insert' => 'Adăugare ' . $this->substantiv,
	        'update' => 'Modificare ' . $this->substantiv . ' (#' . $this->id . ')',
	        'delete' => 'Ştergere ' . $this->substantiv,
	    ];

	    if( $id )
	    {
	    	$this->record(Categoriepartener::find( (int) $id ));
	    }

	    $this->view('superadmin.nomenclatoare.categorii-parteneri.form.index');


	}
}