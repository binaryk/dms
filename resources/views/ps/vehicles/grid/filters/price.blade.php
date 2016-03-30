{!!
	App\Comptechsoft\Ui\Controls\Textbox::make()
	->label('')
	->icon('')
	->name('filter-by-column-price')
	->value('')
	->addClass('datatable-filter-by-column')
	->withAttribute('data-column-index', 7)
	->withAttribute('data-column-search', "[%]")
	->placeholder(' Search by price ...')
	->render()
!!} 