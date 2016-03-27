<div class="row">
    @include('director-files.form.preview')
	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Textbox::make()
        ->name( $field = 'name')
        ->class('form-group')
        ->caption( 'Denumire' )
        ->placeholder('ex: Fisierul meu')
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
    @include('director-files.form.wysiwig')
	<div class="col-xs-12">
		{!!
        App\Repositories\Ui\Controls\Editbox::make()
        ->name( $field = 'description')
        ->class('form-group')
        ->caption( 'Comentarii fișier' )
        ->placeholder('ex. jpg, png')
        ->icon(NULL)
        ->value( $action != 'insert' ? $record->{$field} : '')
        ->attributes([
            'id'          => $field,
            'class'       => 'form-control form-data-source  note-editor note-editor-margin',
            'placeholder' => 'Acest fișier include...',
            'data-field'  => $field,
            'data-type'   => 'textbox'
        ])
        ->setFlag( 'readonly', $action == 'delete' )
        ->help('')
        ->render()
    !!}
	</div>
    <div class="ui-58 hidden" id="image-old-box">
        <div class="col-xs-12">
            {!! $data['file'] !!}
        </div>
    </div>

    <div class="col-xs-12 hidden" id="image-upload-box">
        <input type="file" name="file" class="form-control" id="file">
    </div>
</div>