<li class="nav-item filter-btn">
    <a class="nav-link mega-menu-button" id="mega-menu-button" href="#">
        <span class="fas fa-sliders-h float-left mt-2 color-maroon" style="font-size: 1.5em;"></span>
        <div class="mt-2 ml-2">Filtrer</div>
    </a>
    <div class="mega-menu smart-scroll" style="">
        <div class="container-fluid text-left">
            <form action="" id="mega_menu_form">
                <div class="row">
                    <div style="border-right:1px solid #ddd;" class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="search" class="mb-1 font-weight-bold">Søk i Jobb</label>
                            <div class="input-group search-box">
                                <input type="text" id="search" name="search" class="dme-form-control search-control"
                                       placeholder="">
                                @if(Request::get('job_type') && !is_array(Request::get('job_type')))
                                    <input type="hidden" name="job_type" value="{{Request::get('job_type') ? Request::get('job_type') : ''}}" >
                                @endif
                                ​
                                <span class="input-group-addon pt-2">
​
                                <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                     height="26" width="26">
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

                        @include('user-panel.partials.templates.ad-map-filter')

                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Stilling</h3>
                            <?php
                            if (!empty($tax = \App\Taxonomy::where('slug', 'job_function')->first())) {
                                echo \App\Helpers\common::map_nav($tax->parent_terms(),Request()->job_function);
                            }
                            ?>
                        </div>
                    </div>
                    <div style="border-right:1px solid #ddd;" class="col-lg-3 col-sm-6 col-12">
                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Bransje</h3>
                            <?php
                            if (!empty($tax = \App\Taxonomy::where('slug', 'industry')->first())) {
                                echo \App\Helpers\common::map_nav($tax->parent_terms(),Request()->industry);
                            }
                            ?>
                        </div>
                    </div>
                    <div style="border-right:1px solid #ddd;" class="col-lg-3 col-sm-6 col-12">
                        <div class="property-filter-area-list">
                            <div class="u-mt32 form-group nav-dynamic-checks">
                                <h3 class="u-t5">Område</h3>
                                <?php
                                if (!empty($tax = \App\Taxonomy::where('slug', 'states_and_cities')->first())) {
                                    echo \App\Helpers\common::map_nav($tax->parent_terms(),Request()->states_and_cities);
                                }
                                ?>
                            </div>
                        </div>
                        ​
                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Ansettelsesform</h3>
                            <?php
                            if (!empty($tax = \App\Taxonomy::where('slug', 'commitment_type')->first())) {
                                echo \App\Helpers\common::map_nav($tax->parent_terms(),Request()->commitment_type);
                            }
                            ?>
                        </div>
                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Søknadsfrist</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="deadline[]" value="today" id="6-450" {{Request()->deadline ? is_numeric(array_search('today', Request()->deadline)) ? "checked" : "" : ''}}>
                                        <label for="6-450" class="">Siste frist <span data-name="Siste frist"
                                                                                      data-title="deadline"
                                                                                      class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="deadline[]" value="this_week" id="6-451" {{Request()->deadline ? is_numeric(array_search('this_week', Request()->deadline)) ? "checked" : "" : ''}}>
                                        <label for="6-451" class="">Under en uke <span data-name="Under en uke"
                                                                                       data-title="deadline"
                                                                                       class="count"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="deadline[]" value="three_days" id="6-452" {{Request()->deadline ? is_numeric(array_search('three_days', Request()->deadline)) ? "checked" : "" : ''}}>
                                        <label for="6-452" class="">Under tre døgn <span data-name="Under tre døgn"
                                                                                         data-title="deadline"
                                                                                         class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @if(\Illuminate\Support\Facades\Request::is('map/select-job'))
                        <input type="hidden" id="mega_menu_search_url" value="{{url('jobs/mega_menu_search')}}">
                        <input class="form-control" type="hidden" name="map" value="map">
        
                    @if(isset(Request()->map_job_type) && Request()->map_job_type)
                        <input type="hidden" name="map_job_type" value="{{Request()->map_job_type}}">
                    @endif
                   @endif

                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        {{-- @if(!Request()->job_type && !Request()->job_type == "management") --}}
                        @if((!Request()->job_type && !Request()->job_type == "management") && !(Request()->map_job_type))
                            <div class="u-mt32 form-group">
                                <h3 class="u-t5">Heltid/deltid</h3>
                                <ul class="list list-unstyled">
                                    <li>
                                        <div class="input-toggle">
                                            <input type="checkbox" name="jobtype[]" value="part_time"
                                                   id="job_type_part_time" {{Request()->jobtype ? is_numeric(array_search('part_time', Request()->jobtype)) ? "checked" : "" : ''}}>
                                            <label for="job_type_part_time">Deltid <span data-name="part_time" data-title="jobtype" class="count"></span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-toggle">
                                            <input type="checkbox" name="jobtype[]" value="full_time"
                                                   id="job_type_full_time" {{Request()->jobtype ? is_numeric(array_search('full_time', Request()->jobtype)) ? "checked" : "" : ''}}>
                                            <label for="job_type_full_time" class="">Heltid <span data-name="full_time" data-title="jobtype" class="count"></span></label>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="input-toggle">
                                            <input type="checkbox" name="jobtype[]" value="management"
                                                   id="job_type_management" {{Request()->jobtype ? is_numeric(array_search('management', Request()->jobtype)) ? "checked" : "" : ''}}>
                                            <label for="job_type_management" class="">Ledelse <span data-name="management" data-title="jobtype" class="count"></span></label>
                                        </div>
                                    </li>
                                    ​
                                </ul>
                            </div>
                        @endif
                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Sektor</h3>
                            <?php
                            if (!empty($tax = \App\Taxonomy::where('slug', 'sector')->first())) {
                                echo \App\Helpers\common::map_nav($tax->parent_terms());
                            }
                            ?>
                        </div>
                        <div class="u-mt32 form-group nav-dynamic-checks">
                            <h3 class="u-t5">Lederkategori</h3>
                            <?php
                            if (!empty($tax = \App\Taxonomy::where('slug', 'leadership_category')->first())) {
                                echo \App\Helpers\common::map_nav($tax->parent_terms());
                            }
                            ?>
                        </div>
                        <div class="u-mt32 form-group">
                            <h3 class="u-t5">Publisert</h3>
                            <ul class="list list-unstyled">
                                <li>
                                    <div class="input-toggle">
                                        <input type="checkbox" name="created_at" value="{{today()->toDateString()}}"
                                               id="published-1">
                                        <label for="published-1" class="">Nye i dag <span data-name="{{today()->toDateString()}}"
                                                                                          data-title="created_at"
                                                                                          class="count"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    ​
                </div>
            </form>
        </div>
    </div>
</li>