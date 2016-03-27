@extends('__layouts.pages.datatable.index')
@section('heading')
        @parent
        <div class="btn-group pull-right">
            <a type="button" class="btn btn-success btn-sm" href="{!! $back !!}">Înapoi</a>
        </div>
@stop

@section('custom-javascript-files')
	@parent
	<!-- includ js-ul pentru datatable creat dinamic -->
	{!! 
	App\Comptechsoft\Ui\Html\Scripts::make([
		'custom/js/archives/grid',
		'custom/js/director-files/index',
	])->render()
	!!}
@stop
@section('jquery-document-ready')
	@parent
	var grid  = new gridArchives();
	var index = new indexGrid({
		grid       : grid,
		toolbar    : '{!! $toolbar !!}',
		_token     : '{{ csrf_token() }}',
		form_width : 12
	}).init();
@stop
