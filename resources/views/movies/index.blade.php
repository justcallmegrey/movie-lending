@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@push('styles')
    @include('movies.styles.styles')
@endpush

@section('content')
    <div class="content-wrapper">
        @include('layouts.page-title')
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card mb-4 mt-4">
                    <div class="card-body card-filter">
                        @include('movies.partials.filter')
                    </div>
                </div>
                <div class="card card-table">
                    <div class="card-header">
                        {!! trans('general.label.list_of') !!} {{ trans("general.label.movies") }}
                    </div>
                    <div class="card-body position-relative">
                        <div class="datatable-search-custom">
                            <div class="input-group mb-3">
                                <input type="text" placeholder="{!! trans('general.label.search') !!}" class="form-control table-search" >
                                <div class="input-group-append">
                                    <span class="input-group-text search-table">
                                        <img src="{{ asset('images/search.svg') }}"/>
                                    </span>
                                </div>
                                <div>
                                    @can ('movies_create')
                                        <button
                                            class="btn btn-primary-custom btn-sm btn-action ml-3"
                                            type="button"
                                            data-href="{!! route('movies.create') !!}"
                                            data-type='create'
                                        >
                                            <img class="small-icon" src="{{ asset('/images/add.svg')}}" />
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive mt-4">
                            <table id='table-movies' class="table">
                                <thead>
                                    <tr>
                                        <th>{!! trans('general.label.no') !!}</th>
                                        <th>{!! trans('general.label.title') !!}</th>
                                        <th>{!! trans('general.label.genre') !!}</th>
                                        <th>{!! trans('general.label.available') !!}</th>
                                        <th>{!! trans('general.label.released_date') !!}</th>
                                        <th>{!! trans('general.label.created_at') !!}</th>
                                        <th>{!! trans('general.label.action') !!}</th>
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
    @include('movies.scripts.scripts')
@endpush
