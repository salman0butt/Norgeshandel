<li class="nav-item filter-btn">
    <a class="nav-link mega-menu-button" id="mega-menu-button" href="#">
        <span class="fas fa-sliders-h float-left mt-2 color-maroon fa-bars" style="font-size: 1.5em;"></span>
        <div class="mt-2 ml-2">Filtrer</div>
    </a>
    <div class="mega-menu smart-scroll">
        <div class="container-fluid text-left">
            <form action="" id="mega_menu_form">
                <div class="row">
                    <div style="border-right:1px solid #ddd;" class="col-md-6">
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
                         {{-- @if(\Illuminate\Support\Facades\Request::is('map/property')) --}}
                        <input type="hidden" id="mega_menu_search_url" value="{{url('property/flat-wishes-rented/search')}}">
                        <input class="form-control" type="hidden" name="map" value="map">
                   {{-- @endif --}}
                        <div class="clearfix"></div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Pris</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="price_from" value="{{Request()->price_from}}">
                                    <span class="u-t5">Pris Fra</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="price_to" value="{{Request()->price_to}}">
                                    <span class="u-t5">Pris Til</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="size_btn" class="dme-btn-outlined-blue float-right">
                                        Søk
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Ønskes fra</h3>
                            <ul class="list list-unstyled">
                                @for($i=0; $i<8; $i++)
                                    @php $val = now()->addMonths($i)->year; $val1 = now()->addMonths($i)->month<10?'0'.now()->addMonths($i)->month:now()->addMonths($i)->month; $org_val = $val.'-'.$val1; @endphp
                                    <li>
                                        <div class="input-toggle">
                                            <input type="checkbox" name="wanted_from[]" value="{{$org_val}}" id="available_from-{{$i}}"  {{Request()->wanted_from ? is_numeric(array_search($org_val, Request()->wanted_from)) ? "checked" : "" : ''}}>
                                            <label for="available_from-{{$i}}" class="">{{now()->addMonths($i)->monthName}} {{now()->addMonths($i)->year}}<span data-name="Akershus" data-title="available_from" class="count"></span></label>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Boligtype</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'fwr_property_type')->get()->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms(),Request()->fwr_property_type);
                            }
                            ?>
                        </div>
                    </div>

                    <div style="border-right:1px solid #ddd;" class="col-md-6">
                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Antall beboere</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="number_of_tenants[]" value="1" id="number_of_tenants-" {{Request()->number_of_tenants ? is_numeric(array_search(1,Request()->number_of_tenants)) ? "checked" : "" : ""}}>
                                        <label for="number_of_tenants-1"> 1 person<span data-name="1 person" data-title="number_of_tenants" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="number_of_tenants[]" value="2" id="number_of_tenants-" {{Request()->number_of_tenants ? is_numeric(array_search(2,Request()->number_of_tenants)) ? "checked" : "" : ""}}>
                                        <label for="number_of_tenants-2"> 2 personer<span data-name="2 personer" data-title="number_of_tenants" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="number_of_tenants[]" value="3" id="number_of_tenants-" {{Request()->number_of_tenants ? is_numeric(array_search(3,Request()->number_of_tenants)) ? "checked" : "" : ""}}>
                                        <label for="number_of_tenants-3"> 3 personer<span data-name="3 personer" data-title="number_of_tenants" class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="number_of_tenants[]" value="4" id="number_of_tenants-" {{Request()->number_of_tenants ? is_numeric(array_search(4,Request()->number_of_tenants)) ? "checked" : "" : ""}}>
                                        <label for="number_of_tenants-"> 4 eller flere<span data-name="4 eller flere" data-title="number_of_tenants" class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group nav-dynamic-checks mt-4">
                            <h3 class="u-t5">Område</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'states_and_cities')->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms());
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</li>
