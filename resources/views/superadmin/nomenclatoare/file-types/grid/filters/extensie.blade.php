{!!
	App\Comptechsoft\Ui\Controls\Textbox::make()
	->label('')
	->icon('')
	->name('filter-by-column-extensie')
	->value('')
	->addClass('datatable-filter-by-column')
	->withAttribute('data-column-index', 2)
	->withAttribute('data-column-search', "[%]")
	->placeholder(' Caută după extensie ...')
	->render()
!!}