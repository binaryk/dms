@extends('layouts.master')

@section('content')

<div class="page-title">
	<span class="title">
		@if($icon)
			{!! $icon !!}
		@endif
		@if($caption)
			{!! $caption !!}
		@endif
		(<span id="record-count-{{$grid->getId()}}"></span>)
	</span>
	<div class="description">{!! $description !!}</div>
</div>

<div class="row">
	
	<div class="col-xs-12 action-form-col" id="action-form-col-{{$grid->getId()}}">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<div id="action-form-title" class="title"></div>
				</div>
				<div class="pull-right card-action">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-link btn-close-form"><i class="fa fa-times"></i></button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div id="action-form-body"></div>
				<div class="sub-title"></div>
				<p>
					<button type="button" class="btn btn-primary action-form-btn-do"></button>
					<button type="button" id="action-form-btn-cancel" class="btn btn-link">Renunţă</button>
				</p>
			</div>
		</div>
	</div>

	<div class="col-md-12 grid-col" id="grid-col-{{$grid->getId()}}">
		<div class="card">
			<div class="card-title">
				<!-- componenta pentru Reolad -->
				<div class="tools">
					<a href="javascript:;" id="reload-{{$grid->getId()}}" class="reload" data-original-title="" title="Reîncarcă"></a>
				</div>
			</div>
            <div class="card-body">
				<!-- aici vine tabelul (gridul) datatable -->
				{!! $grid->render() !!}
				<!-- END table -->
            </div>
		</div>
	</div>
</div>
@stop

@section('my-styles')
	<!-- css-ul pentru datatable -->
	{!! $grid->styles() !!}
	{!! 
	App\Comptechsoft\Ui\Html\Styles::make([
		'site/css/galonline', 
	])->render() 
	!!}
@stop

@section('custom-javascript-files')
	<!-- js-ul pentru datatable -->
	{!! $grid->scripts() !!}
@stop

@section('jquery-document-ready')
	{!! $grid->create() !!}
@stop