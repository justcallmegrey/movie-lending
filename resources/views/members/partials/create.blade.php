<!--  Modal Create -->
<div id="modal-create" class="modal-members modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('button.add')}} {{ trans('menu.members.name') }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['members.store'], 'method' => 'POST', 'files' => true]) !!}
                    <div class="box-body">
                        @include('members.partials.form')
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
