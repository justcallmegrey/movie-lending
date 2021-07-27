<div class="col-md-12 col-lg-12">
    <div class="form-group required {{ $errors->has('title') ? ' has-error' : '' }}">
        <label>{!! trans('general.label.title') !!}</label>
        <input
            class="form-control"
            name="title"
            type="text"
            placeholder="{!! trans('general.placeholder.type-in') !!} {!! trans('general.label.title') !!}"
            value="{{ isset($data->title) ? $data->title : '' }}"
        />
        <div class="error-msg"></div>
    </div>
    <div class="form-group required {{ $errors->has('genre') ? ' has-error' : '' }}">
        <label>{!! trans('general.label.genre') !!}</label>
        <div class="">
            <select id="genre" name="genre" class="form-control alpha-numeric">
                <option value="0">{{ trans('general.label.select') }} {{ trans('general.label.genre') }}</option>
                @if (!empty($genres))
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}"
                            @if (isset($data['genre']) && $genre == $data['genre']) {{ ' selected' }} @endif
                        >
                            {{ ucfirst($genre) }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="error-msg"></div>
    </div>
    <div class="form-group required {{ $errors->has('released_date') ? ' has-error' : '' }}">
        <label>{!! trans('general.label.released_date') !!}</label>
        <input
            class="form-control input-datepicker"
            name="released_date"
            value=""
        />
        <div class="error-msg"></div>
    </div>
</div>
