@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
        @include('user-panel.jobs.jobs_filter_page_inner')
    </main>

    <input type="hidden" id="mega_menu_search_url" value="{{url('jobs/mega_menu_search')}}">
    <script>
        var added = false;

        var cur_lat = '';
        var cur_lon = '';

        function get_curr_location(newUrl=''){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    cur_lat = position.coords.latitude;
                    cur_lon = position.coords.longitude;

                    if(newUrl){
                        newUrl = set_lat_lon(newUrl,'4');
                        search(newUrl);
                    }
                }, function() {
                    alert('Du fant ikke nærmeste annonser fordi vi ikke får tilgang til posisjonen din. Fjern blokkeringen av siden vår fra nettleserinnstillingene dine og prøv igjen. Takk');
                });
            }
        }

        function set_lat_lon(newUrl,sort){
            if(sort === '4' && cur_lat && cur_lon){
                newUrl += "&lat=" + cur_lat.toFixed(6);
                newUrl += "&lon=" + cur_lon.toFixed(6);
            }
            return newUrl;
        }

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


                if(sort_val === '4' && (!cur_lon || !cur_lat)) {
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
            $('.mega-menu input').change(function (e) {
                var newUrl = $('#mega_menu_form').serialize();
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
            });


        /*
            var strsearch = urlParams;
            strsearch.delete('page');
            var value = strsearch.toString();
            var job_type = strsearch.get('job_type');
            if(!isEmpty(job_type)) {
                if (!isEmpty(value)) {
                    var url = "{{url('/recentearches')}}";

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url + '/' + value + '/' + urlParams.get('search') + '/job',
                        type: "POST",
                        success: function (response) {
                            // console.log(response);
                        },
                        error: function (error) {
                            // console.log(error);
                        }
                    });
                }
            }*/
        });
    </script>
@endsection
