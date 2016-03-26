<?php namespace App\Repositories\Files;

use App\Models\File;

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
			$this->record(File::find( (int) $id ));
			if($action === 'update' || $action === 'delete'){
				if(file_exists($this->record->path)){

					//sigur definesc view-ul
					$view =
						view()->exists($v = 'ui.file-icons.'.$this->record->extention) ?
						view($v) :
						view('ui.file-icons.txt');
					$this->setParameter('file',$view->withExt($this->record->extention)->withName(basename($this->record->path))->withUrl($this->record->location)->render());
				}else{
					$this->setParameter('file','<div id="file_not_found"></div>');
				}
			}else{
				$this->setParameter('file','<div id="insert"></div>');
			}

	    }

	    $this->view('director-files.form.index');
	}
}