@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@push('styles_after')
    @include('lendings.styles.styles')
@endpush

@section('content')
    <div class="content-wrapper">
        @include('layouts.page-title')
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card mb-4 mt-4">
                    <div class="card-body card-filter">
                        @include('lendings.partials.filter')
                    </div>
                </div>
                <div class="card card-table">
                    <div class="card-header">
                        {!! trans('general.label.list_of') !!} {{ trans("general.label.lendings") }}
                    </div>
                    <div class="card-body position-relative">
                        <div class="table-responsive mt-4">
                            <table id='table-lendings' class="table">
                                <thead>
                                    <tr>
                                        <th>{!! trans('general.label.no') !!}</th>
                                        <th>{!! trans('general.label.member') !!}</th>
                                        <th>{!! trans('general.label.movie') !!}</th>
                                        <th>{!! trans('general.label.lending_date') !!}</th>
                                        <th>{!! trans('general.label.due_date') !!}</th>
                                        <th>{!! trans('general.label.created_at') !!}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('lendings.scripts.scripts')
@endpush
