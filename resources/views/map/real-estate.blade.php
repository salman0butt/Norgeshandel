<!DOCTYPE html>
<html>

<head>
    <title>Norgshandal Maps Diriections</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="description" content="Google Maps Diriections" />
    <meta name="keywords" content="Google Maps Diriections" />
    <meta name="author" content="Giri Jeedigunta - thewebstorebyg" />

    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/mediexpert.css')}}">
    <link rel="stylesheet" href="{{asset('public/mediexpert-mq.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="{{ asset('public/css/diriection.css') }}" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</head>

<body>
    @include('user-panel.partials.header')

    <div id="mapCanvas" style="top: 50px;">&#160;</div>
    <div id="directionsPanel">
        <div class="directionInputs">
            <form>
                <p>
                    <select name="searchKey" class="dme-form-control searchKey">
                        <option value="">Velg</option>
                        <option value="search_id_realestate_homes">Bolig til salgs</option>
                        <option value="search_id_realestate_homes_sold">Solgte boliger</option>
                        <option value="search_id_realestate_newbuildings">Nye boliger</option>
                        <option value="search_id_realestate_lettings">Bolig til leie</option>
                        <option value="search_id_realestate_plots">Tomt til salgs</option>
                        <option value="search_id_realestate_leisure_sale">Fritidsbolig til salgs</option>
                        <option value="search_id_realestate_abroad_homes">Bolig i utlandet</option>
                        <option value="search_id_realestate_leisure_plots">Fritidstomt til salgs</option>
                        <option value="search_id_company_sale">Bedrifter til salgs</option>
                        <option value="search_id_commercial_sale">Næringseiendom til salgs</option>
                        <option value="search_id_commercial_rent">Næringseiendom til leie</option>
                        <option value="search_id_commercial_plots">Næringstomt</option>
                    </select>

                </p>
                <!--Accordion wrapper-->
                {{-- <div class="accordion md-accordion accordion-1" id="accordionEx23" role="tablist">
                    <div class="card">
                        <div class="card-header blue lighten-3 z-depth-1" role="tab" id="heading96">
                            <h5 class="text-uppercase mb-0 py-1">
                                <a class="white-text font-weight-bold" data-toggle="collapse" href="#collapse96"
                                    aria-expanded="true" aria-controls="collapse96">
                                    I am the first title of accordion
                                </a>
                            </h5>
                        </div>
                        <div id="collapse96" class="collapse show" role="tabpanel" aria-labelledby="heading96"
                            data-parent="#accordionEx23">
                            <div class="card-body">
                                <div class="row my-4">
                                    <div class="col-md-8">
                                        <h2 class="font-weight-bold mb-3 black-text">Hi! I am the first one.</h2>
                                        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation
                                            ullamco laboris</p>
                                        <p class="mb-0">Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu
                                            fugiat nulla pariatur.</p>
                                    </div>
                                    <div class="col-md-4 mt-3 pt-2">
                                        <div class="view z-depth-1">
                                            <img src="https://mdbootstrap.com/img/Photos/Others/nature.jpeg" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header blue lighten-3 z-depth-1" role="tab" id="heading97">
                            <h5 class="text-uppercase mb-0 py-1">
                                <a class="collapsed font-weight-bold white-text" data-toggle="collapse"
                                    href="#collapse97" aria-expanded="false" aria-controls="collapse97">
                                    I am the second title of accordion
                                </a>
                            </h5>
                        </div>
                        <div id="collapse97" class="collapse" role="tabpanel" aria-labelledby="heading97"
                            data-parent="#accordionEx23">
                            <div class="card-body">
                                <div class="row my-4">
                                    <div class="col-md-8">
                                        <h2 class="font-weight-bold mb-3 black-text">Hi! I am the second one.</h2>
                                        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation
                                            ullamco laboris</p>
                                        <p class="mb-0">Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu
                                            fugiat nulla pariatur.</p>
                                    </div>
                                    <div class="col-md-4 mt-3 pt-2">
                                        <div class="view z-depth-1">
                                            <img src="https://mdbootstrap.com/img/Photos/Others/nature.jpeg" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header blue lighten-3 z-depth-1" role="tab" id="heading98">
                            <h5 class="text-uppercase mb-0 py-1">
                                <a class="collapsed font-weight-bold white-text" data-toggle="collapse"
                                    href="#collapse98" aria-expanded="false" aria-controls="collapse98">
                                    I am the third title of accordion
                                </a>
                            </h5>
                        </div>
                        <div id="collapse98" class="collapse" role="tabpanel" aria-labelledby="heading98"
                            data-parent="#accordionEx23">
                            <div class="card-body">
                                <div class="row my-4">
                                    <div class="col-md-8">
                                        <h2 class="font-weight-bold mb-3 black-text">Hi! I am the third one.</h2>
                                        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation
                                            ullamco laboris</p>
                                        <p class="mb-0">Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu
                                            fugiat nulla pariatur.</p>
                                    </div>
                                    <div class="col-md-4 mt-3 pt-2">
                                        <div class="view z-depth-1">
                                            <img src="https://mdbootstrap.com/img/Photos/Others/nature.jpeg" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!--Accordion wrapper-->

            </form>
        </div>

        <a href="#toggleBtn" id="paneToggle" class="out">&lt;</a>
    </div>
    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&libraries=places&callback=initMap"
        async defer></script> --}}
    <script>
        $(function () {

            // Caching the Selectors		
            $Selectors = {
                mapCanvas: jQuery('#mapCanvas')[0],
                dirPanel: jQuery('#directionsPanel'),
                dirInputs: jQuery('.directionInputs'),
                dirSrc: jQuery('#dirSource'),
                dirDst: jQuery('#dirDestination'),
                paneToggle: jQuery('#paneToggle'),

            };
            // Toggle Btn
            $Selectors.paneToggle.toggle(function (e) {
                $Selectors.dirPanel.animate({
                    'left': '-=305px'
                });
                jQuery(this).html('&gt;');
            }, function () {
                $Selectors.dirPanel.animate({
                    'left': '+=305px'
                });
                jQuery(this).html('&lt;');
            });
        });

    </script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
</body>

</html>
