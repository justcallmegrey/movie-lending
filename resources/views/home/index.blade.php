@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@push('styles_after')
    @include('home.styles.styles')
@endpush

@section('content')
    <div class="carousel-container">
        @include('home.partials.carousel')
    </div>
@endsection
