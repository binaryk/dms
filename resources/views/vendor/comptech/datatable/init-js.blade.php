;var {{$id}} = function(options)
{
	$.extend( this, options);
	
	this.id = '{{$id}}';

	this.dt = $('#' + this.id).DataTable({
		processing   : true,
		serverSide   : true,
		stateSave    : false,
		autoWidth    : false,
		pagingType   : 'bootstrap_full_number',
		lengthMenu   : [[5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 100], [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 100]],
		displayStart : {{ $displayStart }},
		pageLength   : {{ $pageLength }},
		dom          : '{!! $dom !!}',
		ajax         : {
			url  : '{{ $ajax->url() }}',
			type : 'post',
			data : {
				_token : '{{ csrf_token() }}'
			}
		},
		order        : {!! $order->order() !!},
		columns      : [{!! $columns !!}],
		language     : {
		    "decimal"		    : "",
		    "emptyTable"	    : "{{ trans('datatable.empty-table') }}",
		    "info"			    : "_START_ ... _END_ [_TOTAL_/_MAX_]",
		    "infoEmpty"		    : "",
		    "infoFiltered"	    : "",
		    "infoPostFix"	    : "",
		    "thousands"		    : ",",
		    "lengthMenu"	    : "_MENU_", /*  înregistrări / pagină" */
		    "loadingRecords"    : "Loading...",
		    "processing"        : "Processing...",
		    "search"            : "",
		    "searchPlaceholder" : "{{ trans('datatable.search-placeholder') }}",
		    "zeroRecords"       : "{{ trans('datatable.zero-records') }}",
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
	$(document).on('keyup change', '#{{$id}} .datatable-filter-by-column', function(e){
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
	if($('#reload-{{$id}}').length)
	{
		$('#reload-{{$id}}').click( function(e){
			_this.dt.ajax.reload( function(json){ console.log(json); }, true);
		});
	}

	/*
	 * Numarul de inregistrari afisate
	 */
	if( $('#record-count-{{$id}}').length )
	{
		_this.dt.on('draw.dt', function(event, settings){ 
			$('#record-count-{{$id}}').html( _this.dt.page.info().recordsTotal );
		});
	}

}
/*
End datatable initialization
*/
