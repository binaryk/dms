<?php namespace App\Repositories\Galonline\Navigation;

class Main
{

	protected $menu = NULL;
	protected $user = NULL;


    protected function createMenu()
    {
		$this->menu->addOption('main-gali',
			\App\Repositories\Ui\Navigation\Option::make()
				->class(\Request::is('/') ? 'active' : '')
				->url(\URL::to('/'))
				->icon('icon fa fa-home')
				->caption( trans('sidebar.home') )
				->show(true)
		);
		if(env('APP_ENV') === 'daw') {

			$this->menu->addOption('posts-daw',
				\App\Repositories\Ui\Navigation\Option::make()
					->class(\Request::is('posts*') ? 'active' : '')
					->url(\URL::route('posts.index'))
					->icon('icon fa fa-envelope')
					->caption(trans('sidebar.posts'))
					->show(true)
			);
		}
		if(env('APP_ENV') === 'ps') {

			$this->menu->addOption('user_accounts',
				\App\Repositories\Ui\Navigation\Option::make()
					->class(\Request::is('ps/user-accounts*') ? 'active' : '')
					->url(\URL::route('ps.accounts.index'))
					->icon('icon fa fa-users')
					->caption('User accounts')
					->show(true)
			);
		}


    	$this->menu->addDropdown('file-structure',
	        \App\Repositories\Ui\Navigation\Dropdown::make()
	        ->id('file-structure')
	        ->icon('icon fa fa-folder')
	        ->active(\Request::is('file-structure*') ? 'active' : '')
	        ->caption( trans('sidebar.file_struct') )
            ->count('1')
            /*Structura de documente/foldere*/
	        ->addOption('structura_individuala',
	            \App\Repositories\Ui\Navigation\Option::make()
	            ->class(\Request::is('file-structure') ? 'active' : '')
	            ->url(\URL::route('file_structure.index') )
	            ->icon('')
	            ->caption( trans('sidebar.doc_type') )
	            ->show(true)
	        )
	    );


        $this->menu->addDropdown('nomenclatoare-dropdown',
            \App\Repositories\Ui\Navigation\Dropdown::make()
                ->id('nomenclatoare-dropdown')
                ->icon('icon fa fa-book')
                ->active(\Request::is('admin/type-docs*') ? 'active' : '')
                ->caption( trans('sidebar.nomenclator') )
                ->count('1')
                /*Tipuri de documente acceptate*/
                ->addOption('tipuri-documente-dropdown',
                    \App\Repositories\Ui\Navigation\Option::make()
                        ->class('')
                        ->url(\URL::to('/') )
                        ->icon('')
                        ->caption( trans('sidebar.doc_type') )
                        ->show(true)
                )
        );
    }

	public function __construct( \App\Repositories\Ui\Navigation\Sidemenu $menu, \App\Models\Access\User\User $user = NULL)
	{
		$this->user = $user;
		$this->menu = $menu;
		$this->createMenu();
	}

}
