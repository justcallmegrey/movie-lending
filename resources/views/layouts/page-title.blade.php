@push('styles_after')
    <style>
        .page-title {
            background: #212529;
            margin: -30px;
            margin-bottom: 0px;
            padding: 10px 25px;
            box-shadow: 2px 0px 3px rgb(0 0 0 / 20%);
        }

        h1 {
            color: white;
            font-size: 30px;
            font-weight: 500;
        }

        h3 {
            color: white;
            font-size: 12px;
            font-weight: 200;
        }

        h3 span {

        }
    </style>
@endpush

@if(isset($slug))
    <div class="page-title">
        <h1>{{ trans('menu.'.$slug.'.name') }}</h1>
        @if(trans('menu.'.$slug.'.desc') !== null)
            <h3>
                {{ trans('menu.'.$slug.'.desc') }}
                <span></span>
            </h3>
        @endif
    </div>
@endif
