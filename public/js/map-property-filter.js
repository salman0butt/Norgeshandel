var added = false;
$(document).ready(function () {
    var urlParams = new URLSearchParams(location.search);

    function search(data) {
        var urlParams = new URLSearchParams(location.search);
        var url = $('#mega_menu_search_url').val();
        $.ajax({
            data: data,
            url: url,
            type: "GET",
            success: function (response) {
                initMap(response.data);
            },
            error: function (error) {
                //console.log(error);
            }
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

    $('.mega-menu input').change(function (e) {
        var newUrl = $('#mega_menu_form').serialize();


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

        if (page != '') {
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


});
