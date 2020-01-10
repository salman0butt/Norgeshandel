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