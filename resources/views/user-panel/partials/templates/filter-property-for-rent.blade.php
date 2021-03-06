<li class="nav-item filter-btn">
    <a class="nav-link mega-menu-button" id="mega-menu-button" href="#">
        <span class="fas fa-sliders-h float-left mt-2 color-maroon fa-bars" style="font-size: 1.5em;"></span>
        <div class="mt-2 ml-2">Filtrer</div>
    </a>
    <div class="mega-menu smart-scroll">
        <div class="container-fluid text-left">
            <form action="" id="mega_menu_form">
                <div class="row">
                    <div style="border-right:1px solid #ddd;" class="col-lg-3 col-sm-6 col-12">
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
                                        <input type="checkbox" name="created_at" value="{{now()->toDateString()}}"
                                               id="published-1"  {{Request()->created_at && Request()->created_at == now()->toDateString() ? 'checked' : ''}}>
                                        <label for="published-1" class="">Nye i dag <span
                                                data-name="{{today()->toDateString()}}"
                                                data-title="created_at"
                                                class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- include map -->
                        @include('user-panel.partials.templates.ad-map-filter')

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Månedsleie</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="monthly_rent_from" value="{{Request()->monthly_rent_from}}">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="monthly_rent_to" value="{{Request()->monthly_rent_to}}">
                                    <span class="u-t5">Til kr</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="monthly_rent_btn" class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>
                        @if(\Illuminate\Support\Facades\Request::is('map/select-property'))
                            <input type="hidden" id="mega_menu_search_url" value="{{url('property/property-for-rent/search')}}">
                            <input class="form-control" type="hidden" name="map" value="map">
                       @endif

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
                        <!--                                        -->
                    </div>

                    <div style="border-right:1px solid #ddd;" class="col-lg-3 col-sm-6 col-12">
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

                        <!-- include areas like oslo, bergen in filter -->
                        @include('user-panel.partials.templates.area-property-filter')

                    </div>
                    <div style="border-right:1px solid #ddd;" class="col-lg-3 col-sm-6 col-12">

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Boligtype</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'pfr_property_type')->get()->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms(),Request()->pfr_property_type);
                            }
                            ?>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Fasiliteter</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'pfr_facilities')->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms(),Request()->pfr_facilities);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Ledig fra</h3>
                            <ul class="list list-unstyled">
                                @for($i=0; $i<16; $i++)
                                    @php $val = now()->addMonths($i)->year; $val1 = now()->addMonths($i)->month<10?'0'.now()->addMonths($i)->month:now()->addMonths($i)->month; $org_val = $val.'-'.$val1; @endphp
                                    <li>
                                        <div class="input-toggle">
                                            <input type="checkbox" name="available_from[]" value="{{$org_val}}" id="available_from-{{$i}}" {{Request()->available_from ? is_numeric(array_search($org_val, Request()->available_from)) ? "checked" : "" : ''}}>
                                            <label for="available_from-{{$i}}" class="">{{now()->addMonths($i)->monthName}} <span data-name="Akershus" data-title="available_from" class="count"></span></label>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Etasje</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="1" id="navFloor" {{Request()->floor ? is_numeric(array_search(1,Request()->floor)) ? "checked" : "" : ""}}>
                                        <label for="navFloor" class="">1 etasje<span data-name="1" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="2" id="navFloor-1" {{Request()->floor ? is_numeric(array_search(2,Request()->floor)) ? "checked" : "" : ""}}>
                                        <label for="navFloor-1" class="">2 etasje<span data-name="2" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="3" id="navFloor-2" {{Request()->floor ? is_numeric(array_search(3,Request()->floor)) ? "checked" : "" : ""}}>
                                        <label for="navFloor-2" class="">3 etasje<span data-name="3" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="4" id="navFloor-3" {{Request()->floor ? is_numeric(array_search(4,Request()->floor)) ? "checked" : "" : ""}}>
                                        <label for="navFloor-3" class="">4 etasje<span data-name="4" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="5" id="navFloor-4" {{Request()->floor ? is_numeric(array_search(5,Request()->floor)) ? "checked" : "" : ""}}>
                                        <label for="navFloor-4" class="">5 etasje<span data-name="5" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="6" id="navFloor-5" {{Request()->floor ? is_numeric(array_search(6,Request()->floor)) ? "checked" : "" : ""}}>
                                        <label for="navFloor-5" class="">6 etasje<span data-name="6" data-title="floor" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="floor[]" value="over_6" id="navFloor-6" {{Request()->floor ? is_numeric(array_search('over_6',Request()->floor)) ? "checked" : "" : ""}}>
                                        <label for="navFloor-6" class="">Over 6 etasje<span data-name="over 6" data-title="floor" class="count"></span></label>
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
