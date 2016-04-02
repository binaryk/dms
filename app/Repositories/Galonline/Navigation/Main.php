<?php namespace App\Repositories\Galonline\Navigation;

use App\Models\Archive;
use App\Models\Director;
use App\Models\File;

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
				->icon('icon fa icon-home')
				->caption( trans('sidebar.home') )
				->show(true)
		);
		if(env('APP_ENV') === 'daw') {

			$this->menu->addOption('posts-daw',
				\App\Repositories\Ui\Navigation\Option::make()
					->class(\Request::is('posts*') ? 'active' : '')
					->url(\URL::route('posts.index'))
					->icon('icon icon-paper-clip')
					->caption(trans('sidebar.posts'))
					->show(true)
			);
		}
		if(env('APP_ENV') === 'daw') {
			$this->menu->addOption('contact',
				\App\Repositories\Ui\Navigation\Option::make()
					->class(\Request::is('daw-contact*') ? 'active' : '')
					->url(\URL::route('daw.contact.index'))
					->icon('icon icon-envelope')
					->caption(trans('messages.welcome.contact'))
					->show(true)
			);
		}
		if(env('APP_ENV') === 'ps') {

			$this->menu->addOption('vehicles.index',
				\App\Repositories\Ui\Navigation\Option::make()
					->class(\Request::is('vehicles*') ? 'active' : '')
					->url(\URL::route('ps.vehicles.index'))
					->icon('fa fa-automobile')
					->caption('Vehicles')
					->show(true)
			);

			$this->menu->addOption('parsator.index',
				\App\Repositories\Ui\Navigation\Option::make()
					->class(\Request::is('parsator') ? 'active' : '')
					->url(\URL::route('ps.parsator.index'))
					->icon('fa fa-file')
					->caption('Parsator')
					->show(true)
			);

			$this->menu->addOption('parsator.report',
				\App\Repositories\Ui\Navigation\Option::make()
					->class(\Request::is('parsator-report*') ? 'active' : '')
					->url(\URL::route('ps.parsator.report'))
					->icon('fa fa-archive')
					->caption('Report')
					->show(true)
			);
		}

        if(env('APP_ENV') === 'local' || env('APP_ENV') === 'production'){
            $this->menu->addDropdown('file-structure',
                \App\Repositories\Ui\Navigation\Dropdown::make()
                ->id('file-structure')
                ->icon('icon fa fa-folder')
                ->active((\Request::is('file-structure*') || \Request::is('director-files*') )  ? 'active' : '')
                ->caption( trans('sidebar.file_struct') )
                ->count('2')
                /*Structura de documente/foldere*/
                ->addOption('structura_individuala',
                    \App\Repositories\Ui\Navigation\Option::make()
                    ->class(( \Request::is('file-structure') || \Request::is('director-files*')) ? 'active' : '')
                    ->url(\URL::route('file_structure.index') )
                    ->icon('')
                    ->caption( trans('sidebar.folder_structure') )
                    ->show(true)
                    ->count(Director::owners() != [] ? Director::owners()->count() - 1 : 0)
                )
                ->addOption('search',
                    \App\Repositories\Ui\Navigation\Option::make()
                    ->class( \Request::is('search')  ? 'active' : '')
                    ->url(\URL::route('search.index') )
                    ->icon('')
                    ->caption( trans('sidebar.search') )
                    ->show(true)
                    ->count(File::count())
                )
            );



            $this->menu->addOption('archives',
                \App\Repositories\Ui\Navigation\Option::make()
                    ->class(\Request::is('archive*') ? 'active' : '')
                    ->url(\URL::route('archives.index'))
                    ->icon('icon fa fa-archive')
                    ->caption(trans('sidebar.archives'))
                    ->show(true)
                    ->count(Archive::count())
            );


            $this->menu->addDropdown('nomenclatoare-dropdown',
                \App\Repositories\Ui\Navigation\Dropdown::make()
                    ->id('nomenclatoare-dropdown')
                    ->icon('icon fa fa-book')
                    ->active(\Request::is('superadmin/nomenclatoare/*') ? 'active' : '')
                    ->caption( trans('sidebar.nomenclator') )
                    ->count('2')
                    /*Tipuri de documente acceptate*/
                    ->addOption('tipuri-documente-dropdown',
                        \App\Repositories\Ui\Navigation\Option::make()
                            ->class(\Request::is('superadmin/nomenclatoare/file-types') ? 'active' : '')
                            ->url(route('superadmin.nomenclatoare.file-types.index') )
                            ->icon('')
                            ->caption( trans('sidebar.doc_type') )
                            ->show(true)
                    )
                    ->addOption('categorii-dropdown',
                        \App\Repositories\Ui\Navigation\Option::make()
                            ->class(\Request::is('superadmin/nomenclatoare/categories') ? 'active' : '')
                            ->url(route('superadmin.nomenclatoare.categories.index') )
                            ->icon('')
                            ->caption( trans('sidebar.categories') )
                            ->show(true)
                    )
            );
        }

    }

	public function __construct( \App\Repositories\Ui\Navigation\Sidemenu $menu, \App\Models\Access\User\User $user = NULL)
	{
		$this->user = $user;
		$this->menu = $menu;
		$this->createMenu();
	}

}
