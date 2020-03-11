function isEmpty(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

function getDataPagination(page, sorting_value, url, stylings) {
    var url = url;
    $.ajax(
        {
            url: '?page=' + page + '&filter=' + sorting_value + '&style=' + stylings,
            type: "get",
            datatype: "html"
        }).done(function (data) {

        $(".pagination_data").empty().html(data);
        location.hash = page;

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        console.log('No response from server');
    });
}

function getNotifications(url) {
    $.ajax(
        {
            url: url,
            type: "get",
            dataType: "json",
        }).done(function (count) {
        return count;
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        console.log('No response from server');
        return 0;
    });
}
function getAjax(url) {
    $.ajax(
        {
            url: url,
            type: "get",
            async:false,
            dataType: "json",
            success:function (response) {
                return response;
            }
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
        console.log('No response from server');
        return 0;
    });
}
