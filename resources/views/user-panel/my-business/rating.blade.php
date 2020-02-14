@extends('layouts.landingSite')

@section('page_content')
<style>
.checked {
    color: orange;
}
</style>
<div class="dme-container">
    <div class="breade-crumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Min handel </a></li>
                <li class="breadcrumb-item active" aria-current="page">Endre profil</li>
            </ol>
        </nav>
    </div>

    <!--------bread-crumb end----->

    <div class="row mt-5 mb-5 pl-4 pr-4">
        <div class="col-md-4 mt-3">
            <div class="card ">
                <div class="card-header p-4">
                    <h4 style="font-size:18px;">Gjennomsnittlig rangering</h4>
                    <h3>4.3/<small>5</small></h3>
                    <div class="rating-stars">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8 mt-3">
            <h4 style="font-size:18px;">Rangering fordelt</h4>
            <div class="rating-stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="ml-2"><b>1</b></span>
            </div>
            <div class="rating-stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="ml-2"><b>1</b></span>
            </div>
            <div class="rating-stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="ml-2"><b>0</b></span>
            </div>
            <div class="rating-stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="ml-2"><b>0</b></span>
            </div>
            <div class="rating-stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="ml-2"><b>0</b></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="review-block pl-5 pr-5">
            <div class="row">
                <div class="col-sm-3">
                    <img src="http://dummyimage.com/60x60/666/ffffff&amp;text=No+Image" class="img-rounded">
                    <div class="review-block-name"><a href="#">Navn</a></div>
                    <div class="review-block-date">29. januar 2016<br>1 dag siden</div>
                </div>
                <div class="col-sm-9">
                    <div class="review-block-rate">
                        <div class="rating-stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <div class="review-block-title">Dette var fint å kjøpe</div>
                    <div class="review-block-description">Dette var fint å kjøpe dette var fint å kjøpe dette var fint å
                        kjøpe dette var fint å kjøpe dette var fint å kjøpe dette var fint å kjøpe dette var fint å
                        kjøpe</div>
                </div>
            </div>

        </div>
        <hr>
        <!--------Single user rating----->

        <div class="review-block pl-5 pr-5">
            <div class="row">
                <div class="col-sm-3">
                    <img src="http://dummyimage.com/60x60/666/ffffff&amp;text=No+Image" class="img-rounded">
                    <div class="review-block-name"><a href="#">Navn</a></div>
                    <div class="review-block-date">29. januar 2016<br>1 dag siden</div>
                </div>
                <div class="col-sm-9">
                    <div class="review-block-rate">
                        <div class="rating-stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <div class="review-block-title">Dette var fint å kjøpe</div>
                    <div class="review-block-description">Dette var fint å kjøpe dette var fint å kjøpe dette var fint å
                        kjøpe dette var fint å kjøpe dette var fint å kjøpe dette var fint å kjøpe dette var fint å
                        kjøpe</div>
                </div>
            </div>

        </div>
        <hr>
        <!--------Single user rating----->

        <div class="review-block pl-5 pr-5">
            <div class="row">
                <div class="col-sm-3">
                    <img src="http://dummyimage.com/60x60/666/ffffff&amp;text=No+Image" class="img-rounded">
                    <div class="review-block-name"><a href="#">Navn</a></div>
                    <div class="review-block-date">29. januar 2016<br>1 dag siden</div>
                </div>
                <div class="col-sm-9">
                    <div class="review-block-rate">
                        <div class="rating-stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <div class="review-block-title">Dette var fint å kjøpe</div>
                    <div class="review-block-description">Dette var fint å kjøpe dette var fint å kjøpe dette var fint å
                        kjøpe dette var fint å kjøpe dette var fint å kjøpe dette var fint å kjøpe dette var fint å
                        kjøpe</div>
                </div>
            </div>

        </div>
        <hr>
        <!--------Single user rating----->

        <div class="review-block pl-5 pr-5">
            <div class="row">
                <div class="col-sm-3">
                    <img src="http://dummyimage.com/60x60/666/ffffff&amp;text=No+Image" class="img-rounded">
                    <div class="review-block-name"><a href="#">Navn</a></div>
                    <div class="review-block-date">29. januar 2016<br>1 dag siden</div>
                </div>
                <div class="col-sm-9">
                    <div class="review-block-rate">
                        <div class="rating-stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <div class="review-block-title">Dette var fint å kjøpe</div>
                    <div class="review-block-description">Dette var fint å kjøpe dette var fint å kjøpe dette var fint å
                        kjøpe dette var fint å kjøpe dette var fint å kjøpe dette var fint å kjøpe dette var fint å
                        kjøpe</div>
                </div>
            </div>

        </div>
        <hr>
        <!--------Single user rating----->
    </div>
</div>

@endsection
