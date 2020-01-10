function isEmpty(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

function getDataPagination(page,sorting_value,url)
{
   
    var url = url;
    $.ajax(
    {
        url: '?page=' + page+'&filter='+sorting_value,
        type: "get",
        datatype: "html"
    }).done(function(data){
        
        $(".pagination_data").empty().html(data);
        location.hash = page;

    }).fail(function(jqXHR, ajaxOptions, thrownError){
        alert('No response from server');
    });
  
}