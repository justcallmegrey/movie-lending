{!! Form::open(['method' => 'GET', 'id' => 'form-filter']) !!}
    <div class="row">
        <div class="col-3">
            <div class="">
                <label>{{ trans('general.label.genre') }}</label>
                <select
                    id="filter_genre"
                    name="filter_genre"
                    class="form-select form-control"
                >
                    <option value="0">{{ trans('general.label.select') }} {{ trans('general.label.genre') }}</option>
                    @if(!empty($genres))
                        @foreach($genres as $genre)
                            <option value="{{ $genre }}"> {{ ucfirst($genre) }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="flex btn-filter-container">
                <button id='btn-reset' type='reset' class="btn btn-secondary-custom btn-rounded">{{ trans('button.reset') }}</button>
                <button id='btn-filter' type='submit' class="btn btn-primary-custom btn-rounded ml-2">{!! trans('button.apply') !!}</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}
