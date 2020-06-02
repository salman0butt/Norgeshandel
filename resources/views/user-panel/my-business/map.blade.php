@extends('layouts.landingSite')
<style>
#map_canvas {
    height: 95vh !important;
}
.active-pink-2 input.form-control[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid #f48fb1;
    box-shadow: 0 1px 0 0 #f48fb1;
}
.active-pink-2 input[type=text]:focus:not([readonly]) {
        border-bottom: 1px solid #f48fb1;
        box-shadow: 0 1px 0 0 #f48fb1;
    }
    .active-pink .fa, .active-pink-2 .fa {
        color: #f48fb1;
    }
    footer {
        display:none !important;
    }
</style>
https://developers.google.com/maps/documentation/javascript/examples/streetview-service
@section('page_content')
   {!! $map['js'] !!}
@section('style')
   
@endsection
    <div class="row mt-5">
        <div class="col-md-2">
        <form class="form-inline d-flex justify-content-center md-form form-sm active-pink-2 mt-2">
            <input class="dme-form-control" type="text" placeholder="Search" aria-label="Search" id="myPlaceTextBox">
            {{-- <i class="fas fa-search active" aria-hidden="true"></i> --}}
          </form>
        {{-- <input type="text" id="myPlaceTextBox" class="dme-form-control col-md-12"/> --}}
        </div>
        <div class="col-md-10 pl-0">
         {!! $map['html'] !!}
         </div>
    </div>

@endsection
