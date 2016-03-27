<div class="row">
	
	<div class="col-xs-12">
	{!! 
	App\Dms\Controls\Nomenclatoare\Commons\Denumire::make()
	->withAttribute('data-field', 'denumire')
	->value( $action != 'insert' ? $record->denumire : '')
	->disabled( $action == 'delete')
	->render() 
	!!}
	</div>

</div>