<!--  Modal Create -->
<div id="modal-create" class="modal-lendings modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('general.label.lend_movies_to_member') }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['lendings.store'], 'method' => 'POST', 'files' => true]) !!}
                    <div class="box-body">
                        @include('lendings.partials.form')
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary-custom">{{ trans('button.save') }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('button.cancel') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
