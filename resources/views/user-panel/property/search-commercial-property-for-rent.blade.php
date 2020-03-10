@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
        @include('user-panel.property.search-commercial-property-for-rent-inner')
    </main>
    <input type="hidden" id="back_url" value="{{ url()->current() }}">

    <script src="{{asset('public/js/property-filter.js')}}"></script>
@endsection
