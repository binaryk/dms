<?php namespace App\Repositories\Superadmin\Nomenclatoare\Categories;

use App\Models\Nomenclatoare\Categorie;

class Action extends \App\Comptechsoft\Form\Action
{

	public function __construct($action, $id)
	{
		parent::__construct($action, $id);

		if( $action == 'insert' )
        {
            $record = new Categorie();
        }
        else
        {
            $record = Categorie::find( (int) $id);
        }

        $this->record($record);

		$this
			->addRule(['insert', 'update'], 'denumire', 'required', 'Denumirea categoriei de fisiere trebuie completată')
			->addRule(['insert', 'update'], 'denumire', 'max:128', 'Numărul maxim de caractere este 128')
		;
	}
}