var added = false;

var cur_lat = 0;
var cur_lon = 0;

function get_curr_location(newUrl=''){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            cur_lat = position.coords.latitude;
            cur_lon = position.coords.longitude;
            if(newUrl){
                newUrl = set_lat_lon(newUrl,'99');
                search(newUrl);
            }
        }, function() {
            alert('Du fant ikke nærmeste annonser fordi vi ikke får tilgang til posisjonen din. Fjern blokkeringen av siden vår fra nettleserinnstillingene dine og prøv igjen. Takk');
        });
    }
}


function set_lat_lon(newUrl,sort){
    if(sort === '99' && cur_lat && cur_lon){
        newUrl += "&lat=" + cur_lat.toFixed(6);
        newUrl += "&lon=" + cur_lon.toFixed(6);
    }

    return newUrl;
}


$(document).ready(function () {
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
        newUrl = set_lat_lon(newUrl,sort);
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
        newUrl = set_lat_lon(newUrl,sort);
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
        // newUrl = set_lat_lon(newUrl,sort);

        if(sort === '99' && (!cur_lon || !cur_lat)) {
            get_curr_location(newUrl);
        }else{
            newUrl = set_lat_lon(newUrl,sort);
            search(newUrl);
        }


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
        newUrl = set_lat_lon(newUrl,sort);
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

