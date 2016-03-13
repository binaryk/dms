<?php namespace App\Repositories\Galonline\Navigation;

class ProfilGal
{

	protected $menu = NULL;
	protected $user = NULL;
	protected $gal  = NULL;
    
    protected $has_role_superadmin = false;

	public function __construct( \App\Repositories\Ui\Navigation\Sidemenu $menu, \App\Models\Access\User\User $user = NULL, \App\Models\Admin\Gal\Gal $gal)
	{

		$this->user = $user;
		$this->menu = $menu;
		$this->gal  = $gal;

		$this->has_role_superadmin = $user->hasRole('Superadmin');

		$this->menu->addDropdown('profil-gal-dropdown', 
	        \App\Repositories\Ui\Navigation\Dropdown::make()
	        ->id('profil-gal-dropdown')
	        ->icon('icon fa fa-book')
	        ->active('active')
	        ->caption( trans('navigation.profil-gal.title') )
	        /*
	         * Acoperirea geografica
	         */
	        ->addOption('profil-gal-dropdown-acoperire-geografica', 
	            \App\Repositories\Ui\Navigation\Option::make()
	            ->class('')
	            ->url(\URL::route('admin-profil-gal-acoperire-geografica-index', ['id' => $gal->id]))
	            ->icon('')
	            ->caption(trans('navigation.profil-gal.lista-acoperire-geografica'))
	            ->show($this->has_role_superadmin)
	        )
	        /*
	         * Banci
	         */
	        ->addOption('profil-gal-dropdown-banci', 
	            \App\Repositories\Ui\Navigation\Option::make()
	            ->class('')
	            ->url(\URL::route('admin-profil-gal-banci-index', ['id' => $gal->id]))
	            ->icon('')
	            ->caption(trans('navigation.profil-gal.lista-banci'))
	            ->show($this->has_role_superadmin)
	        )
	        /*
	         * Documente
	         */
	        ->addOption('profil-gal-dropdown-documente', 
	            \App\Repositories\Ui\Navigation\Option::make()
	            ->class('')
	            ->url(\URL::route('admin-profil-gal-documente-index', ['id' => $gal->id]))
	            ->icon('')
	            ->caption(trans('navigation.profil-gal.lista-documente'))
	            ->show($this->has_role_superadmin)
	        )
	        /*
	         * Reprezentanti legali
	         */
	        ->addOption('profil-gal-dropdown-reprezentanti-legali', 
	            \App\Repositories\Ui\Navigation\Option::make()
	            ->class('')
	            ->url(\URL::route('admin-profil-gal-reprezentanti-legali-index', ['id' => $gal->id]))
	            ->icon('')
	            ->caption(trans('navigation.profil-gal.lista-reprezentanti-legali'))
	            ->show($this->has_role_superadmin)
	        )
	        /*
	         * Utilizatori
	         */
	        ->addOption('profil-gal-dropdown-utilizatori', 
	            \App\Repositories\Ui\Navigation\Option::make()
	            ->class('')
	            ->url(\URL::route('admin-profil-gal-utilizatori-index', ['id' => $gal->id]))
	            ->icon('')
	            ->caption( trans('navigation.profil-gal.lista-utilizatori') )
	            ->show($this->has_role_superadmin)
	        )
	        
	        
	        
	    );
		$this->menu->addOption('back-to-lista-gali', 
	        \App\Repositories\Ui\Navigation\Option::make()
	        ->class('')->icon('icon fa fa-chevron-left')->caption( trans('navigation.lista-gali') )->show(true)
	        ->url(\URL::route('admin-gali-index'))
	    );
	}

}
