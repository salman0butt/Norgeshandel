@extends('layouts.landingSite')
<style>
    .sidebar {
        background-color: #F6F8FB;
        padding: 10px 15px;
    }

    .status--error {
        background-color: #FFEFEF;
        border-radius: 10px;
        padding: 0 10px;
    }
    .u-pv8 a:hover {
        text-decoration:underline;
    }
</style>
@section('page_content')
<main class="dme-container mt-5">


    <div class="breade-crumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mine annonser</li>
                <li class="breadcrumb-item active" aria-current="page">Pariatur Ut est qui</li>
            </ol>
        </nav>
    </div>
    <div id="content-start">
        <div class="grid row">
            <div class="grid__unit col-md-8">
                <div class="panel u-mb32">
                    <div class="mt-1 mb-2">
                        <span class="status status--error">Påbegynt</span>
                        <span class="u-no-break u-caption">Utløper: 21.02.2020</span>
                    </div>

                    <div style="display: flex;" class="mt-5">
                        <div class="u-mr16">
                            <div class="img-format img-format--ratio3by2 img-format--centered image-frame u-bg-ice"
                                style="min-width: 98px;">
                                <img class="img-format__img"
                                    src="https://static.finncdn.no/_c/mfinn/static/images/no-image.5bf83e47.svg"
                                    alt="Bilde mangler">
                            </div>
                        </div>
                        <div style="min-width: 0;">
                            <h1 class="u-truncate">Pariatur Ut est qui</h1>
                            <p>
                                417,-&nbsp;
                                <a href="#">Se statistikk</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid__unit col-md-4">
                <div class="sidebar u-pv8 mt-5">
                    <a class="u-pv8 mt-2" href="#">Se annonsen</a>
                    <div class="u-pt8">
                        <div class="u-pv8 mt-2">
                            <a href="#">Endre annonsen
                            </a>
                        </div>
                        <div class="u-pv8 mt-2">
                            <div>
                                <a href="#">Slett</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>







@endsection
