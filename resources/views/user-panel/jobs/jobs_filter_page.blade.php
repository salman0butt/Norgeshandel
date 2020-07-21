@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
        @include('user-panel.jobs.jobs_filter_page_inner')
    </main>

    <input type="hidden" id="mega_menu_search_url" value="{{url('jobs/mega_menu_search')}}">
    <input type="hidden" id="back_url" value="{{ url()->current() }}">

    <script>
        var added = false;
        $(document).ready(function () {
            var wto;
            var wto1;
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
               var sort = $(this).val();
                urlParams = new URLSearchParams(location.search);
                urlParams.delete('sort');
                urlParams.delete('lat');
                urlParams.delete('lon');
                urlParams.set('sort', $(this).val());

                var view = urlParams.get('view');
                urlParams.delete('view');

                if(!isEmpty(view)){
                    urlParams.set('view', view);
                }
                var timeout = 0;
                if(sort === '99' && (!cur_lon || !cur_lat)) {
                    get_curr_location();
                    timeout = 1000;

                }
                var newUrl = urlParams.toString();
                clearTimeout(wto1);
                wto1 = setTimeout(function() {
                    if(sort === '99') {
                        newUrl += "&lat=" + cur_lat.toFixed(6);
                        newUrl += "&lon=" + cur_lon.toFixed(6);
                    }

                    search(newUrl);

                    var back_url = $('#back_url').val();
                    history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
                }, timeout);

                // if(sort_val === '99' && (!cur_lon || !cur_lat)) {
                //     get_curr_location(urlParams.toString());
                // }else{
                //     var temp_newUrl = set_lat_lon(urlParams.toString(),sort_val);
                //     search(temp_newUrl);
                // }

                // var back_url = $('#back_url').val();
                //history.replaceState(back_url, 'NorgesHandel', "?" + urlParams.toString());
                // if (!added) {
                //     window.history.replaceState(back_url, 'NorgesHandel', "?" + urlParams.toString());
                //     added = true;
                // } else {
                //     window.history.replaceState(back_url, 'NorgesHandel', "?" + urlParams.toString());
                // }

            });
            $(document).on('click', '#view', function (e) {
                e.preventDefault();
                urlParams = new URLSearchParams(location.search);
                var sort = urlParams.get('sort');
                urlParams.delete('view');
                urlParams.delete('sort');
                urlParams.delete('lat');
                urlParams.delete('lon');
                urlParams.set('view', $(this).attr('data-name'));


                var timeout = 0;
                if(sort === '99' && (!cur_lon || !cur_lat)) {
                    get_curr_location();
                    timeout = 1000;

                }
                var newUrl = urlParams.toString();
                clearTimeout(wto1);
                wto1 = setTimeout(function() {
                    if(sort === '99') {
                        newUrl += "&lat=" + cur_lat.toFixed(6);
                        newUrl += "&lon=" + cur_lon.toFixed(6);
                    }
                    if(!isEmpty(sort)){
                        newUrl += "&sort=" + sort;
                    }

                    search(newUrl);

                    var back_url = $('#back_url').val();
                    history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
                }, timeout);

                /*
                if(!isEmpty(sort) && sort === '99'){
                    get_curr_location(urlParams.toString());
                    return false;
                }else if(!isEmpty(sort)){
                    urlParams.delete('sort');
                    urlParams.set('sort', sort);
                }
                search(urlParams.toString());
                var back_url = $('#back_url').val();

                history.replaceState(back_url, 'NorgesHandel', "?" + urlParams.toString());
                */
                // if (!added) {
                //     window.history.replaceState(back_url, 'NorgesHandel', "?" + urlParams.toString());
                //     added = true;
                // } else {
                //     window.history.replaceState(back_url, 'NorgesHandel', "?" + urlParams.toString());
                // }
            });
            $('.mega-menu input').change(function (e) {
                var id = $(this).attr('id');
                //var newUrl = $('#mega_menu_form').serialize();
                var sort = urlParams.get('sort');
                var timeout = 0;

                if(id === 'radius' || id === 'pac-input'){
                    $('#local_area_name_check').prop( "checked", true );
                    timeout = 1000;
                }

                if(sort === '99' && (!cur_lon || !cur_lat)) {
                    get_curr_location();
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

                    var x = new URLSearchParams(newUrl);
                    if (!isEmpty(view)) {
                        newUrl += "&view=" + view;
                    }
                    if (!isEmpty(sort)) {
                        newUrl += "&sort=" + sort;
                    }
                    if(sort === '99') {
                        newUrl += "&lat=" + cur_lat.toFixed(6);
                        newUrl += "&lon=" + cur_lon.toFixed(6);
                    }

                    newUrl = set_lat_lon(newUrl,sort);
                    search(newUrl);
                    {{--if(!added){--}}
                        {{--history.pushState('{{url('jobs')}}', 'NorgesHandel', "?" + newUrl);--}}
                        {{--added = true;--}}
                    {{--}--}}
                    {{--else{--}}
                        {{--history.replaceState('{{url('jobs')}}', 'NorgesHandel', "?" + newUrl);--}}
                    {{--}--}}

                    var back_url = $('#back_url').val();
                    if (!added) {
                        window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
                        added = true;
                    } else {
                        window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
                    }

                }, timeout);

            });
        });
    </script>
@endsection
