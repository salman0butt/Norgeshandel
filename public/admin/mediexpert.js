function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#profile_image').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


$(document).ready(function (e) {
    //ACtive and dective the record
//Change the status
    $('.status').click(function () {
        var id = ($(this).attr('id'));
        id = id.replace(/\D/g,'');
        if ($(this).is(":checked")) {
            var status = 1;
        }
        else{
            var status = 0;
        }
        var action = $(this).data('ajaxurl');
        var model = $(this).data('class');
        var column = $(this).data('column');
        if(action){
            $.ajax({
                url: action,
                type:'GET',
                data: {'id':id,'status':status,'model_class':model,'column':column},
                dataType:'json',
                success: function (data) {
                    location.reload();
                },
                error: function (jqXhr, json, errorThrown) {
                    alert('noe gikk galt');
                },
            });
        }
    });
});