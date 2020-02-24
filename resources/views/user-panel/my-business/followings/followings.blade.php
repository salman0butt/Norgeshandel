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
        <h4 class="mb-3">Job</h4>
        <ul class="list list-unstyled">
            @foreach($followings as $following)
                @if($following->company->company_type == "job")
                    <li>
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="m-0 float-left font-weight-normal">{{$following->company->emp_name}}</h5>
                            </div>
                            <div class="col-md-4">
                                <a class="dme-btn-outlined-blue float-right" href="#">
                                    <div class="ml-2">Slutt å følge</div>
                                </a>
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
