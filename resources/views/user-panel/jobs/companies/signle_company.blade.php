@extends('layouts.landingSite')

@section('page_content')

<main class="single-company">
    <div class="dme-container">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Job </font>
                            </font>
                        </a></li>
                    <li class="breadcrumb-item"><a href="#">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Company profiles </font>
                            </font>
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">AK Machines AS</font>
                        </font>
                    </li>
                </ol>
            </nav>
        </div>

        <!--------bread-crumb end----->

        <div class="mt-5 mb-3">
            <div class="row">
                <div class="col-md-6"><img src="{{\App\Helpers\common::getMediaPath($company->company_logo->first())}}" alt="logo" width="100"></div>
                <div class="col-md-6 text-right">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">135 followers </font>
                    </font><a class="btn btn-primary text-right pl-3 pr-3 ml-2" href="#">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Follow</font>
                        </font>
                    </a>
                </div>
            </div>
        </div>

        <!--------folg button end----->

        <div class="row">
            <div class="col-md-12">
                <img src="{{\App\Helpers\common::getMediaPath($company->company_gallery->first())}}" alt="" class="img-fluid">
            </div>

            <div class="text pt-4 pl-4 pr-4 pb-2">
                <h2 class="text-dark">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">{{ $company->emp_name }}</font>
                    </font>
                </h2>
                <p style="font-size: 20px;">
                {!! $company->emp_company_information !!}
                </p>
                <a href="#">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Read more on our website </font>
                    </font><span class="ml-1"><i class="fas fa-external-link-alt"></i></span>
                </a>
            </div>

        </div>

        <hr>
        <!------main image section end------>

        <div class="gallery mt-4 mb-5">
            <div class="row row-eq-height">
                <div class="col-md-8">
                    <img src="{{asset('/public/images/1280x720.png')}}" alt="" class="img-fluid w-100 h-100">
                </div>
                <div class="col-md-4">
                    <img src="{{asset('/public/images/1280x720.png')}}" alt="" class="img-fluid mb-4">
                    <img src="{{asset('/public/images/1280x720.png')}}" alt="" class="img-fluid">
                </div>
                <div class="col-12 text-center mt-4"><a href="#" class="btn btn btn-outline-primary">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">show more</font>
                        </font>
                    </a></div>
            </div>
        </div>

        <hr>

        <!------gallery section end------>

        <div class="row mt-4 mb-3">
            <div class="col-md-6">
                <h3 class="text-dark">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Vacancies</font>
                    </font>
                </h3>
            </div>
            <div class="col-md-6 text-right">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">135 followers </font>
                </font><a class="btn btn-primary text-right pl-3 pr-3 ml-2" href="#">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Follow</font>
                    </font>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="mb-1">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Select a job type</font>
                    </font>
                </p>
                <select class="form-control">
                    <option value="">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">All job types (2)</font>
                        </font>
                    </option>
                    <option value="Teknisk service">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Technical service (2)</font>
                        </font>
                    </option>
                    <option value="Teknisk personell">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Technical personnel (2)</font>
                        </font>
                    </option>
                    <option value="Mekanikk og installasjon">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Mechanics and installation (2)</font>
                        </font>
                    </option>
                    <option value="Ledelse">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Management (1)</font>
                        </font>
                    </option>
                    <option value="Annet">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Other (2)</font>
                        </font>
                    </option>
                </select>
            </div>

            <div class="col-md-6"></div>
        </div>
        <div class="row mt-4 mb-5">
            <div class="col-md-6">
                <h4 class="w-50 float-left mb-0" style="font-size: 20px;">
                    <a href="#">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">agricultural mechanic</font>
                        </font>
                    </a></h4>
                <div class="w-50 float-right">
                    <p class="text-right">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Stjørdal</font>
                        </font>
                    </p>
                </div>
                <p class="mb-0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">agricultural mechanic</font>
                    </font>
                </p>
                <p class="mb-0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">AK machines</font>
                    </font>
                </p>
            </div>

            <div class="col-md-6">

                <h4 class="w-50 float-left mb-0" style="font-size: 20px;">
                    <a href="#">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">agricultural mechanic</font>
                        </font>
                    </a></h4>
                <div class="w-50 float-right">
                    <p class="text-right">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Stjørdal</font>
                        </font>
                    </p>
                </div>
                <p class="mb-0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">agricultural mechanic</font>
                    </font>
                </p>
                <p class="mb-0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">AK machines</font>
                    </font>
                </p>
            </div>

        </div>
    </div>
    <!---links section end----->


</main>


@endsection
