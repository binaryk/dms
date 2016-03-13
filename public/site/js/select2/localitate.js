; var Select2Localitate = function( options )
{

	$.extend( this, options);

	this.replacements = ['localitate', 'id'];
	
	this.formatRepo = function(repo)
	{
		if(repo.loading)
		{
			return repo.text;
		}
		// console.log(repo);
		var markup = _this.select2_item;
		for( i = 0; i < _this.replacements.length; i++)
		{
			markup = markup.replace( '[[' + _this.replacements[i] + ']]', repo[_this.replacements[i]] );
		}
		markup = markup.replace('[[judet]]', repo.judet.judet);
		markup = markup.replace('[[tip]]', repo.tip.tip_localitate);
		return markup;
	}

	this.formatRepoSelection = function(repo)
	{
		return repo.text || (repo.localitate + ' (' + repo.judet.judet + ', ' + repo.tip.tip_localitate + ')');
	}

	$("#id_localitate").select2({
		language       : 'ro',
		dropdownParent : $('#main-modal'),
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