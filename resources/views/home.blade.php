@extends('layouts.landingSite')
@section('page_content')
    <style>
        ul {
            list-style: none;
            padding-left: 5px !important;
        }
    </style>
    <main class="dme-wrapper">
        <div class="left-ad float-left">
        <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
        {{-- <div id="slideshow">
                {{(\App\Helpers\common::display_ad('left') ? \App\Helpers\common::display_ad('left') : '')}}

        </div> --}}

        </div>
        <div class="dme-container pl-3 pr-3">
            <div class="row top-ad">

<img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
            </div>
            <div class="row pt-4"></div>
            <div class="row pl-3">
                <div class="col-md-4 pt-5 bg-maroon-lighter maroon-box radius-8">
                    @include('user-panel.partials.searches-history')
                </div>
                <!--            ended col-->

                <div class="col-md-8">
                    <div class="input-group search-box position-relative">
                        <input type="text" name="search" id="search" class="form-control search-control"
                               placeholder="Søk her..." autofocus autocomplete="off">
                        <label for="search"><span class="input-group-addon">
                        <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" height="32"
                             width="32">
                        <path fill="currentColor" fill-rule="evenodd" d="M22.412
                            21.198l-.558.656-.656.558a10.449 10.449 0 0 1-6.754 2.476C8.685
                            24.888 4 20.203 4 14.444 4 8.685 8.685 4 14.444 4c5.759 0 10.445
                            4.685 10.445 10.444 0 2.473-.88 4.872-2.477 6.754zm1.524
                            1.294a12.393 12.393 0 0 0 2.953-8.048C26.889 7.571 21.317 2 14.444 2
                            7.572 2 2 7.571 2 14.444c0 6.873 5.572 12.444 12.444 12.444 3.069 0
                            5.878-1.11 8.048-2.952L28.556 30 30 28.555l-6.064-6.063z"></path>
                        </svg>
                        </span>
                        </label>
                        <div class="suggestions" id="suggestions"
                             style="position:absolute;top:35px;width:100%;height:auto;z-index: 1;background-color: rgba(236,223,226,0.9);box-shadow: 0 0 5px rgba(0,0,0,0.3);">

                            @if (isset($result) )
                                @include('user-panel.partials.global-search-inner')
                            @endif
                        </div>
                    </div>
                    <input type="hidden" value="{{ Auth::check() ? Auth::user()->id : '' }}" id="userId">
                    <div class="row">
                        <div class="col-sm-4 offset-sm-2 pt-3 text-center">
                            <a href="property/realestate" class="category">
                                <div class="category-icon" style="margin-top: 15px;">
                                    <img src="{{asset('public/images/Eiendom_ikon_maroon.svg')}}">
                                </div>
                                <div class="category-title color-grey font-weight-bold">Eiendom</div>
                            </a>
                        </div>
                        <div class="col-sm-4 text-center pt-3">
                            <a href="{{url('jobs')}}" class="category">
                                <div class="category-icon">
                                    <img src="{{asset('public/images/Jobb_ikon_maroon.svg')}}">
                                </div>
                                <div class="category-title color-grey font-weight-bold">Jobb</div>
                            </a>
                        </div>
                    </div>
                    <!--                ended row-->
                </div>
                <!--            ended col-->
            </div>
            <!--        ended row-->
            <div class="row mt-5 home-grid">
                @if($ads)
                    <div class="col-md-12">
                        <h2 class="u-t3 mb-4">Anbefalinger til deg</h2>
                    </div>
                    @foreach($ads as $ad)
                        @if($ad->ad_type=='job')
                            @include('user-panel.partials.templates.job-sequare')
                        @else
                            @include('user-panel.partials.templates.propert-sequare')
                        @endif
                    @endforeach
                @endif
            </div>
            <!--        ended row-->
        </div>
        <!--    ended container-->
        <div class="right-ad pull-right">
        <img src="http://localhost/norgeshandel/public/images/right-ad.png" class="img-fluid" alt="">
         {{-- <div id="slideshow">
            {{(\App\Helpers\common::display_ad('right') ? \App\Helpers\common::display_ad('right') : '')}}
        </div> --}}

        </div>
    </main>
    <input type="hidden" id="search_url" value="{{url('searching')}}">


    <script>
        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                    callback.apply(context, args);
                    }, ms || 0);
                };
            }
            $('#search').on('blur', function (e) {
                $('#suggestions').css('display', 'none');
            });

            $("#suggestions").hover(function () {
                $(this).css('display', 'block');
            });

            $('#search').on('keyup', function (e) {
                if(!isEmpty($('#search_url').val())) {
                    if(e.key=='Enter') {
                        var link = $('#all-searches-page').attr('href');
                        if(!isEmpty(link)){
                            location.href = link;
                        }
                    }
                        $('#suggestions').css('display', 'block');
                        $.ajax({
                            url: $('#search_url').val() + '/' + $('#search').val(),
                            type: "GET",
                            success: function (response) {
                                $('#suggestions').html(response);
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                }
                else{
                    $('#suggestions').html("");
                }
            });

            $('.ad_clicked').on('click', function (e) {
                //  e.preventDefault();
                var url = 'banner/ad/click';
                var banner_id = $(this).attr("data-banner-id");
                var user_id = $('#userId').val();


                $.ajax({
                    url: url,
                    type: "POST",
                    data: {banner_id: banner_id,user_id: user_id },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            });
        });



    </script>
@endsection
