<?php namespace App\Repositories\Search;

use App\Models\File;

class Action extends \App\Comptechsoft\Form\Action
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);

		if( $action == 'insert' )
        {
            $record = new File();
        }
        else
        {
            $record = File::find( (int) $id);
        }

        $this->record($record);

		$this
			->addRule(['insert', 'update'], 'denumire', 'required', 'Denumirea categoriei de fisiere trebuie completată')
		;
	}
}