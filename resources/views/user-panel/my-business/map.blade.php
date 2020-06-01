{{ dd($map) }}
@extends('layouts.landingSite')
<style>
#map_canvas {
    height: 100vh !important;
}
</style>
@section('page_content')
   {!! $map['js'] !!}
@section('style')
   
@endsection
    <div class="row mt-5">
        <div class="col-md-2">
        <input type="text" id="myPlaceTextBox" class="dme-form-control"/>
        </div>
        <div class="col-md-10">
         {!! $map['html'] !!}
         </div>
    </div>

@endsection