<div class="row">
	
	<div class="col-xs-12">
	{!! 
	App\Dms\Controls\Nomenclatoare\Commons\Denumire::make()
	->withAttribute('data-field', 'name')
	->value( $action != 'insert' ? $record->name : '')
	->disabled( $action == 'delete')
	->render() 
	!!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'version')
        ->class('form-group')
        ->caption( 'Versiune fișier (1,2..)' )
        ->placeholder('ex: 1')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '1')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => 'Acest fișier include...',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete' )
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Editbox::make()
        ->name( $field = 'description')
        ->class('form-group')
        ->caption( 'Descriere fișier' )
        ->placeholder('ex. jpg, png')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => 'Acest fișier include...',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete' )
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Filebox::make()
        ->name( $field = 'file')
        ->class('form-group')
        ->caption( 'Fișier' )
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => 'Acest fișier include...',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete' )
        ->help('')
        ->render()
    !!}
	</div>
	<div class="col-md-12">
		<div class="half-center send-pass">
			<input id="photos" name="photos" type="file"/>
		</div>
	</div>

</div>