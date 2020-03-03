 var added = false;
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
         if (!isEmpty(sort)) {
             newUrl += "&sort=" + sort;
         }
         if (!isEmpty(view)) {
             newUrl += "&view=" + view;
         }
         if (!isEmpty(page)) {
             newUrl += "&page=" + page;
         }
         // history.pushState('data', 'NorgesHandel', "?" + newUrl);
         search(newUrl);
         // fix_page_links();
         var back_url = $('#back_url').val();
         if (!added) {
             history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
             added = true;
         } else {
             history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
         }
     });
     $(window).on('popstate', function (e) {
         window.location.href = window.location.href.split("?")[0];
     });
 });