<?php namespace App\Repositories\PS\Vehicles;

use App\Models\PS\Vehicle;

class Form extends \App\Comptechsoft\Form\Form
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);
		
		$this->substantiv = 'Vehicle fisiere';

		$this->captions = [
	        'insert' => 'Adăugare ' . $this->substantiv,
	        'update' => 'Modificare ' . $this->substantiv . ' (#' . $this->id . ')',
	        'delete' => 'Ştergere ' . $this->substantiv,
	    ];

	    if( $id )
	    {
	    	$this->record(Vehicle::find( (int) $id ));
	    }

	    $this->view('ps.vehicles.form.index');


	}
}