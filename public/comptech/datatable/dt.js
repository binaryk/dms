; var ComptechDatatable = function( options )
{
	$.extend( this, options);

	this.modal = new ComptechUIModal({
		id    : 'main-modal',
		ajax  : new ComptechHelperAjax({_token : this.token})
	});
	this.action = new ComptechActions({
		ajax  : new ComptechHelperAjax({_token : this.token}),
		form  : this.modal
	});
	this.filter = new ComptechFilter({
		ajax  : new ComptechHelperAjax({_token : this.token}),
		form  : this.modal
	});

	this.action.grid = this.grid;
	this.filter.grid  = this.grid;


	this.sync = new ComptechDatatableSyncronize({
		id              : this.id,
		name            : this.name,
		grid            : this.grid,
		btn_group_order : '.btn-group-order',
		lang            : {asc  : this.lang.asc, desc : this.lang.desc}
	});

	this.grid.on('draw.dt', function(event, settings){ 
		console.log('Redraw occurred at: ' + new Date().toString() );
		_this.sync.syncRecordCount();
		_this.sync.syncOrder();


		/*
		console.log( window['{{ $name }}'].columns().nodes() );
		for(i = 0; i <  window['{{ $name }}'].columns().nodes().length; i++)
		{
			console.log('Column ' + i + '> ', window['{{ $name }}'].columns(i).search() );
		}
		*/
	})
	.on('processing.dt', function(event, settings, processing) {})
	.on('search.dt', function(event, settings){});

	$('#' + this.id + '_wrapper div.dataTables_toolbar').html( this.toolbar );
	
	$('#' + this.id + '_wrapper div.dataTables_refresh').html('<button class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-refresh"></i> <span id="record-count"></span></span></button>');


	var _this = this;

	$(document).on('click', '#' + this.id + '_wrapper div.dataTables_refresh button', function(e){
		var ladda = Ladda.create(this);
		ladda.start();
		_this.grid.ajax.reload( function(json){ladda.stop();}, true);
	});

	$(document).on('click', '.btn-launch-modal', function(e){
		e.preventDefault();
		var ladda = Ladda.create(this);
		ladda.start();
		_this.modal.Launch( $(this), ladda );
	});

	$(document).on('click', '.btn-action', function(e){
		e.preventDefault();
		var ladda = Ladda.create(this);
		ladda.start();
		_this.action.do( $(this), '.modal-body', ladda );
	});

	$(document).on('click', '.btn-load-filter-region', function(e){
		e.preventDefault();
		var ladda = Ladda.create(this);
		ladda.start();
		_this.modal.Launch( $(this), ladda );
	});

	$(document).on('click', '.btn-filter', function(e){
		e.preventDefault();
		_this.filter.do( $(this), '.modal-body', '#' + _this.id + '_wrapper div.dataTables_refresh button' );
	});
	
	// $(document).on('click', '.btn-unfilter', function(e){
	// 	e.preventDefault();
	// 	_this.filter.unfilter( $(this), '#' + _this.id );
	// });

	$(document).on('click', '#' + this.id + '_wrapper a.btn-unfilter', function(e){
		e.preventDefault();
		_this.grid.search('').columns().search('');
		$('#' + _this.id + '_wrapper div.dataTables_refresh button').trigger('click');
	});

	$(document).on('click', '#' + this.id + '_wrapper a.datatable-sort-by', function(e){
		e.preventDefault();
		_this.grid.order(  $(this).data('column'), $(this).data('direction')  );
		if( $('#' + _this.id + '_wrapper div.dataTables_refresh button').length > 0)
		{
			$('#' + _this.id + '_wrapper div.dataTables_refresh button').trigger('click');	
		}
		else
		{
			_this.grid.draw( $(this).data('reset-pages') == '1' );
		}
	});

	$(document).on('keyup change', '#' + this.id + '_wrapper .form-column-search', function(e){
		var column = _this.grid.columns($(this).data('column'));
		switch($(this).data('type'))
		{
			case 'textbox' :
				if( $(this).val() != column.search()[0] )
				{
					column.search( $(this).val() ).draw();
				}
				break;
			case 'combobox' :
				if( $(this).val() == '-')
				{
					column.search('').draw();
				}
				else
				{
					if( $(this).val() != column.search()[0] )
					{
						column.search( $(this).val() ).draw();
					}
				}
				break;
		}
	});
}