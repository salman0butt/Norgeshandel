

function createDropZone(id, ajax_url) {
    var myDropzone = new Dropzone("#" + id.attr('id'), {
        // autoProcessQueue: false,
        url: ajax_url,
        parallelUploads: 50,
        maxFiles: 50,
        maxFilesize: 500,

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        previewsContainer: "#" + id.attr('id') + " .dropzone-previews",
        acceptedFiles: 'image/*',
        // acceptedFiles: 'video/*,.csv,.xlsx,.xls,image/*,.doc,.docx,.ppt,.pptx,.txt,.pdf,.zip,.rar,.html,.php,.css,.js,.webm,.file',
        dictDefaultMessage: '',
        clickable: "#" + id.attr('id') + " .upload-box",
        paramName: "files",
        uploadMultiple: true,
        addRemoveLinks: true,
        init: function() {
            var myDropzone = this;
            var formElement = "";

            // $(document).on('submit', "#" + id.attr('id'), function(e) {
            // });
            this.on('sendingmultiple', function(file, xhr, formData) {

                // $(':input[type="submit"]').prop('disabled', true);
                // $(':input[type="submit"]').text('Please wait..');

                // formData.append('description[]','hello');
            });
            this.on('successmultiple', function(file, response) {
                response = $.parseJSON(JSON.stringify(response));
                $.each(file , function(key, fil){
                    var fileuploded = fil.previewElement.querySelector("[data-dz-name]");
                    fileuploded.innerHTML = response.file_names[key];
                    var btndelete = fil.previewElement.querySelector("[data-dz-remove]");
                    btndelete.setAttribute("id", response.file_names[key]);
                    if(id.attr('data-append_input') == "yes") {
                        var appendedChild = fil.previewTemplate.appendChild(document.createElement('input'));
                        appendedChild.classList.add("form-control");
                        appendedChild.classList.add("mt-2");
                        appendedChild.setAttribute("name","image_title_"+response.file_names[key]);
                        appendedChild.setAttribute("type","text");
                        appendedChild.setAttribute("placeholder","Tittel");
                        appendedChild.setAttribute("class","form-control dme-form-control mt-2");

                    }

                  });
            });
            this.on("error", function(file, errorMessage) {

                $.each(dropZone.files, function(i, file) {
                    file.status = Dropzone.QUEUED
                });
                $.each(message, function(i, item) {
                    $("#dropzoneErrors .errors ul").append("<li>" + message[i] + "</li>")
                });
            });
            // myDropzone.options.dictRemoveFileConfirmation = "Er du sikker på å slette?";
            this.on("completemultiple", function(file) {
                // myDropzone.removeFile(file);
            });
            this.on("queuecomplete", function(file) {
            });
            this.on("removedfile", function(file) {
                var element = file.previewElement.querySelector("[data-dz-name]");
                var filename = element.innerHTML;
                ws_remove_file(filename);
            });
        }
    });
}


$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".dropzone-previews.sortable").sortable(

        {
        // placeholder: 'dropzone_placeholder',
        // forcePlaceholderSize: true,
        // opacity: 0.6,


        items: ".dz-preview:not(.not-sortable)",
        //disabled: false,
        //axis: 'y',
        //forceHelperSize: true,

        update: function (event, ui) {
            // current element position
            // var Newpos = ui.item.index();
            // alert("You moved item to position " + Newpos);

            var dataArr = [];
            var sortableContainerId = this.id;

            // var childrens = $(this).children('.dz-preview');
            var childrens = $('.dropzone-previews').children('.dz-preview');
            childrens.each(function () {
                var child = $(this);
                var child_id = child.find('.dz-remove').attr('id');
                var child_position = $(this).index() + 1;
                dataArr[$(this).index()] = [child_id, child_position];
            });
            var ad_status = $('.ad_status').val();

            if(ad_status == 'saved'){
                $.ajax({
                    type: 'POST',
                    url: site_url+'/update-media-positions',
                    dataType: "json",
                    data: {"dataArr": JSON.stringify(dataArr)},
                    success: function (response) {
                        if (response.flag == "success") {
                            console.log('success');
                            // $("#image_audition_" + id + "").slideUp().remove();
                        }
                    }
                });
            }else{

                var dataArr = JSON.stringify(dataArr);

                $('form .media_position').val('');
                $('form .media_position').val(dataArr);
            }
            // alert(JSON.stringify(dataArr));
            // console.log(JSON.stringify({dataArr})); //$.parseJSON(JSON.stringify(response));


        }
    }

    ).disableSelection();
});

function ws_remove_file(filename) {
    $.ajax({
        // base_url
        type: "GET",
        // url: ajax_url+'/projects/delete-media-dz?filename='+filename,
        url: site_url+'/delete-media-dz?filename='+filename, // +'&folder_name='+folder_name
        dataType :"json",
        success:function(data) {
            if(data.file_name){
                delete_media(data.file_name);
            }
        }
    });
}

function delete_media(filename){
    var ad_status = $('.ad_status').val();
    if(ad_status == 'saved'){
        ws_remove_file(filename);
    }else{
        var delete_media = $('.deleted_media').val();
        var dataArr = [];
        if(delete_media){
            delete_media = JSON.parse(delete_media);
            if(delete_media){
                dataArr[0] = [filename];
                $.each(delete_media, function (index, value) {
                    dataArr[index+1] = [value];
                });
            }
        }else{
            dataArr[0] = [filename]; //JSON.stringify(filename);
        }
        $('.deleted_media').val(JSON.stringify(dataArr));
    }
}

$(document).on('click', '.dz-remove', function (e) {
    /*
    var this_var = $(this);
    e.preventDefault();

    swal({
        title: "Bekreftelse",
        text: "Er du sikker på å slette denne filen?",
        icon: "warning",
        buttons: [
            'Nei, avbryt det!',
            'Ja jeg er sikker!'
        ],
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {
            (this_var).parents('.dz-preview').fadeOut();
            (this_var).parents('.show-file-section').fadeOut();
            filename = (this_var).attr('id');
            e.preventDefault();
            ws_remove_file(filename);
        }
    });
    */
    var ad_status = $('.ad_status').val();

    // if (confirm("Er du sikker på å slette?") == true) {
    e.preventDefault();
    filename = $(this).attr('id');
    delete_media(filename);
    e.preventDefault();

    // if(!$(this).parents('.dz-preview')){
    //     ws_remove_file(filename);
    // }
    $(this).parents('.dz-preview').fadeOut();
    $(this).parents('.show-file-section').fadeOut();
    // }


});

$(document).ready(function() {
    Dropzone.autoDiscover = false;
    $('form.addMorePics').each(function(index, item) {
        var ajax_url = $(this).data('action');
        createDropZone($("#" + this.id), ajax_url);
    });
});


$(document).ready(function() {
});