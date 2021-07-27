<!--  Modal Return -->
<div id="modal-return" class="modal-returns modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('button.return')}} {{ trans('general.label.movie') }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['returns.return', encrypt($data->id)], 'method' => 'PUT']) !!}
                    <div class="box-body">
                        @if($lateness_charge)
                            <div class="alert alert-danger" role="alert">
                                {{ trans('general.message.return_confirm_with_charge') }}
                                <h4 class="modal-title">BND {{ $lateness_charge }},00 </h4>
                            </div>
                            <div class="return-caption">
                                {{ trans('general.message.return_with_charge_confirm') }}
                            </div>
                        @else
                            <div class="return-caption">
                                {{ trans('general.message.return_confirm') }}
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('button.cancel') }}</button>
                        <button type="submit" class="btn btn-danger">
                            @if ($lateness_charge)
                                {{ trans('button.pay_and_return') }}
                            @else
                                {{ trans('button.return') }}
                            @endif
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
