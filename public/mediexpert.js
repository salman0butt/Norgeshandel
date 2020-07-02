function formate_date(date) {
    var str_date = "";
    var day = date.getDate();
    var mon = date.getMonth()+1;
    var year = date.getFullYear();
    str_date = day<10?"0"+day:day;
    str_date += mon<10?".0"+mon:"."+mon;
    str_date += "."+year;
    return str_date;
}
function notify(type,msg) {

    Command: toastr[type](msg)
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "12000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

}

function readFileURL(input, img) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(img).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
function dme_nav_collapse(){
    $.each($('.nav-dynamic-checks'), function (index) {
        var should_visible = true;
        if($(this).find('>ul>li').length>12){
            $.each($(this).find('>ul>li'), function(x,this_obj){
                if($(this).index() > 12){
                    if(!$(this).find("input[type='checkbox']").attr("checked")){
                        $(this).slideUp();
                        should_visible = false;
                    }
                }
            });
        }
        if(!should_visible){
            $(this).find('.shrink').remove();
            $(this).find('.expand').remove();
            $(this).append('<a href="#" class="dynamic-check-view-all expand">Vis alle</a>');
        }
    });
}

function get_checked_agent_count(form_id) {
    var rTotal = 0;
    var selectedagent = document.forms[form_id]["agent_id[]"];

    for (var sel = 0; sel < selectedagent.length; sel++) {
        if (selectedagent[sel].checked)
            rTotal++;
    }
    if(rTotal > 3){
        return false;
    }
    return true;
}

$(document).ready(function (e) {

    var ad_agent_click = 0;
    $(document).on('click', '.add-ad-agent', function(e) {
        if($('.append-agent-section .remove').length < 3){
            ++ad_agent_click;
            $('.append-agent').clone().appendTo('.append-agent-section');

            $('.append-agent-section .append-agent').addClass('single remove');
            $('.append-agent-section .append-agent').removeClass('d-none');

            $('.append-agent input[name="agent_key[]"]').val(ad_agent_click);
            $('.append-agent').attr('id','agent_section_'+ad_agent_click);

            $('.append-agent-section .append-agent').removeClass('append-agent');
            $('.append-agent > .single').attr("class", "remove");



        }else{
            alert('Du kan legge til maksimalt 3 agenter igjen en annonse.');
        }
    });

    $(document).on('click', '.remove-agent-button', function(e) {
        $(this).closest(".remove").remove();
        var ad_status = $('.ad_status').val();
        if(ad_status == 'saved'){
            record_store_ajax_request('change',(this));
        }
        e.preventDefault();
    });

    dme_nav_collapse();
    $('.show-sub .list-unstyled .list-unstyled:first').css('display', 'block');
    $(document).on('click', '.dynamic-check-view-all.expand', function (e) {
        e.preventDefault();
        $(this).parent().find('>ul>li').slideDown();
        $(this).parent().append('<a href="#" class="dynamic-check-view-all shrink">Vis mindre</a>');
        $(this).remove();
        // $(this).html('Vis mindre');
        // $(this).removeClass('expand');
        // $(this).addClass('shrink');
    });
    $(document).on('click', '.dynamic-check-view-all.shrink', function (e) {
        dme_nav_collapse();
    });
    $('.dme-collapse-nav input[type=checkbox], .mega-menu input[type=checkbox]').click(function (e) {
        if($(this).prop("checked") == true) {
            if ($(this).parent().next().length > 0) {
                if ($(this).parent().next()[0].tagName == 'UL') {
                    $(this).parent().next().slideDown();
                }
            }
        }
        else{
            if ($(this).parent().next().length > 0) {
                if ($(this).parent().next()[0].tagName == 'UL') {
                    $(this).parent().next().slideUp();
                    $(this).parent().next().find('input[type=checkbox]').prop("checked", false);
                }
            }
        }
    });
    // $('.mega-menu').slideDown();

    var isDown = false;
    var isOpen = false;

   // $('.mega-menu-button').click(function (e) {
    $(document).on('click', '.mega-menu-button', function (e) {
        e.preventDefault();
        if(isDown){
            $('.mega-menu').slideUp();
            isDown = false;
            $(this).find('span').addClass('fa-bars');
            $(this).find('span').removeClass('fa-times');
        }
        else {
            $('.mega-menu').slideDown();
            isDown = true;
            $(this).find('span').removeClass('fa-bars');
            $(this).find('span').addClass('fa-times');
        }

    });
    $(document).click(function (e) {
        if(e.target.closest('header') == null){
            if(!$(e.target).hasClass('dynamic-check-view-all')){
                $('.mega-menu').slideUp();
                isDown = false;
                $('#mega-menu-button span').addClass('fa-bars');
                $('#mega-menu-button span').removeClass('fa-times');
            }
        }
    });

    $('.side-menu-button').click(function (e) {
        if(isOpen){
            $('.side-menu').css('left', '-350px');
            isOpen = false;
            $(this).find('span').addClass('fa-bars');
            $(this).find('span').removeClass('fa-times');
        }
        else {
            $('.side-menu').css('left', '0');
            isOpen = true;
            $(this).find('span').removeClass('fa-bars');
            $(this).find('span').addClass('fa-times');
        }
    });

    $('a[data-dme-toggle="collapse"]').click(function (e) {
        e.preventDefault();
        var open = $(this);
        var target = $(this).attr('data-dme-target');
        $('.dme-collapse').slideUp();
        $('#'+target).slideDown();
    });


    // side tabs in my-ads
    $('.dme-tab-content').hide();
    $('.dme-tab-content[data-id="started-ads"]').show();
    $('.dme-tab-button').click(function (e) {
        var target = $(this).attr('data-target');
        $('.dme-tab-content').hide();

        $('.dme-tab-content[data-id='+target+']').show();
    });
    // end side tabs in my-ads


    // Find city name using database zip code for an add and show it front end
    // Comment it because now we are storing the zip code city name in db
    /*
    if($('span').hasClass('db_zip_code')){
        var db_zip_code = $('.db_zip_code').text();
        if(db_zip_code){
            var api_url = 'https://api.bring.com/shippingguide/api/postalCode.json';
            // var api_url = 'https://api.bring.com/shippingguide/api/postalCode.json?clientUrl=demodesign.no&pnr=2014';
            var client_url = 'localhost';

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const postalCode = JSON.parse(this.responseText);
                    var zip_code_city = '';
                    if(postalCode.result){
                        zip_code_city = postalCode.result.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        });
                    }
                    $('.db_zip_code').text(db_zip_code+' '+zip_code_city);
                    //console.log(postalCode.result);
                }
            };
            xhttp.open("GET", api_url+"?clientUrl="+client_url+"&pnr="+db_zip_code, true);
            xhttp.send();
        }
    }
    */
    //End zip code

    //Clear Searches like recent and saved clear_searches_link
    $(document).on('click', '.clear_searches_link', function () {
        var type = $(this).data('search_type');
        var url = $(this).data('action');
        if(type && url){
            $.ajax({
                url: url,
                type:'POST',
                data: {'type':type},
                dataType:'json',
                success: function (data) {
                    if(data == 'success'){
                        location.reload();
                    }else{
                        alert('noe gikk galt.');
                    }
                }
            });
        }
    });

    // Property quote show/hide remove button
    $(document).on('change', '#property_quote', function (e) {

        $('.remove_property_quote').addClass('d-none');
        if (this.files.length > 0) {
            $('.remove_property_quote').removeClass('d-none');
            $('#property_quote').css('pointer-events','none');
            $('.property-quote-information-message').removeClass('d-none');
        }
    });

    //Remove file from property quote input when click on remvoe button
    $(document).on('click', '.remove_property_quote', function () {
        var $el = $('#property_quote');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.remove_property_quote').addClass('d-none');
        $('.remove_property_quote').removeAttr('id');
        $('#property_quote').css('pointer-events','auto');
        $('.property-quote-information-message').addClass('d-none');
        if($(this).parent('.property-quote-div').has('div.property-quote-value')){
            $('.property-quote-value').fadeOut();
        }

    });


    // Property quote show/hide remove button
    $(document).on('change', '#property_pdf', function () {

        $('.remove_property_pdf').addClass('d-none');

        if (this.files.length > 0) {
            $('.remove_property_pdf').removeClass('d-none');
            $('#property_pdf').css('pointer-events','none');
            $('.property-pdf-information-message').removeClass('d-none');
        }
    });

    //Remove file from property quote input when click on remvoe button
    $(document).on('click', '.remove_property_pdf', function () {
        var $el = $('#property_pdf');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.remove_property_pdf').addClass('d-none');
        $('.remove_property_pdf').removeAttr('id');
        $('#property_pdf').css('pointer-events','auto');
        $('.property-pdf-information-message').addClass('d-none');
        if($(this).parent('.property-pdf-div').has('div.property-pdf-value')){
            $('.property-pdf-value').fadeOut();
        }
    });

    $(document).on('click', '.follow-company-button', function (e) {
        e.preventDefault();
        var company_id = $(this).data('company_id');
        var url = $(this).data('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: "GET",
            data: {'company_id':company_id},
            async: false,
            success: function (response) {
                location.reload();
            }
        });
    });

    // Text editor Tinymc
    if($('.text-editor').length > 0){
        tinymce.init({
            menubar: false, // remove menubar if you want to show the menubar
            // statusbar: false,
            selector:'textarea.text-editor',
            setup : function(ed) {

                ed.on("blur", function(e){

                    var ad_status = $('.ad_status').val();
                    if(ad_status == 'saved') {
                        ed.save();
                        tinymce.triggerSave();
                        $('.text-editor').html(tinymce.activeEditor.getContent());
                        var this_obj = document.getElementById(ed.id);//$('#'+ed.id);
                        record_store_ajax_request('change', this_obj);
                    }
                });

                ed.on("keyup", function(){

                    $('.text-editor').html(tinymce.activeEditor.getContent());
                    explicit_keywords($('.text-editor'));
                });
            },

            height: 300,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools wordcount"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            // toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image", orignal
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });
    }


    // $(document).on('change', '.url_http', function (e){
    $('.url_http').on('change', function(){
        if ($(this).val() == ''){
            return;
        }
        s = $(this).val();
        if (!s.match(/^[a-zA-Z]+:\/\//))
        {
            s = 'http://' + s;
            $(this).val(s);
        }
    });

    $(document).on('change', '.ad_agent_id', function(e){
        // e.preventDefault();
        var form_id = $(this).closest("form").attr('id');
        var result = get_checked_agent_count(form_id);
        if(result === false){
            e.target.checked = false;
            alert('Du kan legge ved maksimalt 3 agenter med en annonse.');
        }
    });

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

    $("#more_details").click(function (e) {

        e.preventDefault();
        $(".more_details_section").removeClass('hide');
        $("#more_details").addClass('hide');
        $("#less_details").removeClass('hide');

    });

    $("#less_details").click(function (e) {

        e.preventDefault();
        $(".more_details_section").addClass('hide');
        $("#more_details").removeClass('hide');
        $("#less_details").addClass('hide');

    });

    //Show left banner in a page
    if ($("#left_banner_ad").length > 0) {
        left_banner_ad();
    }

    //Show top banner in a page
    if ($("#top_banner_ad").length > 0) {
        top_banner_ad();
    }

    //Show right banner in a page
    if ($("#right_banner_ad").length > 0) {
        right_banner_ad();
    }

    //Show more ratings
    $(document).on('click', '.show_more_notifications', function (e) {
        var last_id = $(this).data('last_id');
        var user_id = $(this).data('user_id');
        var url = $(this).data('action');
        var view_title = $(this).data('view_title');
        $('.show_more_notifications img').removeClass('d-none');
        $(this).css('pointer-events', 'none');
        $.ajax({
            url: url,
            type:'GET',
            data: {'last_id':last_id,'user_id':user_id,'view_title':view_title},
            dataType:'json',
            success: function (data) {
                $('.show_more_notifications').addClass('d-none');
                $('.show_more_notifications img').addClass('d-none');
                $(".ratings-section").append(data.html);
            }
        });
    });

    //Show more public ads
    $(document).on('click', '.show_more_public_profile_ads', function (e) {
        var last_id = $(this).data('last_id');
        var user_id = $(this).data('user_id');
        var url = $(this).data('action');
        $('.show_more_public_profile_ads img').removeClass('d-none');
        $(this).css('pointer-events', 'none');
        $.ajax({
            url: url,
            type:'GET',
            data: {'last_id':last_id,'user_id':user_id},
            dataType:'json',
            success: function (data) {
                $('.show_more_public_profile_ads').addClass('d-none');
                $('.show_more_public_profile_ads img').addClass('d-none');
                $(".public-user-ads-section").append(data.html);
            }
        });
    });

    //Show user package when an ad is going to published
    $(document).on('click', '.to_user_ad_publish', function (e) {
        var val = $(this).val();
        $('.ad_form_user_package_section').addClass('d-none');
        if(val === 'package'){
            $('.ad_form_user_package_section').removeClass('d-none');
        }
    });

    //disabled areas when user use map on property/job filter pages
    $(document).on('click', '#mega_menu_form #map #pac-input,#customRange1, #local_area_name_check', function (e) {
        var id = $(this).attr('id');
        if(id === 'customRange1' || id === 'pac-input'){
            $('#local_area_name_check').prop( "checked", true );
        }

        if($('#local_area_name_check'). prop("checked") == true){
            $('#mega_menu_form .property-filter-area-list').css('pointer-events','none');
            $('#mega_menu_form .property-filter-area-list').css('background-color','#f8f9faa3');

        }
        else if($('#local_area_name_check'). prop("checked") == false){
            $('#mega_menu_form .property-filter-area-list').removeAttr('style');
        }
    })

});

//Show left banner in a page
function left_banner_ad() {
    $( "#left_banner_ad a" ).each(function( key,index ) {
        var top_level_div = document.getElementById('left_banner_ad');
        var divs = top_level_div.getElementsByTagName('img');
        if(divs.length > 1){
            if($(this).hasClass('show_left_banner_img')){
                var time = $(this).data('time');
                var this_obj = $(this);
                setTimeout(function(){

                    this_obj.removeClass('d-none');
                    this_obj.removeClass('show_left_banner_img');

                    if(key+1 === divs.length){
                        divs[0].parentNode.classList.add("show_left_banner_img");
                        divs[0].parentNode.classList.remove("d-none");
                    }else{
                        divs[key+1].parentNode.classList.add("show_left_banner_img");
                        divs[key+1].parentNode.classList.remove("d-none");
                    }

                    this_obj.addClass('d-none');

                    left_banner_ad();
                }, time);
            }
        }
    });
}

//Show top banner in a page
function top_banner_ad() {
    $( "#top_banner_ad a" ).each(function( key,index ) {
        var top_level_div = document.getElementById('top_banner_ad');
        var divs = top_level_div.getElementsByTagName('img');
        if(divs.length > 1){
            if($(this).hasClass('show_top_banner_img')){
                var time = $(this).data('time');
                var this_obj = $(this);
                setTimeout(function(){

                    this_obj.removeClass('d-none');
                    this_obj.removeClass('show_top_banner_img');

                    if(key+1 === divs.length){
                        divs[0].parentNode.classList.add("show_top_banner_img");
                        divs[0].parentNode.classList.remove("d-none");
                    }else{
                        divs[key+1].parentNode.classList.add("show_top_banner_img");
                        divs[key+1].parentNode.classList.remove("d-none");
                    }

                    this_obj.addClass('d-none');

                    top_banner_ad();
                }, time);
            }
        }
    });
}

//Show left banner in a page
function right_banner_ad() {
    $( "#right_banner_ad a" ).each(function( key,index ) {
        var top_level_div = document.getElementById('right_banner_ad');
        var divs = top_level_div.getElementsByTagName('img');
        if(divs.length > 1){
            if($(this).hasClass('show_right_banner_img')){
                var time = $(this).data('time');
                var this_obj = $(this);
                setTimeout(function(){

                    this_obj.removeClass('d-none');
                    this_obj.removeClass('show_right_banner_img');

                    if(key+1 === divs.length){
                        divs[0].parentNode.classList.add("show_right_banner_img");
                        divs[0].parentNode.classList.remove("d-none");
                    }else{
                        divs[key+1].parentNode.classList.add("show_right_banner_img");
                        divs[key+1].parentNode.classList.remove("d-none");
                    }

                    this_obj.addClass('d-none');

                    right_banner_ad();
                }, time);
            }
        }
    });
}

jQuery(function ($) {
    $('#click-map').click(function () {
        return false;
    }).dblclick(function () {
        window.open(this.href, "_blank");
        return false;
    });
});