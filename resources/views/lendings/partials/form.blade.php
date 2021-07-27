<div class="col-md-12 col-lg-12">
    <div class="form-group {{ $errors->has('members') ? ' has-error' : '' }}">
        <label>{!! trans('general.label.member') !!}</label>
        <div class="">
            <select id="member_id" name="member_id" class="form-control">
                @if (!empty($members))
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}"> {{ $member->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="error-msg"></div>
    </div>
    <div class="form-group {{ $errors->has('movies') ? ' has-error' : '' }}">
        <label>{!! trans('general.label.select_movies') !!}</label>
        <div class="">
            <select id="movies" name="movies[]" class="form-control" multiple="multiple">
                @if (!empty($movies))
                    @foreach ($movies as $movie)
                        <option value="{{ $movie['id'] }}">{{ $movie['title'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="error-msg"></div>
    </div>
    <div class="form-group required {{ $errors->has('due_date') ? ' has-error' : '' }}">
        <label>{!! trans('general.label.due_date') !!}</label>
        <input
            class="form-control input-datepicker"
            name="due_date"
            value=""
        />
        <div class="error-msg"></div>
    </div>
</div>
