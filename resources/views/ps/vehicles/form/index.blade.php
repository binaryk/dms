<div class="row">
	@if(! $data['admin'])
		<div class="col-xs-12">
			{!!
			App\Comptechsoft\Ui\Controls\Selectbox::make()
			->label('Is reserved')
			->icon('')
			->name('is_blocked')
			->value($action != 'insert' ? $record->is_blocked : '')
			->addClass('form-control form-data-source')
			->withAttribute('data-field', 'is_blocked')
			->withAttribute('data-type', 'combobox')
			->disabled($action == 'delete')
			->options(['' => ' -- Select -- '] + ['1' => 'Yes', '0' => 'No'])
			->render()
			!!}
		</div>
	@endif
	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'model')
        ->class('form-group')
        ->caption( 'Model' )
        ->placeholder('ex. VW Touran')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => 'ex. VW Touran',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete'  || ! $data['admin'])
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'location')
        ->class('form-group')
        ->caption( 'Location' )
        ->placeholder('')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => '',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete'  || ! $data['admin'])
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'make')
        ->class('form-group')
        ->caption( 'Make' )
        ->placeholder('')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => '',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete'   || ! $data['admin'])
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'rental_price')
        ->class('form-group')
        ->caption( 'Rental price' )
        ->placeholder('')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => '',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete'   || ! $data['admin'])
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'mileage')
        ->class('form-group')
        ->caption( 'Mileage' )
        ->placeholder('')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => '',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete'   || ! $data['admin'])
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'fuel_type')
        ->class('form-group')
        ->caption( 'Fuel type' )
        ->placeholder('')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => '',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete'   || ! $data['admin'])
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'vehicle_type')
        ->class('form-group')
        ->caption( 'Vehicle type' )
        ->placeholder('')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => '',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete'   || ! $data['admin'])
        ->help('')
        ->render()
    !!}
	</div>

	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Editbox::make()
        ->name( $field = 'features')
        ->class('form-group')
        ->caption( 'Features' )
        ->placeholder('')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source',
            'placeholder' => '',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete'   || ! $data['admin'])
        ->help('')
        ->render()
    !!}
	</div>

</div>