var added = false;
$(document).ready(function () {
    var urlParams = new URLSearchParams(location.search);
    //   $('a.row').on('click', function (e) {
    //       e.preventDefault();
    //       alert('working');
    //       history.pushState({}, null, '');
    //   });
    function search(data) {
        var urlParams = new URLSearchParams(location.search);
        var url = $('#mega_menu_search_url').val();
        $.ajax({
            data: data,
            url: url,
            type: "GET",
            success: function (response) {
                if (!isEmpty($("#basicExampleModal.show"))) {
                    $('#dme-wrapper').html(response);
                }
            },
            error: function (error) {
                //console.log(error);
            }
        });
    }
    function fix_page_links() {
        $('.pagination a').each(function (i) {
            var par = urlParams;
            par.delete('page');
            var page_arr = $(this).attr('href').split('=');
            par.set('page', page_arr[1]);
            $(this).attr('href', "?" + par.toString());
        });
    }
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    search(urlParams.toString());
    fix_page_links();

    $('.mega-menu input').change(function (e) {
        var newUrl = $('#mega_menu_form').serialize();

        var view = getUrlParameter('view');
        var sort = getUrlParameter('sort');
        var user_id = getUrlParameter('user_id');
        // console.log(user_id);
        // console.log(parseInt(user_id));
        if (!isEmpty(user_id)) {
            newUrl += "&user_id=" + user_id;
        }
        if (!isEmpty(view)) {
            newUrl += "&view=" + view;
        }
        if (!isEmpty(sort)) {
            newUrl += "&sort=" + sort;
        }
        // history.pushState('data', 'NorgesHandel', "?" + newUrl);
        search(newUrl);
        // fix_page_links();
        var back_url = $('#back_url').val();
        if (!added) {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            added = true;
        } else {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        }
        // fix_page_links();
    });

    $(document).on('click', 'a.page-link', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var page_param = url.split('=');
        var page = page_param[1];
        var newUrl = $('#mega_menu_form').serialize();
        var sort = getUrlParameter('sort');
        var view = getUrlParameter('view');
        var user_id = getUrlParameter('user_id');
        if (parseInt(user_id)>0) {
            newUrl += "&user_id=" + user_id;
        }
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
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            added = true;
        } else {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        }
    });
    $(document).on('change', '#sort_by', function () {
        var newUrl = $('#mega_menu_form').serialize();
        var sort = $(this).val();
        var view = getUrlParameter('view');
        var page = getUrlParameter('page');
        var user_id = getUrlParameter('user_id');
        if (parseInt(user_id)>0) {
            newUrl += "&user_id=" + user_id;
        }
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
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            added = true;
        } else {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        }
    });
    $(document).on('click', '#view', function (e) {

        e.preventDefault();
        // urlParams = new URLSearchParams(window.location.search)
        // console.log(urlParams);
        var newUrl = $('#mega_menu_form').serialize();

        var sort = getUrlParameter('sort');
        var view = $(this).attr('data-view');
        var page = getUrlParameter('page');
        var user_id = getUrlParameter('user_id');
        if (!isEmpty(user_id)) {
            newUrl += "&user_id=" + user_id;
        }

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
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            added = true;
        } else {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        }
    });
    // $(window).on('popstate', function (e) {
    //     window.location.href = window.location.href.split("?")[0];
    // });

});

