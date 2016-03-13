; var ComptechActions = function(options)
{

	this.form = null;
	this.grid = null;

	$.extend( this, options);

	this.Deactivate = function()
	{
		if( this.form )
		{
			if( typeof this.form == 'object' )
			{
				if( this.form instanceof ComptechUIModal )
				{
					this.form.Deactivate();
				}
			}
		}
	}

	this.Refresh = function()
	{
		if( this.grid )
		{
			if( typeof this.form == 'object' )
			{
				this.grid.ajax.reload(null, false);
			}
		}
	}

	this.textbox = function( control )
	{
		return control.val();
	}

	this.combobox = function( control )
	{
		return control.val();
	}

	this.checkbox = function( control )
	{
		return control.prop('checked') ? 1 : 0;
	}

	this.datepicker = function(control)
	{
		var value = control.val();
		if( value.length < 10)
		{
			return '';
		}
		return moment(control.val(), control.data('date-format') ).format('YYYY-MM-DD');
	}

	this.collectData = function( controls_container )
	{
		var that = this;
		var result = {};
		$(controls_container + ' .form-data-source').each( function(i){
			result[$(this).data('field')] = that[$(this).data('type')]( $(this) );
		});
		return result;
	}

	this.showRuleError = function(field, messages, controls_container)
	{
		var container = $(controls_container + ' #' + field).parent().addClass('has-error');
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
		return false;
	}

	this.showExceptionErrors = function(errors, controls_container)
	{
		var error_container = $(controls_container).find('#exception-error');
		if( error_container.length == 0 )
		{
			$(controls_container).append('<div class="row"><div class="col-xs-12"><div id="exception-error" class="alert alert-danger"></div></div></div>');
		}
		$(controls_container).find('#exception-error').html(errors.join('<br/>'));
	}

	this.process = function(response, controls_container)
	{
		if( response.success == false )
		{
			if( response['error-type'] == 'rules')
			{
				return this.showRulesErrors( response['errors'], controls_container );
			}
			if( response['error-type'] == 'exception')
			{
				return this.showExceptionErrors( response['errors'], controls_container );
			}
		}
		this.Refresh();
		this.Deactivate();
	}

	this.hideErrors = function(controls_container)
	{
		$(controls_container + ' p.help-block').html('').closest('.form-group').removeClass('has-error');
		$(controls_container).find('#exception-error').html('');
	}

	this.do = function ( object, controls_container, ladda )
	{
		this.hideErrors(controls_container);
		var that = this;
		this.ajax
			.setUrl(object.data('route'))
			.setData('action', object.data('action'))
			.setData('data',  this.collectData( controls_container ) )
			.setData('id', object.data('id') )
			.setOnFinish( function(response){ 
				that.process( response, controls_container );
				ladda.stop();
			})
			.Request()
		;
	}

}