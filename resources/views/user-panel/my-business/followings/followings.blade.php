@extends('layouts.landingSite')
@section('page_content')
<main class="dme-wrapper">
    <div class="dme-container">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Firmaer jeg følger</li>
                </ol>
            </nav>
        </div>            <!---- end breadcrumb----->
        <h3 class="mb-5">Firmaer jeg følger</h3>
        @if(count($followings)>0)
        <h4 class="mb-3">Jobb</h4>
        <ul class="list list-unstyled">
            @foreach($followings as $following)
                @if($following->company && $following->company->company_type == "Jobb")
                    <li>
                        <div class="row my-3">
                            <div class="col-md-2">
                                <img src="{{$following->company->company_logo->first() ? \App\Helpers\common::getMediaPath($following->company->company_logo->first()) : asset('/public/images/1280x720.png')}}" alt="logo" width="100">
                            </div>
                            <div class="col-md-4">
                                <a href="{{url('/single-company/'.$following->company->id)}}">
                                    <h5 class="m-0 float-left font-weight-normal">{{$following->company->emp_name}}</h5>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button class="dme-btn-outlined-blue float-right follow-company-button" data-url="{{url('company-follow')}}" data-company_id="{{$following->company_id}}">Slutt å følge</button>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
        @else
            <div class="alert alert-info">For øyeblikket er følgende liste tom!</div>
        @endif
    </div>
</main>
@endsection