@extends('~layout.~template')

@section('content')

	<div class="page-title">
	<span class="title">
		@if($icon)
			{!! $icon !!}
		@endif
		@if( isset($caption) && $caption)
			{!! $caption !!}
			(<span id="record-count-{{$grid->getId()}}"></span>)
		@endif
	</span>
		<div class="description">{!! $description !!}</div>
	</div>

	<div class="row">

		<div id="action-form-col-{{$grid->getId()}}" class="panel panel-info col-xs-12 action-form-col">
			<div class="panel-heading portlet-handler ui-sortable-handle">
				<div id="action-form-title" class="title">

				</div>
				<div class="pull-right card-action">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-link btn-close-form"><i class="fa fa-times"></i></button>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div id="action-form-body"></div>

				<div class="sub-title"></div>
			</div>
			<div class="panel-footer">
				<button type="button" class="btn btn-primary action-form-btn-do"></button>
				<button type="button" id="action-form-btn-cancel" class="btn btn-warning">Renunţă</button>
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
		'custom/css/main',
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