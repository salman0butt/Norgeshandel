var added = false;

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
    var wto;
    var wto1;

    $('.mega-menu input').change(function (e) {
        var id = $(this).attr('id');
        //var newUrl = $('#mega_menu_form').serialize();
        var timeout = 0;

        if(id === 'radius' || id === 'pac-input'){

            $('#local_area_name_check').prop( "checked", true );
            timeout = 1000;
        }
        var sort = getUrlParameter('sort');


        if(sort === '99' && (!cur_lon || !cur_lat)) {
            get_curr_location();
            timeout = 1000;

        }

        if($('#local_area_name_check'). prop("checked") == true){
            $('#mega_menu_form .property-filter-area-list').css('pointer-events','none');
            $('#mega_menu_form .property-filter-area-list ul').css('opacity','0.5');

        }
        else if($('#local_area_name_check'). prop("checked") == false) {
            $('#mega_menu_form .property-filter-area-list').removeAttr('style');
            $('#mega_menu_form .property-filter-area-list ul').css('opacity', '1.0');
        }

        clearTimeout(wto);
        wto = setTimeout(function() {
            var newUrl = remove_variables_from_url();

            var view = getUrlParameter('view');

            var user_id = getUrlParameter('user_id');

            if (!isEmpty(user_id)) {
                newUrl += "&user_id=" + user_id;
            }
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

            // newUrl = set_lat_lon(newUrl,sort);
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
            // do stuff when user has been idle for 1 second
        }, timeout);


    });

    $(document).on('click', 'a.page-link', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var page_param = url.split('=');
        var page = page_param[1];
        var newUrl = remove_variables_from_url();
        // var newUrl = $('#mega_menu_form').serialize();
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
//        newUrl = set_lat_lon(newUrl,sort);
        var timeout = 0;
        if(sort === '99' && (!cur_lon || !cur_lat)) {
            get_curr_location();
            timeout = 1000;

        }
        clearTimeout(wto1);
        wto1 = setTimeout(function() {
            if(sort === '99') {
                newUrl += "&lat=" + cur_lat.toFixed(6);
                newUrl += "&lon=" + cur_lon.toFixed(6);
            }
            search(newUrl);

            var back_url = $('#back_url').val();

            if (!added) {
                window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
                added = true;
            } else {
                window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            }
        }, timeout);

        // search(newUrl);
        // // fix_page_links();
        // var back_url = $('#back_url').val();
        // if (!added) {
        //     window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        //     added = true;
        // } else {
        //     window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        // }
    });


    $(document).on('change', '#sort_by', function () {
        var newUrl = remove_variables_from_url();
        // var newUrl = $('#mega_menu_form').serialize();
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

        var timeout = 0;

        if(sort === '99' && (!cur_lon || !cur_lat)) {
            get_curr_location();
            timeout = 1000;

        }
        clearTimeout(wto1);
        wto1 = setTimeout(function() {
            if(sort === '99') {
                newUrl += "&lat=" + cur_lat.toFixed(6);
                newUrl += "&lon=" + cur_lon.toFixed(6);
                //newUrl = set_lat_lon(newUrl,sort);
            }
            search(newUrl);

            var back_url = $('#back_url').val();

            if (!added) {
                window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
                added = true;
            } else {
                window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            }
        }, timeout);

        // newUrl = set_lat_lon(newUrl,sort);

        // if(sort === '99' && (!cur_lon || !cur_lat)) {
        //     get_curr_location(newUrl);
        // }else{
        //     newUrl = set_lat_lon(newUrl,sort);
        //     search(newUrl);
        // }


        // fix_page_links();

    });
    $(document).on('click', '#view', function (e) {

        e.preventDefault();
        // urlParams = new URLSearchParams(window.location.search)
        // console.log(urlParams);
        var newUrl = remove_variables_from_url();
        // var newUrl = $('#mega_menu_form').serialize();

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
        var timeout = 0;
        if(sort === '99' && (!cur_lon || !cur_lat)) {
            get_curr_location();
            timeout = 1000;

        }
        clearTimeout(wto1);
        wto1 = setTimeout(function() {
            if(sort === '99') {
                newUrl += "&lat=" + cur_lat.toFixed(6);
                newUrl += "&lon=" + cur_lon.toFixed(6);
            }
            search(newUrl);

            var back_url = $('#back_url').val();
            if (!added) {
                window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
                added = true;
            } else {
                window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            }
        }, timeout);


        //newUrl = set_lat_lon(newUrl,sort);
        // history.pushState('data', 'NorgesHandel', "?" + newUrl);
        //search(newUrl);
        // fix_page_links();
        // var back_url = $('#back_url').val();
        // if (!added) {
        //     window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        //     added = true;
        // } else {
        //     window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        // }
    });

    // $(window).on('popstate', function (e) {
    //     window.location.href = window.location.href.split("?")[0];
    // });

});