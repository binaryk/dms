{!!
	App\Comptechsoft\Ui\Controls\Textbox::make()
	->label('')
	->icon('')
	->name('filter-by-column-version')
	->value('')
	->addClass('datatable-filter-by-column')
	->withAttribute('data-column-index', 4)
	->withAttribute('data-column-search', "[%]")
	->placeholder(' Caută după versiune ...')
	->render()
!!} 