; var ComptechFilter = function(options)
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

	this.collectData = function( controls_container )
	{
		var that = this;
		var result = {};
		$(controls_container + ' .form-filter-by').each( function(i){
			result[$(this).data('column')] = that[$(this).data('type')]( $(this) );
		});
		return result;
	}

	this.do = function ( object, controls_container, refresh_button )
	{
		var data   = this.collectData( controls_container );
		for(column in data)
		{
			if( data[column].length > 0)
			{
				this.grid = this.grid.columns( column ).search( data[column]);
			}
		}
		if( $(refresh_button).length == 0 )
		{
			this.Refresh();
		}
		else
		{
			$(refresh_button).trigger('click');
		}
		this.Deactivate();
	}

	this.unfilter = function(object)
	{
		this.grid.search('');

		this.Refresh();
	}

}