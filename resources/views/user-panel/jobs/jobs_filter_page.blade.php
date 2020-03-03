@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
        @include('user-panel.jobs.jobs_filter_page_inner')
    </main>
    <input type="hidden" id="mega_menu_search_url" value="{{url('jobs/mega_menu_search')}}">
    <script>
        var added = false;
        $(document).ready(function () {
            $(window).on('popstate', function(e) {
                window.location.href =  window.location.href.split("?")[0];
            });

            var urlParams = new URLSearchParams(location.search);
            var type = urlParams.get('job_type');
            if (isEmpty(type)) {
                $('.job-type').text("Alle stilling");
            }
            search(urlParams.toString());
            $(document).on('change', '#sort', function () {
                urlParams = new URLSearchParams(location.search);
                urlParams.delete('sort');
                urlParams.set('sort', $(this).val());
                console.log(urlParams.toString());
                search(urlParams.toString());
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

                search(newUrl);
                if(!added){
                    history.pushState('{{url('jobs')}}', 'NorgesHandel', "?" + newUrl);
                    added = true;
                }
                else{
                    history.replaceState('{{url('jobs')}}', 'NorgesHandel', "?" + newUrl);
                    }
            });

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
            }
        });

    </script>
@endsection
