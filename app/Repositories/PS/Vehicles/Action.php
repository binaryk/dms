<?php namespace App\Repositories\PS\Vehicles;

use App\Models\PS\Vehicle;

class Action extends \App\Comptechsoft\Form\Action
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);

		if( $action == 'insert' )
        {
            $record = new Vehicle();
        }
        else
        {
            $record = Vehicle::find( (int) $id);
        }

        $this->record($record);

		$this
			->addRule(['insert', 'update'], 'model', 'required', 'Model is required')
		;
	}
}