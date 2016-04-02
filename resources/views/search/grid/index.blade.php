@extends('__layouts.pages.datatable.index')

@section('custom-javascript-files')
	@parent
	<!-- includ js-ul pentru datatable creat dinamic -->
	{!! 
	App\Comptechsoft\Ui\Html\Scripts::make([
		'custom/js/search/grid',
		'custom/js/grids/index',
		'custom/js/search/file',
		'custom/js/binaryk/ui/Modal'
	])->render() 
	!!}
@stop

@section('content')
    @parent
	@section('modal')
{!!
	App\Repositories\Ui\Modal\Modal::make(null,null)
	->id('frm-termeni-conditii')
	->caption('Trimite fișier prin email')
	->closable(true)
	->body(view('search.modal')->render())
	->footer('
	<button type="button" data-modal-action="sendLink" class="btn btn-default">Trimite</button>
	<button type="button" class="btn btn-default" data-dismiss="modal" onClose="ceva()">Renunţă</button>')
	->render()
!!}
		@stop
@stop

@section('jquery-document-ready')
	@parent
	var grid  = new gridSearch();
	var index = new indexGrid({
		grid       : grid,
		toolbar    : '{!! $toolbar !!}',
		_token     : '{{ csrf_token() }}',
		form_width : 4
	}).init();


	termeni_conditii_form = new App.Ui.Modal({'id' : '#frm-termeni-conditii'});
		$('#open-form-termeni-conditii').click(function(e){
		e.preventDefault();
		termeni_conditii_form.show();

	});

    new App.Handler(termeni_conditii_form);


@stop
