;var indexGrid = function(options)
{
    $.extend( this, options);

    this.grid_width = 12 - this.form_width;



    var _this = this;

    this.init = function(){
        _this.grid.dt.ajax.reload( function(json){ console.log(json); }, true);
        return _this;
    }

    /*
     * dupa ce se afiseaza formularul
     * apelata in this.showForm()
     */
    this.afterShowform = function(impact){}

    this.clearForm = function()
    {
        $('#action-form-col-' + this.grid.id).hide();
        $('#action-form-col-' + this.grid.id + ' #action-form-title').html('');
        $('#action-form-col-' + this.grid.id + ' #action-form-body').html('');
        $('#action-form-col-' + this.grid.id + ' .action-form-btn-do').html('');
    }

    this.showForm = function(result)
    {
        $('#action-form-col-' + this.grid.id + ' #action-form-title').html(result.caption);
        $('#action-form-col-' + this.grid.id + ' #action-form-body').html(result.form);
        $('#action-form-col-' + this.grid.id + ' .action-form-btn-do').html(result.action);
        $('#action-form-col-' + this.grid.id).show();

        this.afterShowform(result['impact']);
    }


    this.gettextboxValue = function(formField)
    {
        return formField.val();
    }

    this.getcomboboxValue = function(formField)
    {
        return formField.val();
    }

    this.getcheckboxValue = function(formField)
    {
        if( formField.prop('checked') )
        {
            return 1;
        }
        return 0;
    }

    this.getdatepickerValue = function(formField)
    {
        var value = formField.val();
        if( value.length < 10)
        {
            return '';
        }
        return moment( value, formField.data('date-format') ).format('YYYY-MM-DD');
    }

    this.dataField = function( formField )
    {
        return this['get' + formField.data('type') + 'Value'](formField);
    }

    this.collectData = function()
    {
        var result = {};
        $('#action-form-col-' + this.grid.id + ' .form-data-source').each( function(i){
            console.log($(this).data('type'));
            result[ $(this).data('field')] = _this.dataField( $(this)) ;
        });
        return result;
    }

    /*
     * incarcare toolbar
     */
    this.grid.dt.on('draw.dt', function(event, settings){
        $('#' + _this.grid.id + '_wrapper .comptech-soft-toolbar').html( _this.toolbar );
    });

    /*
     * click pe inchidere formular "actions"
     */
    $('#action-form-col-' + _this.grid.id).on('click', '.btn-close-form, #action-form-btn-cancel', function(e){

        /*
         * ascund formularul
         */
        $('#action-form-col-' + _this.grid.id).removeClass('col-md-' + _this.form_width)
        _this.clearForm();

        /*
         * fac gridul mare la loc
         */
        $('#grid-col-' + _this.grid.id).removeClass('col-md-' + _this.grid_width).removeClass('col-xs-12').addClass('col-md-12');

    });

    this.showRuleError = function(field, messages, controls_container)
    {
        var container = controls_container.find('.form-data-source[data-field="' + field + '"]').closest('.form-group').addClass('has-error');
        var help = container.find('p.help-block');
        if( help.length == 0)
        {
            container.append('<p class="help-block has-error"></p>');
        }
        container.find('p.help-block').html(messages.join('<br/>'));
    }

    this.showRulesErrors = function(errors, controls_container)
    {
        for( error in errors)
        {
            this.showRuleError(error, errors[error], controls_container);
        }
    }

    this.showExceptionErrors = function(errors, controls_container)
    {
        console.log(errors);
        var error_container = controls_container.find('#exception-error');
        if( error_container.length == 0 )
        {
            controls_container.append('<div class="row"><div class="col-xs-12"><div id="exception-error" class="alert alert-danger"></div></div></div>');
        }
        controls_container.find('#exception-error').html(errors.join('<br/>'));
    }

    this.hideExceptionErrors = function(controls_container)
    {
        controls_container.find('#exception-error').remove();
    }

    /*
     * click pe Adaugare/Salvare/Sterge
     */
    $('#action-form-col-' + _this.grid.id).on('click', '.action-form-btn-do', function(e){
        console.log($("#"+_this.grid.id+"")[0]);
        
        _this.hideExceptionErrors($('#action-form-col-' + _this.grid.id));
        $.ajax({
            url      : _this.route,
            type     : 'POST',
            dataType : 'json',
            async:false,
            processData: false,
            contentType: false,
            data     :   new FormData($("#"+_this.grid.id+"")[0]),
            success  : function( result )
            {
                if( result.success)
                {
                    _this.grid.dt.ajax.reload( function(json){ console.log(json); }, true);
                    $('#action-form-col-' + _this.grid.id + ' .btn-close-form').trigger('click');
                    return true;
                }
                if( result['error-type'] == 'rules')
                {
                    return _this.showRulesErrors( result['errors'], $('#action-form-col-' + _this.grid.id) );
                }
                if( result['error-type'] == 'exception')
                {
                    return _this.showExceptionErrors( result['errors'], $('#action-form-col-' + _this.grid.id) );
                }


            }
        });

    });

    /*
     * bind show form
     */
    $('#' + _this.grid.id + '_wrapper').on('click', '.btn-show-form', function(e){

        _this.hideExceptionErrors($('#action-form-col-' + _this.grid.id));
        $.ajax({
            url      : $(this).data('route'),
            type     : 'POST',
            dataType : 'json',
            data     : {
                _token : _this._token,
            },
            success  : function( result )
            {
                _this.route = result.route;


                /*
                 * fac gridul mai mic
                 */
                $('#grid-col-' + _this.grid.id)
                    .removeClass('col-md-12')
                    .addClass('col-md-' + _this.grid_width)
                    .addClass('col-xs-12');

                /*
                 * latimea formularului
                 */
                $('#action-form-col-' + _this.grid.id).addClass('col-md-' + _this.form_width);
                /*
                 * afisez formularul
                 */
                _this.showForm(result);
            }
        });


    });


}