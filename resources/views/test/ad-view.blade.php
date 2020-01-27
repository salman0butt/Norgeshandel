@extends('layouts.landingSite')

@section('page_content')
<div class="container">
    <div class="mt-10">
        <h1>idss={{ $banner->title }}</h1>
    </div>
    <img src="{{ url('public/uploads/banners/'.$banner->image) }}" alt="" width="300px">

</div>

@endsection
