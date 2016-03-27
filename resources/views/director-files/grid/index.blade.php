@extends('__layouts.pages.datatable.index')

@section('css')
		@parent
		<link rel="stylesheet" href="{!! asset('vendor\file-input\css\fileinput.min.css') !!}">
		<link rel="stylesheet" href="{!! asset('custom/css/file-icons.css') !!}">
@stop
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
		'custom/js/director-files/grid',
		'custom/js/director-files/index',
		'custom/js/director-files/file',
		'angel/vendor/bootstrap-wysiwyg/bootstrap-wysiwyg',
		'angel/vendor/bootstrap-wysiwyg/external/jquery.hotkeys'
	])->render()
	!!}
@stop
@section('jquery-document-ready')
	@parent
	var grid  = new gridDirectorFiles();
	var index = new indexGrid({
		grid       : grid,
		toolbar    : '{!! $toolbar !!}',
		_token     : '{{ csrf_token() }}',
		form_width : 12
	}).init();
	console.log(index);
	index.afterShowform = function(impact){
		(new App.File(impact)).init();
        $('.wysiwyg').wysiwyg();
	}
	new App.Handler();
@stop
