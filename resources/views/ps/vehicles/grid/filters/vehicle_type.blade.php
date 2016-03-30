{!!
	App\Comptechsoft\Ui\Controls\Textbox::make()
	->label('')
	->icon('')
	->name('filter-by-column-extention')
	->value('')
	->addClass('datatable-filter-by-column')
	->withAttribute('data-column-index', 6)
	->withAttribute('data-column-search', "[%]")
	->placeholder(' Search by type ...')
	->render()
!!}