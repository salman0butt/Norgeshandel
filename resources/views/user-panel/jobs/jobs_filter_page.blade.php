@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
        @include('user-panel.jobs.jobs_filter_page_inner')
    </main>

    <input type="hidden" id="mega_menu_search_url" value="{{url('jobs/mega_menu_search')}}">

    <script>
        var added = false;
        $(document).ready(function () {
            //get_curr_location();
            // $(window).on('popstate', function(e) {
            //     window.location.href =  window.location.href.split("?")[0];
            // });

            var urlParams = new URLSearchParams(location.search);
            var type = urlParams.get('job_type');
            if (isEmpty(type)) {
                $('.job-type').text("Alle stilling");
            }
            @if(!Request::is('jobs/company/*/ads'))
                search(urlParams.toString());
            @endif
            $(document).on('change', '#sort', function () {
               var sort_val = $(this).val();
                urlParams = new URLSearchParams(location.search);
                urlParams.delete('sort');
                urlParams.delete('lat');
                urlParams.delete('lon');
                urlParams.set('sort', $(this).val());


                if(sort_val === '99' && (!cur_lon || !cur_lat)) {
                    get_curr_location(urlParams.toString());
                }else{
                    var temp_newUrl = set_lat_lon(urlParams.toString(),sort_val);
                    search(temp_newUrl);
                }

                history.pushState('', 'NorgesHandel', "?" + urlParams.toString());
            });
            $(document).on('click', '#view', function (e) {
                e.preventDefault();
                urlParams = new URLSearchParams(location.search);
                urlParams.delete('view');
                urlParams.set('view', $(this).attr('data-name'));
                search(urlParams.toString());
                history.pushState('', 'NorgesHandel', "?" + urlParams.toString());
            });
            var wto;
            $('.mega-menu input').change(function (e) {
                var id = $(this).attr('id');
                //var newUrl = $('#mega_menu_form').serialize();

                var timeout = 0;

                if(id === 'radius' || id === 'pac-input'){
                    $('#local_area_name_check').prop( "checked", true );
                    timeout = 1000;
                }

                if($('#local_area_name_check'). prop("checked") == true){
                    $('#mega_menu_form .property-filter-area-list').css('pointer-events','none');
                    $('#mega_menu_form .property-filter-area-list ul').css('opacity','0.5');

                }
                else if($('#local_area_name_check'). prop("checked") == false){
                    $('#mega_menu_form .property-filter-area-list').removeAttr('style');
                    $('#mega_menu_form .property-filter-area-list ul').css('opacity','1.0');
                }

                clearTimeout(wto);
                wto = setTimeout(function() {
                    var newUrl = remove_variables_from_url();
                    // var newUrl = $('#mega_menu_form').serialize();
                    urlParams = new URLSearchParams(location.search);
                    var view = urlParams.get('view');
                    var sort = urlParams.get('sort');

                    var x = new URLSearchParams(newUrl);
                    if (!isEmpty(view)) {
                        newUrl += "&view=" + view;
                    }
                    if (!isEmpty(sort)) {
                        newUrl += "&sort=" + sort;
                    }
                    newUrl = set_lat_lon(newUrl,sort);
                    search(newUrl);
                    if(!added){
                        history.pushState('{{url('jobs')}}', 'NorgesHandel', "?" + newUrl);
                        added = true;
                    }
                    else{
                        history.replaceState('{{url('jobs')}}', 'NorgesHandel', "?" + newUrl);
                    }
                }, timeout);

            });
        });
    </script>
@endsection
