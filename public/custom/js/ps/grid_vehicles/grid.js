;var gridVehicles = function(options)
{
	$.extend( this, options);
	
	this.id = 'gridVehicles';

	this.dt = $('#' + this.id).DataTable({
		processing   : true,
		serverSide   : true,
		stateSave    : false,
		autoWidth    : false,
		pagingType   : 'bootstrap_full_number',
		lengthMenu   : [[5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 100], [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 100]],
		displayStart : 0,
		pageLength   : 10,
		dom          : '<"row"<"col-xs-12"lp<"comptech-soft-toolbar pull-right">>><"row"<"col-sm-12 galonline-datatable-container"t>>',
		ajax         : {
			url  : 'http://localhost/dms/be/public/vehicles-source',
			type : 'post',
			data : {
				_token : 'Qov9qsIx9xbgZVUjo9XpusVpBKiSeU3kpcMannmm'
			}
		},
		order        : [1, 'asc'],
		columns      : [{data : 'rec-no', orderable:false, className:'cell-right'},{data : 'available', orderable:true, className:''},{data : 'model', orderable:true, className:''},{data : 'make', orderable:false, className:''},{data : 'year', orderable:false, className:''},{data : 'location', orderable:false, className:''},{data : 'fuel_type', orderable:false, className:''},{data : 'vehicle_type', orderable:false, className:''},{data : 'rental_price', orderable:false, className:''},{data : 'actions', orderable:false, className:''},],
		language     : {
		    "decimal"		    : "",
		    "emptyTable"	    : "Nu sunt &icirc;nregistrări",
		    "info"			    : "_START_ ... _END_ [_TOTAL_/_MAX_]",
		    "infoEmpty"		    : "",
		    "infoFiltered"	    : "",
		    "infoPostFix"	    : "",
		    "thousands"		    : ",",
		    "lengthMenu"	    : "_MENU_", /*  înregistrări / pagină" */
		    "loadingRecords"    : "Loading...",
		    "processing"        : "Processing...",
		    "search"            : "",
		    "searchPlaceholder" : "Căutare...",
		    "zeroRecords"       : "Nu au fost găsite &icirc;nregistrări",
		    "paginate"          : {
		        "first"    : 'Prima pagină',
		        "previous" : 'Pagina precedentă',
		        "next"     : 'Pagina următoare',
		        "last"     : 'Ultima pagină'
		    },
		    "aria": {
		        "sortAscending"  : ": activate to sort column ascending",
		        "sortDescending" : ": activate to sort column descending"
		    }
		}
	});

	/*
	 * filtrare cu yadcf
	 * yadcf.init( this.dt, [{column_number: 0}]);
	 * am renuntat la yadcf
	 */
	
	var _this = this;

	/*
	 * filtrae la nivel de coloana
	 */
	$(document).on('keyup change', '#gridVehicles .datatable-filter-by-column', function(e){
		var column = _this.dt.columns( $(this).data('column-index') );
		if( $(this).val() != column.search()[0] )
		{
			var search_expresion = $(this).data('column-search').replace('[%]', $(this).val() );
			column.search(search_expresion).draw();
		}
	});

	/*
	 * Butonul reolad
	 */
	if($('#reload-gridVehicles').length)
	{
		$('#reload-gridVehicles').click( function(e){
			_this.dt.ajax.reload( function(json){ console.log(json); }, true);
		});
	}

	/*
	 * Numarul de inregistrari afisate
	 */
	if( $('#record-count-gridVehicles').length )
	{
		_this.dt.on('draw.dt', function(event, settings){ 
			$('#record-count-gridVehicles').html( _this.dt.page.info().recordsTotal );
		});
	}

}
/*
End datatable initialization
*/
