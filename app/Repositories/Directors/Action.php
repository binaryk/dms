<?php namespace App\Repositories\Directors;

use App\Models\DirectorFiles;

class Action extends \App\Comptechsoft\Form\Action
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);

		if( $action == 'insert' )
        {
            $record = new DirectorFiles();
        }
        else
        {
            $record = DirectorFiles::find( (int) $id);
        }

        $this->record($record);

		$this
			->addRule(['insert', 'update'], 'name', 'required', 'Denumirea fișierului trebuie completata')
		;
	}
}