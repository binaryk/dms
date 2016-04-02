
<fieldset class="top-buffer">
    <div class="ui-58 hidden" id="image-old-box">
        <div class="col-xs-12">
            {!! $data['file'] !!}
        </div>
    </div>
    <div class="form-group hidden" id="image-upload-box">
        <label class="col-sm-2 control-label">Încarcă fișierul</label>
        <div class="col-sm-10">
            <div class="col-xs-12 bootstrap-filestyle input-group " >
                <input type="file" name="file" class="form-control filestyle" id="file">
            </div>
        </div>
    </div>
</fieldset>
<div class="row top-buffer">

        <fieldset>
            {!!
            App\Repositories\Ui\Controls\Textbox::make()
            ->name( $field = 'name')
            ->class('form-group mb')
            ->wrapper('col-sm-10')
            ->lclass('col-sm-2')
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
        </fieldset>

        <fieldset>
            <div class="form-group">
                <button type="button" title="" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." class="btn btn-default" data-original-title="Popover title" aria-describedby="popover791319">Popover on right</button>
                <label class="col-sm-2 control-label">Fișier privat ?</label>
                <div class="col-sm-10">
                    <label class="switch switch-lg">
                        <input type="checkbox" checked="checked">
                        <span></span>
                    </label>
                </div>
            </div>
        </fieldset>

        <fieldset>
            {!!
            App\Repositories\Ui\Controls\Textbox::make()
            ->name( $field = 'version')
            ->class('form-group mb')
            ->wrapper('col-sm-10')
            ->lclass('col-sm-2')
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
        </fieldset>

        <div class="col-xs-12" style="border-bottom: 1px dashed #eee;">
            {!!
            App\Repositories\Ui\Controls\Editbox::make()
            ->name( $field = 'description')
            ->class('form-group mb')
            ->wrapper('col-sm-10')
            ->lclass('col-sm-2')
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
        <div class="clearfix"></div>
        <div class="top-buffer">
            @include('director-files.form.wysiwig')
        </div>
        <div class="clearfix"></div>
    </div>
