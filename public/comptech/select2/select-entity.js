; var ComptechSelect2SelectEntity = function( options )
{
	this.before_id = '.modal-body';
	$.extend( this, options);

	this.formatRepo = function(repo)
	{
		if(repo.loading)
		{
			return repo.text;
		}
		var markup = _this.item;
		for( i = 0; i < _this.replacements.length; i++)
		{
			markup = markup.replace( '[[' + _this.replacements[i] + ']]', repo[_this.replacements[i]] );
		}
		return markup;
	}

	this.formatRepoSelection = function(repo)
	{
		
		return repo.text || _this.selection(repo);
	}

	this.Enable = function()
	{
		$(this.before_id + ' #' + this.id).prop("disabled", false);
	}

	this.Disable = function()
	{
		$(this.before_id + ' #' + this.id).prop("disabled", true);
	}

	this.Value = function(value)
	{
		this.combobox.val(value).trigger('change');
	}

	this.combobox = $(this.before_id + ' #' + this.id).select2({
		language       : 'ro',
		dropdownParent : this.dropdownParent,
        placeholder    : this.placeholder,
        allowClear     : true,
        closeOnSelect  : true,
        ajax           : {
            url      : this.endpoint,
            type     : 'post',
            dataType : 'json',
            delay    : 250,
            data     : function(params) {return {q : params.term, page : params.page, _token : _this.token};},
            processResults: function(data, page) {
                return {results: data.items};
            },
            cache         : true
        },
        escapeMarkup       : function (markup) { return markup; }, 
        minimumInputLength : 3,
        templateResult     : this.formatRepo, 
        templateSelection  : this.formatRepoSelection 
    });

    var _this = this;
}