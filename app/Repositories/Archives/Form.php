<?php namespace App\Repositories\Archives;

use App\Models\Archive;

class Form extends \App\Comptechsoft\Form\Form
{

	public function __construct($action, $id, $grid_id = NULL)
	{
		parent::__construct($action, $id, $grid_id);
		
		$this->substantiv = 'Fisiere din folder';

		$this->captions = [
	        'insert' => 'Adăugare ' . $this->substantiv,
	        'update' => 'Modificare ' . $this->substantiv . ' (#' . $this->id . ')',
	        'delete' => 'Ştergere ' . $this->substantiv,
	    ];

	    if( $id )
	    {
			$this->record(Archive::find( (int) $id ));

	    }

	    $this->view('archives.form.index');
	}
}