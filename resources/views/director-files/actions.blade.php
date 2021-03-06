@if($update_route)
    {!!
        App\Repositories\Ui\Controls\Actions\Button::make()
        ->id('btn-update-' . $record->id)
        ->class('btn btn-xs btn-info btn-show-form')
        ->data([
            'route'  => $update_route,
            'id'     => $record->id,
        ])
        ->icon('<i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Modificare" data-original-title="Modificare"></i>')
        ->caption('')
        ->render()
    !!}
@endif
<a href="{!! $history_route !!}" class="btn btn-xs btn-default btn-show-history">
    <i class="fa fa-file" data-toggle="tooltip" data-placement="top" title="Istoria documentului" data-original-title="Istoria documentului"></i>
</a>


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