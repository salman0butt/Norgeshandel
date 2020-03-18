@extends('layouts.landingSite')
<style>
/*.trailing-border img {*/
    /*min-height: 207px !important;*/
/*}*/
/*.clist .location {*/
    /*position: unset !important;*/
/*}*/
/*.detail.u-t5.mt-3.float-left.text-muted {*/
    /*word-break: break-word;*/
/*}*/
</style>
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
        @include('user-panel.property.search-commercial-property-for-sale-inner')
    </main>
    <input type="hidden" id="mega_menu_search_url" value="{{url('property/commercial-property-for-sale/search')}}">
    <input type="hidden" id="back_url" value="{{ url()->current() }}">

    <script src="{{asset('public/js/property-filter.js')}}"></script>

@endsection
