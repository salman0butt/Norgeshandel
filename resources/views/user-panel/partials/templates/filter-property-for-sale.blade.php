<li class="nav-item filter-btn">
    <a class="nav-link mega-menu-button" id="mega-menu-button" href="#">
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
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Publisert</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="created_at" value="{{today()->toDateString()}}"
                                               id="published-1" {{Request()->created_at && Request()->created_at == today()->toDateString() ? 'checked' : ''}}>
                                        <label for="published-1" class="">Nye i dag <span
                                                data-name="{{today()->toDateString()}}"
                                                data-title="created_at"
                                                class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        @include('user-panel.partials.templates.ad-map-filter')

                        <div class="clearfix"></div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5 mt-3">Prisantydning</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="asking_price_from" value="{{Request()->asking_price_from}}">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="asking_price_to" value="{{Request()->asking_price_to}}">
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
                                    <input type="text" class="dme-form-control" name="total_price_from"  value="{{Request()->total_price_from}}">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="total_price_to"  value="{{Request()->total_price_to}}">
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
                                    <input type="text" class="dme-form-control" name="rent_shared_cost_from" value="{{Request()->rent_shared_cost_from}}">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="rent_shared_cost_to" value="{{Request()->rent_shared_cost_to}}">
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
                                    <input type="text" class="dme-form-control" name="use_area_from" value="{{Request()->use_area_from}}">
                                    <span class="u-t5">Fra m<sup>2</sup></span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="use_area_to" value="{{Request()->use_area_to}}">
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
                                <input type="radio" id="bedrooms" name="number_of_bedrooms" {{Request()->number_of_bedrooms && Request()->number_of_bedrooms == 'on' ? 'checked' : ''}}>
                                <label for="bedrooms" class="col-2 first">Alle</label>

                                <input type="radio" id="bedroom-1" name="number_of_bedrooms" value="1" {{Request()->number_of_bedrooms && Request()->number_of_bedrooms == 1 ? 'checked' : ''}}>
                                <label for="bedroom-1" class="col-2">1+</label>

                                <input type="radio" id="bedroom-2" name="number_of_bedrooms" value="2" {{Request()->number_of_bedrooms && Request()->number_of_bedrooms == 2 ? 'checked' : ''}}>
                                <label for="bedroom-2" class="col-2">2+</label>

                                <input type="radio" id="bedroom-3" name="number_of_bedrooms" value="3" {{Request()->number_of_bedrooms && Request()->number_of_bedrooms == 3 ? 'checked' : ''}}>
                                <label for="bedroom-3" class="col-2">3+</label>

                                <input type="radio" id="bedroom-4" name="number_of_bedrooms" value="4" {{Request()->number_of_bedrooms && Request()->number_of_bedrooms == 4 ? 'checked' : ''}}>
                                <label for="bedroom-4" class="col-2">4+</label>

                                <input type="radio" id="bedroom-5" name="number_of_bedrooms" value="5" {{Request()->number_of_bedrooms && Request()->number_of_bedrooms == 5 ? 'checked' : ''}}>
                                <label for="bedroom-5" class="col-2 last">5+</label>
                            </div>
                        </div>

                        <!--                                        -->
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Tomtestørrelse</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="land_from" value="{{Request()->land_from}}">
                                    <span class="u-t5">Fra m<sup>2</sup></span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="land_to" value="{{Request()->land_to}}">
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
                                    <input type="text" class="dme-form-control" name="year_from" value="{{Request()->year_from}}">
                                    <span class="u-t5">Fra</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="year_to" value="{{Request()->year_to}}">
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
                        <!-- include areas like oslo, bergen in filter -->
                        @include('user-panel.partials.templates.area-property-filter')

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Type søk</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="for_sale" value="for_sale" id="navSold_status-0" {{Request()->for_sale && Request()->for_sale == "for_sale" ? "checked" : ""}}>
                                        <label for="navSold_status-0" class="">Til salgs <span data-name="available" data-title="sold_status" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="sold_in_three_days" value="sold_in_three_days" id="navSold_status-1" {{Request()->sold_in_three_days && Request()->sold_in_three_days == "sold_in_three_days" ? "checked" : ""}}>
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
                                        <input type="checkbox" name="condition[]" value="new" id="navCondition-0" {{Request()->condition ? is_numeric(array_search('new', Request()->condition)) ? "checked" : "" : ''}}>
                                        <label for="navCondition-0" class="">Brukt bolig <span data-name="used" data-title="condition" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="condition[]" value="used" id="navCondition-1" {{Request()->condition ? is_numeric(array_search('used', Request()->condition)) ? "checked" : "" : ''}}>
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
                                            <input type="checkbox" name="display_date[]" value="{{date('d-m-Y',strtotime(now()->addDays($i)->toDateString()))}}" id="navdisplaydate-{{$i}}" {{Request()->display_date ? is_numeric(array_search( date('d-m-Y',strtotime(now()->addDays($i)->toDateString())),Request()->display_date)) ? "checked" : "" : ''}}>
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
                                echo App\Helpers\common::map_nav($tax->parent_terms(),Request()->pfs_property_type);
                            }
                            ?>
                        </div>

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Eierform</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'pfs_tenure')->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms(),Request()->pfs_tenure);
                            }
                            ?>
                        </div>
                 @if(\Illuminate\Support\Facades\Request::is('map/select-property'))
                        <input type="hidden" id="mega_menu_search_url" value="{{url('property/property-for-sale/search')}}">
                        <input class="form-control" type="hidden" name="map" value="map">
                   @endif
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Privat/Megler</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="user_type[]" value="Privat" id="navPrivat" {{ Request()->user_type ? is_numeric(array_search('Privat', Request()->user_type)) ? "checked" : "" : ''}}>
                                        <label for="navPrivat" class="">Privat <span data-name="Privat" data-title="user_type" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="user_type[]" value="Megler" id="navMegler" {{ Request()->user_type ? is_numeric(array_search('Megler', Request()->user_type)) ? "checked" : "" : ''}}>
                                        <label for="navMegler" class="">Megler <span data-name="Company" data-title="user_type" class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        @php
                            $pfs_facility = \App\Taxonomy::where('slug', 'pfs_facilities')->first();
                            $pfs_facilities = $pfs_facility->terms;
                        @endphp
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Fasiliteter</h3>
                            <ul class="list list-unstyled">
                                @if($pfs_facilities->count() > 0)
                                    @foreach($pfs_facilities as $facility)
                                        <li>
                                            <div class="input-toggle">
                                                <input id="facilities-{{$facility->id}}" type="checkbox" value="{{$facility->name}}" name="facilities[]" {{Request()->facilities ? is_numeric(array_search($facility->name, Request()->facilities)) ? "checked" : "" : ''}}>
                                                <label class="smalltext" for="facilities-{{$facility->id}}"> {{$facility->name}} <span data-name="{{$facility->name}}" data-title="facilities" class="count"></span></label>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Etasje</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="1" id="navFloor" {{Request()->floor ? is_numeric(array_search(1, Request()->floor)) ? "checked" : "" : ''}}>
                                        <label for="navFloor" class="">1 etasje<span data-name="1" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="2" id="navFloor-1" {{Request()->floor ? is_numeric(array_search(2, Request()->floor)) ? "checked" : "" : ''}}>
                                        <label for="navFloor-1" class="">2 etasje<span data-name="2" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="3" id="navFloor-2" {{Request()->floor ? is_numeric(array_search(3, Request()->floor)) ? "checked" : "" : ''}}>
                                        <label for="navFloor-2" class="">3 etasje<span data-name="3" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="4" id="navFloor-3" {{Request()->floor ? is_numeric(array_search(4, Request()->floor)) ? "checked" : "" : ''}}>
                                        <label for="navFloor-3" class="">4 etasje<span data-name="4" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="5" id="navFloor-4" {{Request()->floor ? is_numeric(array_search(5, Request()->floor)) ? "checked" : "" : ''}}>
                                        <label for="navFloor-4" class="">5 etasje<span data-name="5" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="6" id="navFloor-5" {{Request()->floor ? is_numeric(array_search(6, Request()->floor)) ? "checked" : "" : ''}}>
                                        <label for="navFloor-5" class="">6 etasje<span data-name="6" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="over_6" id="navFloor-6" {{Request()->floor ? is_numeric(array_search('over_6', Request()->floor)) ? "checked" : "" : ''}}>
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
                                        <input type="checkbox" name="energy_unit[]" value="A" id="navEnergy_unit" {{Request()->energy_unit ? is_numeric(array_search('A', Request()->energy_unit)) ? "checked" : "" : ''}}>
                                        <label for="navEnergy_unit" class="">A <span data-name="A" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="B" id="navEnergy_unit-1" {{Request()->energy_unit ? is_numeric(array_search('B', Request()->energy_unit)) ? "checked" : "" : ''}}>
                                        <label for="navEnergy_unit-1" class="">B <span data-name="B" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="C" id="navEnergy_unit-2" {{Request()->energy_unit ? is_numeric(array_search('C', Request()->energy_unit)) ? "checked" : "" : ''}}>
                                        <label for="navEnergy_unit-2" class="">C <span data-name="C" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="D" id="navEnergy_unit-3" {{Request()->energy_unit ? is_numeric(array_search('D', Request()->energy_unit)) ? "checked" : "" : ''}}>
                                        <label for="navEnergy_unit-3" class="">D <span data-name="D" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="E" id="navEnergy_unit-4" {{Request()->energy_unit ? is_numeric(array_search('E', Request()->energy_unit)) ? "checked" : "" : ''}}>
                                        <label for="navEnergy_unit-4" class="">E <span data-name="E" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="F" id="navEnergy_unit-5" {{Request()->energy_unit ? is_numeric(array_search('F', Request()->energy_unit)) ? "checked" : "" : ''}}>
                                        <label for="navEnergy_unit-5" class="">F <span data-name="F" data-title="energy_unit" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="energy_unit[]" value="G" id="navEnergy_unit-6" {{Request()->energy_unit ? is_numeric(array_search('G', Request()->energy_unit)) ? "checked" : "" : ''}}>
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
