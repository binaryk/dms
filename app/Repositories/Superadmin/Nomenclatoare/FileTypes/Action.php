<?php namespace App\Repositories\Superadmin\Nomenclatoare\FileTypes;

use App\Models\Nomenclatoare\FileTypes;

class Action extends \App\Comptechsoft\Form\Action
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);

		if( $action == 'insert' )
        {
            $record = new FileTypes();
        }
        else
        {
            $record = FileTypes::find( (int) $id);
        }

        $this->record($record);

		$this
			->addRule(['insert', 'update'], 'categorie', 'required', 'Denumirea categoriei de fisiere trebuie completată')
			->addRule(['insert', 'update'], 'categorie', 'max:128', 'Numărul maxim de caractere este 128')
		;
	}
}