@extends('layouts.map')

@section('content')
<input type="hidden" id="latitude" value="{{ $_GET['lat'] ?? '' }}">
<input type="hidden" id="longitude" value="{{ $_GET['long'] ?? '' }}">
<div id="mapper">

</div>
@stop
@section('scripts')

@endsection

