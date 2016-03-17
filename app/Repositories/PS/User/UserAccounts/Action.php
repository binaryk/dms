<?php namespace App\Repositories\Superadmin\Nomenclatoare\CategoriiParteneri;

use App\Models\PS\UserAccounts;

class Action extends \App\ComptechSoft\Form\Action
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);

		if( $action == 'insert' )
        {
            $record = new UserAccounts();
        }
        else
        {
            $record = UserAccounts::find( (int) $id);
        }

        $this->record($record);

		$this
			->addRule(['insert', 'update'], 'categorie', 'required', 'Denumirea categoriei de partener trebuie completată')
			->addRule(['insert', 'update'], 'categorie', 'max:128', 'Numărul maxim de caractere este 128')
		;
	}
}