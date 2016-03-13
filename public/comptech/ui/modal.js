; var ComptechUIModal = function( options )
{
	$.extend( this, options);

	this.set = function(object, value)
	{
		object.html(value);
		return this;
	}

	this.setTitle = function(value)
	{
		return this.set($('#' + this.id + ' .modal-title'), value);
	}

	this.setBody = function(value)
	{
		return this.set($('#' + this.id + ' .modal-body'), value);
	}

	this.setFooter = function(value)
	{
		return this.set($('#' + this.id + ' .modal-footer'), value);
	}

	this.berforeActivate = function(response)
	{
	}

	this.afterActivate = function(response)
	{
	}

	this.Activate = function(response)
	{
		this.berforeActivate(response);
		$('#' + this.id).modal('show');
		this.afterActivate(response);
	}

	this.Deactivate = function()
	{
		$('#' + this.id).modal('hide');
	}

	this.launchFinish = function(response)
	{
		this
			.setTitle(response.title)
			.setBody(response.body)
			.setFooter(response.footer)
			.Activate(response)
	}

	this.Launch = function( object, ladda )
	{
		var that = this;
		this.ajax
			.setUrl(object.data('route'))
			.setData('action', object.data('action'))
			.setData('id', object.data('id'))
			.setOnFinish( function(response){ 
				that.launchFinish(response);
				ladda.stop(); 
			})
			.Request()
		;
	}
}