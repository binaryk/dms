{!!
	App\Repositories\Ui\Controls\Actions\Button::make()
	->id('btn-delete-' . $record->id)
	->class('btn btn-xs btn-danger btn-show-form')
	->data([
		'route'  => $delete_route,
		'id'     => $record->id,
	])
	->icon('<i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Ştergere" data-original-title="Ştergere"></i>')
	->caption('')
	->render()
!!}