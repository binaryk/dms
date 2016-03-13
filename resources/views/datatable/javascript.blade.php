window['{{ $name }}'] = $('#{{ $id }}').DataTable({
	processing   : {{ $processing }},
	serverSide   : {{ $serverSide }},
	stateSave    : {{ $stateSave }},
	autoWidth    : {{ $autoWidth }},
	pagingType   : '{{ $pagingType }}',
	lengthMenu   : {{ $lengthMenu }},
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
	        "first"    : '<i class="fa fa-angle-double-left"></i>',
	        "previous" : '<i class="fa fa-angle-left"></i>',
	        "next"     : '<i class="fa fa-angle-right"></i>',
	        "last"     : '<i class="fa fa-angle-double-right"></i>'
	    },
	    "aria": {
	        "sortAscending"  : ": activate to sort column ascending",
	        "sortDescending" : ": activate to sort column descending"
	    }
	}
});