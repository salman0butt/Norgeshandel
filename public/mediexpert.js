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
            $(this).append('<a href="#" class="dynamic-check-view-all expand">Vis all</a>');
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
        // console.log(e.target);
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


    //Add Fields
    $.fn.WT_COPY_PASTE = function($this) {
        var $copy = $('[wt-copy='+$this.attr('wt-more')+']');
        $('[wt-paste='+$this.attr('wt-more')+']').append($copy.html());
    };
    $(document).on('click', '[wt-more]', function() {
        $.fn.WT_COPY_PASTE($(this));
    });
    // DELETE COPY
    $.fn.WT_COPY_DELETE = function($this) {
        $this.parents('[wt-duplicate='+$this.attr('wt-delete')+']').remove();
    };
    $(document).on('click', '[wt-delete]', function() {
        $.fn.WT_COPY_DELETE($(this));
    });
});

