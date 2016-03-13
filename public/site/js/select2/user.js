; var Select2User = function( options )
{

	$.extend( this, options);

	this.replacements = ['name', 'id', 'email'];
	
	this.formatRepo = function(repo)
	{
		if(repo.loading)
		{
			return repo.text;
		}
		var markup = _this.select2_user_item;
		for( i = 0; i < _this.replacements.length; i++)
		{
			markup = markup.replace( '[[' + _this.replacements[i] + ']]', repo[_this.replacements[i]] );
		}
		return markup;
	}

	this.formatRepoSelection = function(repo)
	{
		return repo.text || (repo.name + ' (' + repo.email + ')');
	}

	$("#id_user").select2({
		language       : 'ro',
		dropdownParent : $('#main-modal'),
        placeholder    : this.user_placeholder,
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