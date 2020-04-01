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
function notify(type,msg,title) {
    Command: toastr[type](msg, title)
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
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
            $.each($(this).find('>ul>li'), function(x){
                if($(this).index()>12){
                    $(this).slideUp();
                    should_visible = false;
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
$(document).ready(function (e) {
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

    $('.mega-menu-button').click(function (e) {
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
        if(isEmpty(e.target.closest('header'))){
            $('.mega-menu').slideUp();
            isDown = false;
            $('#mega-menu-button span').addClass('fa-bars');
            $('#mega-menu-button span').removeClass('fa-times');
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

    $('.url_http').on('change', function(){
    s = $(this).val();
    if (!s.match(/^[a-zA-Z]+:\/\//))
    {
        s = 'http://' + s;
    $(this).val(s);
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

});

