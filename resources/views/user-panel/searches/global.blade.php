@extends('layouts.landingSite')
@section('page_content')
    <style>
        .go-to-global-search-page {
            display: none;
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
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="input-group search-box position-relative">
                        <input type="text" name="search" id="search" class="form-control search-control"
                               placeholder="Søk her..." autocomplete="off" value="{{$search}}">
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
                </div>

            </div>
        </div>
        <div class="right-ad pull-right">
            <img src="http://localhost/norgeshandel/public/images/right-ad.png" class="img-fluid" alt="">
        </div>
    </main>
    <input type="hidden" id="search_url" value="{{url('searching')}}">
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $('#search_url').val() + '/' + $('#search').val(),
                type: "GET",
                success: function (response) {
                    $('#suggestions').html(response);
                },
                error: function (error) {
                    console.log(error);
                }
            })
            $('#search').on('blur', function (e) {
                $('#suggestions').css('display', 'none');
            });

            $("#suggestions").hover(function () {
                $(this).css('display', 'block');
            });

            $('#search').on('keyup', function (e) {
                if (!isEmpty($('#search_url').val())) {
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
                    })
                } else {
                    $('#suggestions').html("");
                }
            });
        });

    </script>
@endsection
