{!!
	App\Comptechsoft\Ui\Controls\Textbox::make()
	->label('')
	->icon('')
	->name('filter-by-column-description')
	->value('')
	->addClass('datatable-filter-by-column')
	->withAttribute('data-column-index', 3)
	->withAttribute('data-column-search', "[%]")
	->placeholder('Search by make ...')
	->render()
!!} 