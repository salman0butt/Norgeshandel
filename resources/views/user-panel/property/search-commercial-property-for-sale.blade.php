@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrepper" id="dme-wrapper">
        @include('user-panel.property.search-property-for-sale-inner')
    </main>
    <input type="hidden" id="mega_menu_search_url" value="{{url('property/property-for-sale/search')}}">

    <script>
        $(document).ready(function () {
            search(urlParams.toString());
            fix_page_links();

            $('.mega-menu input').change(function (e) {
                var newUrl = $('#mega_menu_form').serialize();
                urlParams = new URLSearchParams(location.search);
                var view = urlParams.get('view');
                var sort = urlParams.get('sort');
                if (!isEmpty(view)) {
                    newUrl += "&view=" + view;
                }
                if (!isEmpty(sort)) {
                    newUrl += "&sort=" + sort;
                }

                history.pushState('data', 'NorgesHandel', "?" + newUrl);
                search(newUrl);
                // fix_page_links();
            });

            $(document).on('change', '#sort_by', function () {
                var newUrl = $('#mega_menu_form').serialize();
                var sort = $(this).val();
                var view = urlParams.get('view');
                var page = urlParams.get('page');
                if(!isEmpty(sort)){
                    newUrl+="&sort="+sort;
                }
                if(!isEmpty(view)){
                    newUrl+="&view="+view;
                }
                if(!isEmpty(page)){
                    newUrl+="&page="+page;
                }
                history.pushState('data', 'NorgesHandel', "?" + newUrl);
                search(newUrl);
                // fix_page_links();
            });
        });
    </script>


@endsection
