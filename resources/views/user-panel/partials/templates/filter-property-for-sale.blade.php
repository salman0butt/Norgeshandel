<li class="nav-item filter-btn">
    <a class="nav-link mega-menu-button" href="#">
        <span class="fas fa-sliders-h float-left mt-2 color-maroon fa-bars" style="font-size: 1.5em;"></span>
        <div class="mt-2 ml-2">Filtrer</div>
    </a>
    <div class="mega-menu smart-scroll">
        <div class="container-fluid text-left">
            <form action="" id="mega_menu_form">
                <div class="row">
                    <div style="border-right:1px solid #ddd;" class="col-md-3">
                        <div class="form-group nav-dynamic-checks">
                            <label for="search" class="mb-1 font-weight-bold">Søk i Eiendom</label>
                            <div class="input-group search-box">
                                <input type="text" id="search" name="search" class="dme-form-control search-control"
                                       placeholder="" value="{{Request::get('search') ? Request::get('search') : ''}}">
                                <span class="input-group-addon pt-2">
                                                    <svg focusable="false" xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 32 32" height="26" width="26">
                                                    <path fill="currentColor" fill-rule="evenodd" d="M22.412
                                                        21.198l-.558.656-.656.558a10.449 10.449 0 0 1-6.754 2.476C8.685
                                                        24.888 4 20.203 4 14.444 4 8.685 8.685 4 14.444 4c5.759 0 10.445
                                                        4.685 10.445 10.444 0 2.473-.88 4.872-2.477 6.754zm1.524
                                                        1.294a12.393 12.393 0 0 0 2.953-8.048C26.889 7.571 21.317 2 14.444 2
                                                        7.572 2 2 7.571 2 14.444c0 6.873 5.572 12.444 12.444 12.444 3.069 0
                                                        5.878-1.11 8.048-2.952L28.556 30 30 28.555l-6.064-6.063z"></path>
                                                    </svg>
                                                    </span>
                            </div>
                        </div>
                        <div class="form-group nav-dynamic-checks ">
                            <h3 class="u-t5">Publisert</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="created_at" value="{{today()->toDateString()}}"
                                               id="published-1">
                                        <label for="published-1" class="">Nye i dag <span
                                                data-name="{{today()->toDateString()}}"
                                                data-title="created_at"
                                                class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Område, by eller sted</h3>
                            <div class="float-left mt-2">
                                <input id="local_area_name_check" type="checkbox" name="local_area_name_check">
                                <label for="local_area_name_check"></label>
                            </div>
                            <div class="" style="width:89%; float: right;">
                                <input type="text" placeholder="Søk etter adresse eller sted" name="local_area_name"
                                       class="dme-form-control">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5 mt-3">Prisantydning</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="asking_price_from">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="asking_price_to">
                                    <span class="u-t5">Til kr</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="asking_price_btn" class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Totalpris</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="total_price_from">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="total_price_to">
                                    <span class="u-t5">Til kr</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="total_price_btn" class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Fellesutgifter per måned</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="rent_shared_cost_from">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="rent_shared_cost_to">
                                    <span class="u-t5">Til kr</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="expense_per_month_btn" class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Størrelse</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="use_area_from">
                                    <span class="u-t5">Fra m<sup>2</sup></span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="use_area_to">
                                    <span class="u-t5">Til m<sup>2</sup></span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="size_btn" class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Antall soverom</h3>
                            <div class="rounded-radio row pl-3 pr-3">
                                <input type="radio" id="bedrooms" name="number_of_bedrooms">
                                <label for="bedrooms" class="col-2 first">Alle</label>

                                <input type="radio" id="bedroom-1" name="number_of_bedrooms" value="1">
                                <label for="bedroom-1" class="col-2">1+</label>

                                <input type="radio" id="bedroom-2" name="number_of_bedrooms" value="2">
                                <label for="bedroom-2" class="col-2">2+</label>

                                <input type="radio" id="bedroom-3" name="number_of_bedrooms" value="3">
                                <label for="bedroom-3" class="col-2">3+</label>

                                <input type="radio" id="bedroom-4" name="number_of_bedrooms" value="4">
                                <label for="bedroom-4" class="col-2">4+</label>

                                <input type="radio" id="bedroom-5" name="number_of_bedrooms" value="5">
                                <label for="bedroom-5" class="col-2 last">5+</label>
                            </div>
                        </div>

                        <!--                                        -->
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Tomtestørrelse</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="land_from">
                                    <span class="u-t5">Fra m<sup>2</sup></span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="land_to">
                                    <span class="u-t5">Til m<sup>2</sup></span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="lot_size_btn" class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Byggeår</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="year_from">
                                    <span class="u-t5">Fra</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="year_to">
                                    <span class="u-t5">Til</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="year_btn" class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>

                        <!--                                        -->
                    </div>
                    <div style="border-right:1px solid #ddd;" class="col-md-3">
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Område</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'states_and_cities')->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms());
                            }
                            ?>
                        </div>

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Type søk</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="sold_status[]" value="available" id="navSold_status-0">
                                        <label for="navSold_status-0" class="">Til salgs <span data-name="available" data-title="sold_status" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="sold_status[]" value="sold" id="navSold_status-1">
                                        <label for="navSold_status-1" class="">Solgt siste 3 dager <span data-name="sold" data-title="sold_status" class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Nytt/brukt</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="condition[]" value="new" id="navCondition-0">
                                        <label for="navCondition-0" class="">Brukt bolig <span data-name="used" data-title="condition" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="condition[]" value="used" id="navCondition-1">
                                        <label for="navCondition-1" class="">Nybygg <span data-name="new" data-title="condition" class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Visningsdato</h3>
                            <ul class="list-unstyled">
                                @for($i=0; $i<30; $i++)
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="display_date[]" value="{{now()->addDays($i)->toDateString()}}" id="navdisplaydate-{{$i}}">
                                        <label for="navdisplaydate-{{$i}}" class="">{{now()->addDays($i)->isoFormat("dddd DD. MMMM")}} <span data-name="{{now()->addDays($i)->toDateString()}}" data-title="display_name" class="count"></span></label>
                                    </div>
                                </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <div style="border-right:1px solid #ddd;" class="col-md-3">

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Boligtype</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'pfs_property_type')->get()->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms());
                            }
                            ?>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Eierform</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'pfs_tenure')->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms());
                            }
                            ?>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Privat/Megler</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="user_type[]" value="Privat" id="navPrivat">
                                        <label for="navPrivat" class="">Privat <span data-name="Privat" data-title="user_type" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="user_type[]" value="Megler" id="navMegler">
                                        <label for="navMegler" class="">Megler <span data-name="Company" data-title="user_type" class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Fasiliteter</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-AIRCONDITIONING" type="checkbox" value="AIRCONDITIONING" name="facilities[]">
                                        <label class="smalltext" for="facilities-AIRCONDITIONING"> Aircondition <span data-name="AIRCONDITIONING" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-ALARM" type="checkbox" value="ALARM" name="facilities[]">
                                        <label class="smalltext" for="facilities-ALARM"> Alarm <span data-name="ALARM" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-BALCONY" type="checkbox" value="BALCONY" name="facilities[]">
                                        <label class="smalltext" for="facilities-BALCONY"> Balkong/Terrasse <span data-name="BALCONY" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-CHILD-FRIENDLY" type="checkbox" value="CHILD-FRIENDLY" name="facilities[]">
                                        <label class="smalltext" for="facilities-CHILD-FRIENDLY"> Barnevennlig <span data-name="CHILD-FRIENDLY" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-BROADBAND" type="checkbox" value="BROADBAND" name="facilities[]">
                                        <label class="smalltext" for="facilities-BROADBAND"> Bredbåndstilknytning <span data-name="BROADBAND" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-COMMONWASHROOM" type="checkbox" value="COMMONWASHROOM" name="facilities[]">
                                        <label class="smalltext" for="facilities-COMMONWASHROOM"> Fellesvaskeri <span data-name="COMMONWASHROOM" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-GARAGE" type="checkbox" value="GARAGE" name="facilities[]">
                                        <label class="smalltext" for="facilities-GARAGE"> Garasje/P-plass <span data-name="GARAGE" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-LIFT" type="checkbox" value="LIFT" name="facilities[]">
                                        <label class="smalltext" for="facilities-LIFT"> Heis <span data-name="LIFT" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-NO-NEIGHBOURS-OP" type="checkbox" value="NO-NEIGHBOURS-OP" name="facilities[]">
                                        <label class="smalltext" for="facilities-NO-NEIGHBOURS-OP"> Ingen gjenboere <span data-name="NO-NEIGHBOURS-OP" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-CABLE-TV" type="checkbox" value="CABLE-TV" name="facilities[]">
                                        <label class="smalltext" for="facilities-CABLE-TV"> Kabel-TV <span data-name="CABLE-TV" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-CHARGING" type="checkbox" value="CHARGING" name="facilities[]">
                                        <label class="smalltext" for="facilities-CHARGING"> Lademulighet <span data-name="CHARGING" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-ACCESSIBILITY_LEVEL" type="checkbox" value="ACCESSIBILITY_LEVEL" name="facilities[]">
                                        <label class="smalltext" for="facilities-ACCESSIBILITY_LEVEL"> Livsløpsstandard <span data-name="ACCESSIBILITY_LEVEL" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-MODERN" type="checkbox" value="MODERN" name="facilities[]">
                                        <label class="smalltext" for="facilities-MODERN"> Moderne <span data-name="MODERN" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-PARQUETT" type="checkbox" value="PARQUETT" name="facilities[]">
                                        <label class="smalltext" for="facilities-PARQUETT"> Parkett <span data-name="PARQUETT" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-FIREPLACE" type="checkbox" value="FIREPLACE" name="facilities[]">
                                        <label class="smalltext" for="facilities-FIREPLACE"> Peis/Ildsted <span data-name="FIREPLACE" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-QUIET-AREA" type="checkbox" value="QUIET-AREA" name="facilities[]">
                                        <label class="smalltext" for="facilities-QUIET-AREA"> Rolig <span data-name="QUIET-AREA" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-CENTRAL" type="checkbox" value="CENTRAL" name="facilities[]">
                                        <label class="smalltext" for="facilities-CENTRAL"> Sentralt <span data-name="CENTRAL" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-VIEW" type="checkbox" value="VIEW" name="facilities[]">
                                        <label class="smalltext" for="facilities-VIEW"> Utsikt <span data-name="VIEW" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-JANITORSERVICE" type="checkbox" value="JANITORSERVICE" name="facilities[]">
                                        <label class="smalltext" for="facilities-JANITORSERVICE"> Vaktmester-/vektertjeneste <span data-name="JANITORSERVICE" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input id="facilities-HIKING" type="checkbox" value="HIKING" name="facilities[]">
                                        <label class="smalltext" for="facilities-HIKING"> Turterreng <span data-name="HIKING" data-title="facilities" class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Etasje</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="1" id="navFloor">
                                        <label for="navFloor" class="">1 etasje<span data-name="1" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="2" id="navFloor-1">
                                        <label for="navFloor-1" class="">2 etasje<span data-name="2" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="3" id="navFloor-2">
                                        <label for="navFloor-2" class="">3 etasje<span data-name="3" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="4" id="navFloor-3">
                                        <label for="navFloor-3" class="">4 etasje<span data-name="4" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="5" id="navFloor-4">
                                        <label for="navFloor-4" class="">5 etasje<span data-name="5" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="6" id="navFloor-5">
                                        <label for="navFloor-5" class="">6 etasje<span data-name="6" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="over_6" id="navFloor-6">
                                        <label for="navFloor-6" class="">Over 6 etasje<span data-name="over 6" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Energikarakter</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="A" id="navEnergy_unit">
                                        <label for="navEnergy_unit" class="">A <span data-name="A" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="B" id="navEnergy_unit-1">
                                        <label for="navEnergy_unit-1" class="">B <span data-name="B" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="C" id="navEnergy_unit-2">
                                        <label for="navEnergy_unit-2" class="">C <span data-name="C" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="D" id="navEnergy_unit-3">
                                        <label for="navEnergy_unit-3" class="">D <span data-name="D" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="E" id="navEnergy_unit-4">
                                        <label for="navEnergy_unit-4" class="">E <span data-name="E" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="F" id="navEnergy_unit-5">
                                        <label for="navEnergy_unit-5" class="">F <span data-name="F" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="G" id="navEnergy_unit-6">
                                        <label for="navEnergy_unit-6" class="">G <span data-name="G" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</li>
