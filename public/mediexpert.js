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

});
