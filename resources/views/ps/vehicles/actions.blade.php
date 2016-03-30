@if(isset($update_route) && $update_route)
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
@if( isset($delete_route) && $delete_route)
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
@endif