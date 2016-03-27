{!!
	App\Repositories\Ui\Controls\Actions\Button::make()
	->id('btn-archive-' . $record->id)
	->class('btn btn-xs btn-warning btn-archive-action')
	->data([
		'route'  => $archive_route,
		'id'     => $record->id,
	])
	->icon('<i class="fa fa-archive" data-toggle="tooltip" data-placement="top" title="Arhivare" data-original-title="Arhivare"></i>')
	->caption('')
	->render()
!!}
{!!
	App\Repositories\Ui\Controls\Actions\Button::make()
	->id('btn-archive-' . $record->id)
	->class('btn btn-xs btn-success btn-email-action')
	->data([
		'route'  => $email_route,
		'id'     => $record->id,
	])
	->icon('<i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Trimite prin email" data-original-title="Trimite prin email"></i>')
	->caption('')
	->render()
!!}