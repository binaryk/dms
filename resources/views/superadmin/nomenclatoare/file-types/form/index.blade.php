<div class="row">
	
	<div class="col-xs-12">
	{!! 
	App\Dms\Controls\Nomenclatoare\Commons\Denumire::make()
	->withAttribute('data-field', 'categorie')
	->value( $action != 'insert' ? $record->categorie : '')
	->disabled( $action == 'delete')
	->render() 
	!!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'extensie')
        ->class('form-group')
        ->caption( 'Extensie fisier' )
        ->placeholder('ex. jpg, png')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => 'ex. jpg, png',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete' )
        ->help('')
        ->render()
    !!}
	</div>

</div>