{!! Form::open(['method' => 'GET', 'id' => 'form-filter']) !!}
    <div class="row">
        <div class="col-3">
            <div class="">
                <label>{{ trans('general.label.search') }} {{ trans('general.label.member') }}</label>
                <input
                    type="text"
                    placeholder="{!! trans('general.label.member') !!} {!! trans('general.label.name') !!}"
                    class="form-control table-search-member"
                >
            </div>
        </div>
        <div class="col-3">
            <div class="">
                <label>{{ trans('general.label.search') }} {{ trans('general.label.movie') }}</label>
                <input
                    type="text"
                    placeholder="{!! trans('general.label.movie') !!} {!! trans('general.label.title') !!}"
                    class="form-control table-search-movie"
                >
            </div>
        </div>
        <div class="col-3">
            <div class="flex btn-filter-container">
                <button id='btn-reset' type='reset' class="btn btn-secondary-custom btn-rounded">{{ trans('button.reset') }}</button>
                <button id='btn-filter' type='submit' class="btn btn-primary-custom btn-rounded ml-2">{!! trans('button.apply') !!}</button>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            {!! trans('general.message.rate_of_late_charges') !!}
        </div>
    </div>

{!! Form::close() !!}
