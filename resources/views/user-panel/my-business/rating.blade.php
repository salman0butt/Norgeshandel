@extends('layouts.landingSite')

@section('page_content')
<style>
    .checked {
        color: orange;
    }
    .rating-stars span{
        font-size: 18px;
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
                    @php
                        $avg = Auth::user()->received_ratings->count() > 0 ? Auth::user()->received_ratings->avg('general_ratings') : '0';
                    @endphp
                    <h3>{{$avg ?  round($avg) : $avg}}
                        /<small>10</small></h3>
                    <div class="rating-stars">
                        @for($i=1;$i<=5;$i++)
                            <span class="fa fa-star {{$i <= ($avg/2)  ? 'checked' : ''}}"></span>
                        @endfor
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8 mt-3">
            <h4 style="font-size:18px;">Rangering fordelt</h4>
            <div class="rating-stars">
                @for($i=5;$i>=1;$i--)
                    <span class="fa fa-star checked"></span>
                @endfor
                <span class="ml-2"><b>10</b></span>
            </div>
            <div class="rating-stars">
                @for($i=5;$i>=1;$i--)
                    <span class="fa fa-star {{$i != 1 ? 'checked' : ''}}"></span>
                @endfor
                <span class="ml-2"><b>8</b></span>
            </div>
            <div class="rating-stars">
                @for($i=5;$i>=1;$i--)
                    <span class="fa fa-star {{$i >2  ? 'checked' : ''}}"></span>
                @endfor
                <span class="ml-2"><b>6</b></span>
            </div>
            <div class="rating-stars">
                @for($i=5;$i>=1;$i--)
                    <span class="fa fa-star {{$i >3  ? 'checked' : ''}}"></span>
                @endfor
                <span class="ml-2"><b>4</b></span>
            </div>
            <div class="rating-stars">
                @for($i=5;$i>=1;$i--)
                    <span class="fa fa-star {{$i >4  ? 'checked' : ''}}"></span>
                @endfor
                <span class="ml-2"><b>2</b></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="row ratings-section">
        @if($ratings->count() > 0)
            @include('user-panel.my-business.rating-inner')
        @else
            <p class="m-auto pb-3">Brukeren har ikke fått noen vurderinger</p>
        @endif
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(".timeago").timeago();
        })
    </script>
    <script src="{{asset('public/js/time-ago-in-words.min.js')}}"></script>
@endsection
