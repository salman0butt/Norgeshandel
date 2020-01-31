function isEmpty(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

function getDataPagination(page,sorting_value,url,stylings)
{

    var url = url;
    $.ajax(
    {
        url: '?page=' + page+'&filter='+sorting_value+'&style='+stylings,
        type: "get",
        datatype: "html"
    }).done(function(data){
        
        $(".pagination_data").empty().html(data);
        location.hash = page;

    }).fail(function(jqXHR, ajaxOptions, thrownError){
        alert('No response from server');
    });
  
}

function getNotifications(url)
{
    $.ajax(
        {
            url: url,
            type: "post",
            dataType: "json",
        }).done(function(data){
            if(data.count > 0)
            {
                // $("#notification_count_pro").show();
                $("#notification_count_pro").html(data.count);
                $("#notifications").html(data.html);
            }
            else
            {
                // $("#notification_count_pro").hide();
            }
          
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
}
