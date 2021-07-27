<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
            <label>{!! trans('general.label.name') !!}</label>
            <input
                class="form-control"
                name="name"
                type="text"
                placeholder="{!! trans('general.placeholder.type-in') !!} {!! trans('general.label.name') !!}"
                value="{{ isset($data->name) ? $data->name : '' }}"
            />
            <div class="error-msg"></div>
        </div>
        <div class="form-group required {{ $errors->has('age') ? ' has-error' : '' }}">
            <label>{!! trans('general.label.age') !!}</label>
            <input
                class="form-control numeric"
                name="age"
                type="number"
                maxLength="2"
                placeholder="{!! trans('general.label.age') !!}"
                value="{{ isset($data->age) ? $data->age : '' }}"
            />
            <div class="error-msg"></div>
        </div>
        <div class="form-group required {{ $errors->has('address') ? ' has-error' : '' }}">
            <label>{!! trans('general.label.address') !!}</label>
            <textarea
                class="form-control"
                name="address"
                type="textarea"
                placeholder="{!! trans('general.placeholder.type-in') !!} {!! trans('general.label.address') !!}"
                value="{{ isset($data->address) ? $data->address : '' }}"
            ></textarea>
            <div class="error-msg"></div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="form-group required {{ $errors->has('telephone') ? ' has-error' : '' }}">
            <label>{!! trans('general.label.phone') !!}</label>
            <input
                class="form-control numeric"
                name="telephone"
                type="text"
                placeholder="{!! trans('general.placeholder.type-in') !!} {!! trans('general.label.phone') !!}"
                value="{{ isset($data->telephone) ? $data->telephone : '' }}"
            />
            <div class="error-msg"></div>
        </div>
        <div class="form-group required {{ $errors->has('identity_number') ? ' has-error' : '' }}">
            <label>{!! trans('general.label.identity_number') !!}</label>
            <input
                class="form-control alpha-numeric-space"
                name="identity_number"
                type="text"
                placeholder="{!! trans('general.placeholder.type-in') !!} {!! trans('general.label.identity_number') !!}"
                value="{{ isset($data->identity_number) ? $data->identity_number : '' }}"
            />
            <div class="error-msg"></div>
        </div>
        <div class="form-group required {{ $errors->has('is_active') ? ' has-error' : '' }}">
            <label>{!! trans('general.label.active') !!}</label>
            <div class="form-radio d-flex">
                <div class="custom-control custom-radio form-radio form-radio-inline">
                    <input
                        id="active"
                        name="is_active[]"
                        class="form-radio-input custom-control-input"
                        type="radio"
                        value='1'
                        @if (isset($data->is_active) && $data->is_active == '1')
                            {{ ' checked' }}
                        @else
                            {{ ' checked' }}
                        @endif
                    >
                    <label class="form-radio-label custom-control-label" for="active">{{ trans('general.label.active') }}</label>
                </div>
                <div class="custom-control custom-radio form-radio form-radio-inline ml-3">
                    <input
                        id="non_active"
                        name="is_active[]"
                        class="form-radio-input custom-control-input"
                        type="radio"
                        value='0'
                        @if (isset($data->is_active) && $data->is_active == '0')
                            {{ ' checked' }}
                        @endif
                    >
                    <label class="form-radio-label custom-control-label" for="non_active">{{ trans('general.label.non_active') }}</label>
                </div>
            </div>
        </div>
    </div>
</div>
