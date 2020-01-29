@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
{{--        @include('user-panel.jobs.jobs_filter_page_inner')--}}
    </main>
    <input type="hidden" id="mega_menu_search_url" value="{{url('jobs/mega_menu_search')}}">
    <script>
        function search(data){
            var urlParams = new URLSearchParams(location.search);
            var url = $('#mega_menu_search_url').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                data:data,
                url: url,
                type: "GET",
                success: function (response) {
                    $('#dme-wrapper').html(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        $(document).ready(function () {
            var urlParams = new URLSearchParams(location.search);
            var type=urlParams.get('job_type');
            if (isEmpty(type)){
                $('.job-type').text("Alle stilling");
            }
            search(urlParams.toString());
            $(document).on('change', '#sort', function () {
                urlParams = new URLSearchParams(location.search);
                urlParams.delete('sort');
                urlParams.set('sort', $(this).val());
                console.log(urlParams.toString());
                search(urlParams.toString());
                history.pushState('', 'NorgesHandel', "?"+urlParams.toString());
            });
            $(document).on('click', '#view', function (e) {
                e.preventDefault();
                urlParams = new URLSearchParams(location.search);
                urlParams.delete('view');
                urlParams.set('view', $(this).attr('data-name'));
                search(urlParams.toString());
                history.pushState('', 'NorgesHandel', "?"+urlParams.toString());
            });
            $('.mega-menu input').change(function (e) {
                var newUrl = $('#mega_menu_form').serialize();
                urlParams = new URLSearchParams(location.search);
                var view = urlParams.get('view');
                var sort = urlParams.get('sort');
                console.log(newUrl);
                var x = new URLSearchParams(newUrl);
                if(!isEmpty(view)){
                    newUrl+= "&view="+view;
                }
                if(!isEmpty(sort)){
                    newUrl+= "&sort="+sort;
                }

                search(newUrl);
                history.pushState('data', 'NorgesHandel', "?"+newUrl);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var value = $('#recent-search').val();
            var url = "{{url('/recentearches')}}";
            $.ajax({
                url: url + '/' + value,
                type: "POST",
                success: function (response) {
                    // console.log(response);
                },
                error: function (error) {
                    // console.log(error);
                }
            });


            var job_type = urlParams.get('job_type');
            var view = urlParams.get('view');
            var page = urlParams.get('page');
            var str = "";
            var val = "";
            // $.each($('.pagination .page-link'), function () {
            //
            //     alert('');
            //     val = $(this).attr('href');
            //     str = val;
            //     if (job_type != null && str.indexOf('job_type') < 1) {
            //         str += "&job_type=" + job_type
            //     }
            //     if (view != null && str.indexOf('view') < 1) {
            //         str += "&view=" + view
            //     }
            //     if (page != null && str.indexOf('page') < 1) {
            //         str += "&page=" + page
            //     }
            //     $(this).attr('href', str);
            // });
        });

    </script>
@endsection
