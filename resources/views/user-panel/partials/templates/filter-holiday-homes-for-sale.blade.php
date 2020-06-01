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
                        <div class="form-group nav-dynamic-checks ">
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
                                    <input type="text" class="dme-form-control" name="total_price_from" value="{{Request()->total_price_from}}">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="total_price_to" value="{{Request()->total_price_to}}">
                                    <span class="u-t5">Til kr</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="total_price_btn" class="dme-btn-outlined-blue float-right">Søk</button>
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
                    </div>
                    <div style="border-right:1px solid #ddd;" class="col-md-3">
                        <div class="form-group nav-dynamic-checks mt-4">
                            <h3 class="u-t5">Område</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'states_and_cities')->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms());
                            }
                            ?>
                        </div>

                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Beliggenhet</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="location[]" value="Innlandet" id="location-1" {{Request()->location ? is_numeric(array_search('Innlandet', Request()->location)) ? "checked" : "" : ''}}>
                                        <label for="location-1">Innlandet</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="location[]" value="På fjellet" id="location-2" {{Request()->location ? is_numeric(array_search('På fjellet', Request()->location)) ? "checked" : "" : ''}}>
                                        <label for="location-2">På fjellet</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="location[]" value="Ved sjøen" id="location-3" {{Request()->location ? is_numeric(array_search('Ved sjøen', Request()->location)) ? "checked" : "" : ''}}>
                                        <label for="location-3">Ved sjøen</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Tomt</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="owned_site" value="true" id="owned_site" {{Request()->owned_site && Request()->owned_site == 'true' ? 'checked' : ''}}>
                                        <label for="owned_site">Selveiet</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div style="border-right:1px solid #ddd;" class="col-md-3">
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Fasiliteter</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'hhfs_facilities')->get()->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms(),Request()->hhfs_facilities);
                            }
                            ?>
                        </div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Boligtype</h3>
                            <?php
                            if (!empty($tax = App\Taxonomy::where('slug', 'hhfs_property_type')->get()->first())) {
                                echo App\Helpers\common::map_nav($tax->parent_terms(),Request()->hhfs_property_type);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5">Visningsdato</h3>
                            <ul class="list-unstyled">
                                @for($i=0; $i<30; $i++)
                                    <li>
                                        <div class="input-toggle">
                                            <input type="checkbox" name="display_date[]" value="{{now()->addDays($i)->toDateString()}}" id="navdisplaydate-{{$i}}" {{Request()->display_date ? is_numeric(array_search(now()->addDays($i)->toDateString(), Request()->display_date)) ? "checked" : "" : ''}}>
                                            <label for="navdisplaydate-{{$i}}" class="">{{now()->addDays($i)->isoFormat("dddd DD. MMMM")}} <span data-name="{{now()->addDays($i)->toDateString()}}" data-title="display_name" class="count"></span></label>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</li>
