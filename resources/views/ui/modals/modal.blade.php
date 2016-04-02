<div id="{!! $id !!}" tabindex="-1" role="dialog" aria-labelledby="{!! @$lid !!}}" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if( $closable )
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endif
                <h4 id="{!! @$lid !!}}" class="modal-title">{!! $caption !!}</h4>
            </div>
            <div class="modal-body">
                {!! $body !!}
            </div>
            <div class="modal-footer">
                @if(isset($footer))
                    {!! $footer !!}
                @else
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                @endif
            </div>
        </div>
    </div>
</div>