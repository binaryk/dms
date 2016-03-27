{!!
	App\Comptechsoft\Ui\Controls\Textbox::make()
	->label('')
	->icon('')
	->name('filter-by-column-author')
	->value('')
	->addClass('datatable-filter-by-column')
	->withAttribute('data-column-index', 5)
	->withAttribute('data-column-search', "[%]")
	->placeholder(' Caută după autor ...')
	->render()
!!} 