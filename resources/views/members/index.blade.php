@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@push('styles')
    @include('members.styles.styles')
@endpush

@section('content')
    <div class="content-wrapper">
        @include('layouts.page-title')
        <div class="row mt-5">
            <div class="col-lg-12 grid-margin">
                <div class="card card-table">
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
                                    @can ('members_create')
                                        <button
                                            class="btn btn-primary-custom btn-sm btn-action ml-3"
                                            type="button"
                                            data-href="{!! route('members.create') !!}"
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
                            <table id='table-members' class="table">
                                <thead>
                                    <tr>
                                        <th>{!! trans('general.label.no') !!}</th>
                                        <th>{!! trans('general.label.name') !!}</th>
                                        <th>{!! trans('general.label.age') !!}</th>
                                        <th>{!! trans('general.label.address') !!}</th>
                                        <th>{!! trans('general.label.telephone') !!}</th>
                                        <th>{!! trans('general.label.identity_number') !!}</th>
                                        <th>{!! trans('general.label.date_of_joined') !!}</th>
                                        <th>{!! trans('general.label.status') !!}</th>
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
    @include('members.scripts.scripts')
@endpush
