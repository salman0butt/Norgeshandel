@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
{{--        @include('user-panel.jobs.jobs_filter_page_inner')--}}
    </main>
    <input type="hidden" id="mega_menu_search_url" value="{{url('jobs/mega_menu_search')}}">
    <script>
        function search(data){
            var urlParams = new URLSearchParams(location.search);
            var view = urlParams.get('view');
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
            search(urlParams.toString());
            $('.mega-menu input').change(function (e) {
                var newUrl = $('#mega_menu_form').serialize();
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
            $.each($('.pagination .page-link'), function () {
                val = $(this).attr('href');
                str = val;
                if (job_type != null && str.indexOf('job_type') < 1) {
                    str += "&job_type=" + job_type
                }
                if (view != null && str.indexOf('view') < 1) {
                    str += "&view=" + view
                }
                if (page != null && str.indexOf('page') < 1) {
                    str += "&page=" + page
                }
                $(this).attr('href', str);
            });
            str = "";
            $.each($('.change_view'), function () {
                val = $(this).attr('href');
                str = val;
                if (job_type != null && str.indexOf('job_type') < 1) {
                    str += "&job_type=" + job_type
                }
                if (view != null && str.indexOf('view') < 1) {
                    str += "&view=" + view
                }
                if (page != null && str.indexOf('page') < 1) {
                    str += "&page=" + page
                }
                $(this).attr('href', str);
            });
        })

    </script>
@endsection
