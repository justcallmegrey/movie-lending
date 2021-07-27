<!--  Modal Delete -->
<div id="modal-delete" class="modal-movies modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('button.delete')}} {{ trans('general.label.movie') }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['movies.delete', encrypt($data->id)], 'method' => 'DELETE', 'files' => true]) !!}
                    <div class="box-body">
                        {{ trans('general.message.delete-confirm') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('button.cancel') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('button.delete') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
