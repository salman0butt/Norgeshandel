$( document ).ready(function() {
    //Property for rent
    $("#property_for_rent_form").validate({
        lang: 'no',
        rules: {
            heading: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            zip_code: {
                required: true,
                zipcodeUS: true
            },
            property_type: {
                required: true
            },
            primary_rom:
                {
                    required: true,
                    number: true
                },
            gross_area: {
                number: true
            },
            area_of_use: {
                number: true
            },
            floor: {
                number: true
            },
            number_of_bedrooms: {
                required: true,
                number: true
            },
            furnishing: {
                required: true
            },
            monthly_rent: {
                number: true
            },
            deposit: {
                number: true
            },
            rented_from: {
                required: true,
                date: true
            },
            rented_to: {
                date: true
            }
        },
    });
        //Property for sale

        $("#property_for_sale_form").validate({
        lang: 'no',
        rules: {
            headline: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            zip_code: {
                required: true,
                zipcodeUS: true
            },
            property_type: {
                required: true
            },
            tenure: {
                required: true
            },
            municipality_number: {
                required: true,
                minlength:4,
                number: true
            },
            farm_number: {
                required: true,
                number: true
            },
            usage_number:{
                required: true,
                number: true
            },
             party_number: {
              number: true
             },
            section_number: {
                number: true
            },
            use_area: {
                required: true,
                number: true
            },
            primary_room:
                {
                    required: true,
                    number: true
                },
            Base: {
                number: true
            },
            year: {
                required: true,
                number:true,
                date:true
            },
            renovated_year: {
                number:true,
                date:true
            },
            number_of_bedrooms: {
                required: true,
                number: true
            },
            floor: {
                number: true
            },
            land: {
                number: true
            },
            holiday_year: {
                number: true,
                date: true
            },
            party_fee: {
                number: true
            },
            rent_shared_cost: {
                required: true,
                number: true
            },
            shared_costs_include: {
                required: true
            },
            common_costs_after_interest_free_period: {
                number: true
            },
            asset_value: {
                required: true,
                number: true
            },
            asking_price: {
                required: true,
                number: true
            },
            expenses: {
                required: true,
                number: true
            },
            costs_include: {
                required: true,
                number: true
            },
            percentage_of_public_debt: {
                required: true,
                number: true
            },
            value_rate: {
                number: true
            },
            loan_rate: {
                number: true
            },
            percentage_of_common_wealth: {
                number: true
            },
            video: {
              url: true
            },
            apartment_number: {
                number: true
            }
        }
    });
    jQuery.validator.addClassRules("pub_validate", {
        required: true
    });
    // flat wishes rented

    $("#flat_wishes_rented_form").validate({
        lang: 'no',
        rules: {
            number_of_tenants: {
                number: true
            },
            max_rent_per_month: {
                number: true
            },
            headline: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            region: {
                required: true,
                min: 1
            },
            property_type: {
                required: true,
                min: 1
            }
        }

    })

    //submit button checks
    $('#flat_wishes_rented_form input').bind('keyup blur click', function () { // fires on every keyup & blur
        if ($('#flat_wishes_rented_form').validate().checkForm()) {                   // checks form for validity
            $('#publiserannonsen').removeClass('button_disabled').prop('disabled', false); // enables button
        } else {
            $('#publiserannonsen').addClass('button_disabled').prop('disabled', true);   // disables button
        }
    });
    $('#property_for_sale_form input').bind('keyup blur click', function () { // fires on every keyup & blur
        if ($('#property_for_sale_form').validate().checkForm()) {                   // checks form for validity
            $('#publiserannonsen').removeClass('button_disabled').prop('disabled', false); // enables button
        } else {
            $('#publiserannonsen').addClass('button_disabled').prop('disabled', true);   // disables button
        }
    });
    $('#property_for_rent_form input').bind('keyup blur click', function () { // fires on every keyup & blur
        if ($('#property_for_rent_form').validate().checkForm()) {                   // checks form for validity
            $('#publiser_annonsen').removeClass('button_disabled').prop('disabled', false); // enables button
        } else {
            $('#publiser_annonsen').addClass('button_disabled').prop('disabled', true);   // disables button
        }
    });

    $('select').on('change', function(){
        $("form").validate().element('select','#furnishing');
    });

});
