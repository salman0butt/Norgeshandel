<li class="nav-item filter-btn">
    <a class="nav-link mega-menu-button" href="#">
        <span class="fas fa-sliders-h float-left mt-2 color-maroon fa-times" style="font-size: 1.5em;"></span>
        <div class="mt-2 ml-2">Filtrer</div>
    </a>
    <div class="mega-menu smart-scroll" style="display: block;">
        <div class="container-fluid text-left">
            <form action="" id="mega_menu_form">
                <div class="row">
                    <div style="border-right:1px solid #ddd;" class="col-md-4">
                        <div class="form-group nav-dynamic-checks">
                            <label for="search" class="mb-1 font-weight-bold">Søk i Eiendom</label>
                            <div class="input-group search-box">
                                <input type="text" id="search" name="search" class="dme-form-control search-control"
                                       placeholder="">
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
                            <div style="text-align: right">
                                <img class="mt-2" src="http://digitalmedieexpert.no/NorgesHandel/assets/images/minimap.PNG"
                                     width="89%" alt="">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group nav-dynamic-checks">
                            <h3 class="u-t5 mt-3">Pris</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="price_from">
                                    <span class="u-t5">Fra kr</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control" name="price_to">
                                    <span class="u-t5">Til kr</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="asking_price_btn" class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h3 class="u-t5">Størrelse</h3>
                            <div class="row">
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control">
                                    <span class="u-t5">Fra m²</span>
                                </div>
                                <div class="col-sm-4 pr-md-0">
                                    <input type="text" class="dme-form-control">
                                    <span class="u-t5">Fra m²</span>
                                </div>
                                <div class="col-sm-4">
                                    <button class="dme-btn-outlined-blue float-right">Søk</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="border-right:1px solid #ddd;" class="col-md-4">
                        <div class="form-group nav-dynamic-checks mt-4">
                            <h3 class="u-t5">Område</h3>
                            <?php
                            $tax = App\Taxonomy::where('slug', 'country')->first();
                            if (!empty($tax)){
                                $norg = $tax->terms->where('slug', '=', 'norge');
                                if (!empty($norg)){
                                    echo App\Helpers\common::map_nav($tax->parent_terms($norg->first()->id));
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="u-mt32 form-group">
                            <h3 class="u-t5">Type lokale</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="10" id="property_type-10">
                                        <label for="property_type-10" class=""><span>Butikk/Handel <span class="u-stone"
                                                                                                         id="count-property_type-10">(147)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="20" id="property_type-20">
                                        <label for="property_type-20" class=""><span>Bygård/Flermannsbolig <span
                                                    class="u-stone"
                                                    id="count-property_type-20">(42)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="6" id="property_type-6">
                                        <label for="property_type-6" class=""><span>Garasje/Parkering <span
                                                    class="u-stone"
                                                    id="count-property_type-6">(50)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="11" id="property_type-11">
                                        <label for="property_type-11" class=""><span>Gårdsbruk/Småbruk <span
                                                    class="u-stone"
                                                    id="count-property_type-11">(43)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="8" id="property_type-8">
                                        <label for="property_type-8" class=""><span>Hotell/Overnatting <span
                                                    class="u-stone"
                                                    id="count-property_type-8">(24)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="22" id="property_type-22">
                                        <label for="property_type-22" class=""><span>Kjøpesenter <span class="u-stone"
                                                                                                       id="count-property_type-22">(15)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="19" id="property_type-19">
                                        <label for="property_type-19" class=""><span>Kombinasjonslokaler <span
                                                    class="u-stone"
                                                    id="count-property_type-19">(157)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="5" id="property_type-5">
                                        <label for="property_type-5" class=""><span>Kontor <span class="u-stone"
                                                                                                 id="count-property_type-5">(188)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="7" id="property_type-7">
                                        <label for="property_type-7" class=""><span>Lager/Logistikk <span
                                                    class="u-stone"
                                                    id="count-property_type-7">(107)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="9" id="property_type-9">
                                        <label for="property_type-9" class=""><span>Produksjon/Industri <span
                                                    class="u-stone"
                                                    id="count-property_type-9">(129)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="24" id="property_type-24">
                                        <label for="property_type-24" class=""><span>Prosjekt <span class="u-stone"
                                                                                                    id="count-property_type-24">(1)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="23" id="property_type-23">
                                        <label for="property_type-23" class=""><span>Serveringslokale/Kantine <span
                                                    class="u-stone"
                                                    id="count-property_type-23">(28)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="28" id="property_type-28">
                                        <label for="property_type-28" class=""><span>Undervisning/Arrangement <span
                                                    class="u-stone"
                                                    id="count-property_type-28">(27)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="26" id="property_type-26">
                                        <label for="property_type-26" class=""><span>Verksted <span class="u-stone"
                                                                                                    id="count-property_type-26">(56)</span></span></label>
                                    </div>
                                </li>

                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="property_type" value="18" id="property_type-18">
                                        <label for="property_type-18" class=""><span>Andre <span class="u-stone"
                                                                                                 id="count-property_type-18">(85)</span></span></label>
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
