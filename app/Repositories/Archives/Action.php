<?php namespace App\Repositories\Archives;

use App\Models\Archive;

class Action extends \App\Comptechsoft\Form\Action
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);

		if( $action == 'insert' )
        {
            $record = new Archive();
        }
        else
        {
            $record = Archive::find( (int) $id);
        }

        $this->record($record);

		$this
			->addRule(['insert', 'update'], 'name', 'required', 'Denumirea fișierului trebuie completata')
		;
	}
}