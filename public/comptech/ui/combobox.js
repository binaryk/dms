function COMBOBOX( options )
{

	// this.id      = parameters.id;
	// this.url     = parameters.url;
	// this.control = parameters.control;
	// this.model   = parameters.model;
	// this.field   = parameters.field;

	$.extend( this, options);

	this.data = function()
	{
		return {
			_token  : this._token,
			'id'    : this.id,
		};
	};

	this.setOptions = function(options, value)
	{
		$(this.control).find('option').remove();
		var htmloptions = '';
		for(i in options)
		{
			htmloptions += '<option' + ' value="' + options[i].id + '">' + options[i].text + '</option>'
		}
		$(this.control).html(htmloptions);
	};

	this.populate = function( value )
	{
		var self = this;
		$.ajax({
			url      : this.url,
        	type     : 'post',
        	dataType : 'json',
        	data     : this.data(),
        	success  : function(result)
        	{
        		console.log(result);
        		self.setOptions(result.options, value);
        		$(self.control).val(value);
        	}
		})
	}
}