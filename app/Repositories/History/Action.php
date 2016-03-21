<?php namespace App\Repositories\History;

use App\Models\FileHistory;

class Action extends \App\Comptechsoft\Form\Action
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);

		if( $action == 'insert' )
        {
            $record = new FileHistory();
        }
        else
        {
            $record = FileHistory::find( (int) $id);
        }

        $this->record($record);

		$this
			->addRule(['insert', 'update'], 'name', 'required', 'Denumirea fișierului trebuie completata')
		;
	}
}