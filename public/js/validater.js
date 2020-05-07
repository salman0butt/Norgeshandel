$(document).ready(function () {
    //Property for rent
    $("#property_for_rent_form").validate({
        lang: 'no',
        rules: {
            heading: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            zip_code: {
                required: true,
                zipcode: true
            },
            street_address: {
                required: true
            },
            property_type: {
                required: true
            },
            primary_rom: {
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
                required: true,
                number: true
            },
            deposit: {
                number: true
            },
            rented_from: {
                required: true
            },
            rented_to: {
                required: true
            },
        },
        onfocusout: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        }
    });
  //  Property for sale

    $("#property_for_sale_form").validate({
        lang: 'no',
        rules: {
            headline: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            zip_code: {
                required: true,
                zipcode: true
            },
            property_type: {
                required: true
            },
            street_address:{
                required: true
            },
            floor: {
                number: true
            },
            tenure: {
                required: true
            },
            municipality_number: {
                required: true,
                minlength: 4,
                maxlength: 4,
                number: true
            },
            farm_number: {
                required: true,
                number: true
            },
            usage_number: {
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
            primary_room: {
                required: true,
                number: true
            },   
            Base: {
                number: true
            },
            year: {
                required: true,
                number: true,
               
            },
            renovated_year: {
                number: true
              
            },
            number_of_bedrooms: {
                required: true,
                number: true
            },
            land: {
                number: true
            },
            holiday_year: {
                number: true
            
            },
            party_fee: {
                number: true
            },
            rent_shared_cost: {
                number: true
            },
            // shared_costs_include: {
            //     required: true
            // },
            // costs_include:{
            //     required: true
            // },
            common_costs_after_interest_free_period: {
                number: true
            },
            asset_value: {
                // required: true,
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
            percentage_of_public_debt: {
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
            offer_url: {
                validUrl: true
            },
            video: {
                validUrl: true
            },
            apartment_number: {
                number: true
            },
             deliver_date:{
                 number: true
            }
        },
        onfocusout: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        }
    });

    $("#commercial_property_for_rent").validate({
        lang: 'no',
        rules: {
            'property_type': {required: true},
            heading: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            zip_code: {
                required: true,
                zipcode: true
            },
            // property_type: {
            //     required: true
            // },
            street_address: {
                required: true
            },
            floor: {
                number: true
            },
            tenure: {
                required: true
            },
            municipal_number: {
                minlength: 4,
                maxlength: 4,
                number: true
            },
            farm_number: {
                number: true
            },
            usage_number: {
                number: true
            },
            use_area: {
                number: true
            },
            gross_area_from:{
                required: true,
                number: true
            },
            gross_area_to:{
                required: true,
                number: true
            },
            land: {
              number: true
            },
            number_of_office_space: {
                number: true
            },
            number_of_parking_space: {
                number: true
            },
            floors: {
                number: true
            },
            year_of_construction: {
                number: true
               
            },
            renovated_year: {
                number: true
            },
            rent_per_meter_per_year:{
                number: true,
            },
            link_for_information: {
                validUrl: true
            },
            //phone: {
            //    minlength: 8,
            //    maxlength: 9
           // },
           //  contact:{
           //      required: true,
           //      number: true
           //  },
           //  email:{
           //      required:true,
           //      email: true
           //  }
        },

        errorPlacement: function (error, element) {
            if (element.attr("type") == "checkbox") {
                error.insertAfter($(element).parents('.property_type_section').after($('.property_type_section')));
            } else {
                error.insertAfter(element);
            }
        },
        onfocusout: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        },
    });

    // required check box (property type) on commercial property for rent page
    $("#commercial_property_for_rent .property_type").rules("add", {
        required:true
    });

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
                maxlength: 150
            },
            region: {
                required: true,
                min: 1
            },
            property_type: {
                required: true,
                min: 1
            }//,
           // phone: {
            //    number: true
            //}
        },
        onfocusout: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        },
        /*
        errorPlacement: function (error, element) {
            if (element.attr("type") == "checkbox") {
                error.insertAfter($(element).parents('.property_type_section').after($('.property_type_section')));
            }

            if (element.attr("type") == "checkbox" ) {
                error.insertAfter($(element).parents('.property_region_section').after($('.property_region_section')));
            }

            if (element.attr("type") == "text" ) {
                error.insertAfter($(element).parents('.headline_section').after($('.headline_section')));
            }
        }
        */
    });

    // required check box (region) on flat wishes rented page
   $("#flat_wishes_rented_form .region").rules("add", {
       required:true
   });


    // required check box (property_type) on flat wishes rented page
    $("#flat_wishes_rented_form .property_type").rules("add", {
        required:true
    });

    // Commercial Lot

    $("#commercial_plot_form").validate({
        lang: 'no',
        rules: {
            plot_type: {
                required: true
            },
            country: {
                required: true
            },
            zip_code: {
                required: true,
                zipcode: true
            },
            municipal_number: {
                number: true
            },
            street_address: {
              required: true  
            },
            usage_number: {
                number: true
            },
             farm_number: {
                 number: true
             },
            plot_size: {
                number: true
            },
            asking_price: {
                required: true,
                number: true
            },
            verditakst: {
                number: true
            },
            headline: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            // link: {
            //     validUrl: true
            // },
          //  phone: {
          //      number: true
          //  },
          //   contact: {
          //       required: true,
          //       number: true
          //   },
          //   e_post: {
          //       required: true,
          //       email: true
          //   }
        },
        onfocusout: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        }

    });


    // Businesses for sale

    $("#business_for_sale").validate({
        lang: 'no',
        rules: {
            industry: {
                required: true
            },
            zip_code: {
                required: true,
                zipcode: true
            },
            price: {
                number: true
            },
            offer_url: {
                validUrl: true
            },
            headline: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            street_address: {
                required: true
            },
            link_for_information: {
                validUrl: true
            }//,
           // phone: {
          //      number: true
           // }
        },
        onfocusout: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        }

    });

    // residential_and_recreational_land_for_sale
    $("#residential_and_recreational_land_for_sale").validate({
        lang: 'no',
        rules: {
            property_type: {
                required: true
            },
            countryCode: {
                required: true
            },
            areaId: {
                required: true
            },
            postal_code: {
                zipcode: true,
                required: true,
                number: true
            },
            county_number: {
                number: true
            },
            cadastral_unit_number: {
                number: true
            },
            property_unit_number: {
                number: true
            },
            section_number: {
                 number: true
            },
            leasehold_unit_number: {
                number: true
            },
            plot_area_size:{
                number: true
            },
            price_suggestion: {
                number: true
            },
            sales_cost_sum: {
                number: true
            },
            date0: {
               number: true
            },
            time_from0: {
                number: true
            },
            time_to0: {
               number: true
            },
            title: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            contact_mobile: {
                number: true
            }

        }
    });



    //Holiday homes for sale

    $("#property_holiday_home_for_sale_form").validate({
        lang: 'no',
        rules: {
            ad_headline: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            zip_code: {
                required: true,
                zipcode: true
            },
            location: {
                required: true
            },
            property_type: {
                required: true
            },
            muncipal_number: {
                minlength: 4,
                maxlength: 4,
                number: true
            },
            farm_number: {
                number: true
            },
            usage_number: {
                number: true
            },
            party_number: {
                number: true
            },
            section_number: {
                number: true
            },
            base: {
                number: true
            },
            use_area: {
                number: true
            },
            primary_room: {
                required: true,
                number: true
            },
            gross_area: {
                number: true
            },
            Base: {
                number: true
            },
            housing_area: {
                number: true
            },
            year_of_construction: {
                number: true
            },
            renovated_year: {
                number: true
            },
            number_of_bedrooms: {
                required: true,
                number: true
            },
            number_of_beds: {
                number: true
            },
            number_of_parking_spaces: {
                number: true
            },
            state_report_link: {
                validUrl: true
            },
            meter_above_sea_level: {
                number: true
            },
            land: {
                number: true
            },
            // number_of_tenants: {
            //     number: true
            // },
            holiday_year: {
                number: true
            },
            party_fee: {
                number: true
            },
            common_costs: {
                number: true
            },
            joint_board_after_interest_fee_period: {
                number: true
            },
            common_costs_after_interest_free_period: {
                number: true
            },
            asset_value: {
                number: true
            },
            offer_url: {
                validUrl: true
            },
            asking_price: {
                required: true,
                number: true
            },
            cost: {
                number: true
            },
            prcentage_of_joint_debt: {
                number: true
            },
            value_rate: {
                number: true
            },
            loan_rate: {
                number: true
            },
            percentage_of_common_health: {
                number: true
            },
            link_to_terif_documents: {
                validUrl: true
            },
            task_link: {
                validUrl: true
            },
            video: {
                validUrl: true
            },
            delivery_date: {
                number: true
            },
            from_clock: {
                number: true
            },
            street_address: {
                required: true
            },
            clockwise: {
                number: true
            },
            apartment_number: {
                number: true
            }//,
          //  phone: {
           //     number: true,
           //     minlength: 8,
           //     maxlength: 9,
           // }
        },
        onfocusout: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        },
    });


    //Næringstomt form validation

    $("#realestate_business_plot").validate({
        lang: 'no',
        rules: {
            type_plot: {
                required: true
            },
            location: {
                required: true
            },
            location_description: {
                required: true
            },
            zip_code: {
                required: true,
                zipcode: true
            },
            head_line: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            muncipal_number: {
                number: true,
                required: true
            },
            usage_number: {
                number: true
            },
            farm_number: {
                number: true
            },
            plot_size: {
                number: true
            },
            asking_price: {
                required: true,
                number: true
            },
            valuation1: {
                number: true
            },
            valuation2: {
                number: true
            },
            text_on_link: {
                validUrl: true
            },
            link_for_information: {
                validUrl: true
            },
            email: {
                required: true,
                email: true
            }
        }

    });

    // Commercial property for sale

    $("#commercial_property_for_sale").validate({
        lang: 'no',
        rules: {
            property_type: {
                required: true
            },
            location: {
                required: true
            },
            zip_code: {
                required: true,
                zipcode: true
            },
            municipal_number: {
                minlength: 4,
                number: true
            },
            usage_number: {
                number: true
            },
            farm_number: {
                number: true
            },
            gross_area_from: {
                number: true,
                required: true
            },
            street_address: {
                required: true
            },
            gross_area_to: {
                number: true,
                required: true
            },
            use_area: {
                number: true
            },
            land: {
                number: true
            },
            number_of_office_space: {
                number: true
            },
            number_of_parking_space: {
                number: true
            },
            floors: {
                number: true
            },
            primary_room: {
                number: true
            },
            year_of_construction: {
                number: true
            },
            rennovated_year: {
                number: true
            },
            rental_income: {
                number: true
            },
            value_rate: {
                number: true
            },
            loan_rate: {
                number: true
            },
            availiable_from: {
                number: true
            },
            offer_url: {
                validUrl: true
            },
            headline: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            link_for_information: {
                validUrl: true
            }//,
           // phone: {
           //     number: true,
           //     minlength: 8,
           //     maxlength: 9
           // }
        },
        onfocusout: false,
        invalidHandler: function(form, validator) {
          var errors = validator.numberOfInvalids();
           if (errors) {
                validator.errorList[0].element.focus();
           }
        },
        errorPlacement: function (error, element) {

            if (element.attr("type") == "checkbox") {
                error.insertAfter($(element).parents('.property_type_section').after($('.property_type_section')));
            } else {
                error.insertAfter(element);
            }
        }
     

    });

    // required check box (property type) on commercial property for sale page
    $("#commercial_property_for_sale .property_type").rules("add", {
        required:true
    });

    // LOGIN PAGE VALIDATION
    $("#email_management").validate({
        lang: 'no',
        rules: {
            email: {
                required: true,
                email: true
            },
            confirm_email: {
                required: true,
                email: true
            },
        }
    });

    // Company Agent VALIDATION
    $("#company_agent").validate({
        lang: 'no',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            position: {
                required: true,
            },
        }
    });

    // LOGIN PAGE VALIDATION
    $("#addPhoneFrm").validate({
        lang: 'no',
        rules: {
            phone_number: {
                required: true,
                minlength: 7,
            },
        }
    });

    // LOGIN PAGE VALIDATION
    $("#login_page").validate({
        lang: 'no',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 2,
                maxlength: 20
            }
        }
    });

    // REGISTER PAGE VALIDATION
    $("#register_page").validate({
        lang: 'no',
        rules: {
            first_name: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            last_name: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            username: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        }
    });


  //  Job form validation
    $("#job-form").validate({
        lang: 'no',
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            address: {
              required: true
            },
            title: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            positions: {
                required: true,
                number: true
            },
            commitment_type: {
                required: true
            },
            sector: {
                required: true
            },
            industry: {
                required: true
            },
            job_function: {
                required: true
            },
            emp_name: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            emp_website: {
                validUrl: true
            },
            emp_facebook: {
                validUrl: true
            },
            emp_linkedin: {
                validUrl: true
            },
            emp_twitter: {
                twitterhandle: true
            },
            country: {
                required: true
            },
            zip: {
                required: true,
                zipcode: true
            },
            workplace_video: {
                validUrl: true
            },
            app_receive_by: {
                required: true
            }, //
            app_contact_title: {
                required: true
            },
            app_contact: {
                required: true
            },
            app_link_to_receive: {
                // required: true,
                validUrl: true
            },
            app_email_to_receive: {
                required: true,
                email: true
            },
            app_email: {
                required: true,
                email: true
            },
            app_linkedin: {
                validUrl: true
            },
            app_twitter: {
                twitterhandle: true
            }
        }
    });

    // CV PAGE VALIDATION
    $("#cvpersonal-form").validate({
        lang: 'no',
        rules: {
            title: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            first_name: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            last_name: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            address: {
                required: true,
                maxlength: 120
            },
            zip: {
                required: true,
                zipcode: true
            },
            city: {
                required: true,
                maxlength: 120
            },
            email: {
                required: true,
                email: true
            },
            tell: {
                number: true
            },
            mobile: {
                number: true
            },
            birthday: {
                required: true,
            },
            gender: {
                required: true
            },
            occupational_status: {
                required: true
            },
            website: {
                validUrl: true
            },
            driving_license: {
                number: true,
                minlength: 2,
                maxlength: 20
            }
        }
    });

    // Apply CV on Job Validation
    $("#applied_job").validate({
        lang: ' no',
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            telephone: {
                required: true,
                digits: true
            },
            dob: {
                required: true,
                digits: true,
                min: 1920,
                max: 2010
            },
            education: {
                required: true
            },
            current_position: {
                required: true
            },
        }
    });

    // CV education part VALIDATION

    $("#new_cvexperience-form").validate({
        lang: 'no',
        rules: {
            school: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            zip: {
                required: true,
                zipcode: true
            },
            period_from: {
                required: true
            },
            period_to: {
                required: true
            },
            subject: {
                required: true
            },
            education_level: {
                required: true
            }

        }
    });

    // CV experiance part VALIDATION
    $("#cvexperience-form").validate({
        lang: ' no',
        rules: {
            company: {
                required: true,
                minlength: 2,
                maxlength: 120
            },
            period_from: {
                required: true
            },
            period_to: {
                required: true
            },
            job_title: {
                required: true,
                minlength: 2,
                maxlength: 120
            }
        }
    });

    // CV experiance part VALIDATION
    $("#form_languages").validate({
        lang: ' no',
        rules: {
            langs: {
                required: true
            }
        }
    });

    // CV form prefrences part VALIDATION
    $("#form_preferences").validate({
        lang: ' no',
        rules: {
            job_type: {
                required: true
            },
            responsibility: {
                required: true
            },
            disclaimer: {
                required: true
            },
            willingness: {
                required: true
            },
            travel_days: {
                number: true
            },
            salary: {
                number: true
            },
            termination_notice: {
                required: true
            }
        }
    });





    //submit button checks
    // $('#property_for_rent_form').on('click submit', function () { // fires on every keyup & blur
    //     if ($('#flat_wishes_rented_form').validate().checkForm()) { // checks form for validity
    //         // $('#publiserannonsen').removeClass('button_disabled').prop('disabled', false); // enables button
    //     } else {
    //         // $('#publiserannonsen').addClass('button_disabled').prop('disabled', true); // disables button
    //     }
    // });
    // $('#property_for_sale_form input').bind('keyup blur click', function () { // fires on every keyup & blur
    //     if ($('#property_for_sale_form').validate().checkForm()) { // checks form for validity
    //         $('#publiserannonsen').removeClass('button_disabled').prop('disabled', false); // enables button
    //     } else {
    //         $('#publiserannonsen').addClass('button_disabled').prop('disabled', true); // disables button
    //     }
    // });
    // $('#property_for_rent_form input').bind('keyup blur click', function () { // fires on every keyup & blur
    //     if ($('#property_for_rent_form').validate().checkForm()) { // checks form for validity
    //         $('#publiser_annonsen').removeClass('button_disabled').prop('disabled', false); // enables button
    //     } else {
    //         $('#publiser_annonsen').addClass('button_disabled').prop('disabled', true); // disables button
    //     }
    // });
    // $('#realestate_business_plot input').bind('keyup blur click', function () { // fires on every keyup & blur
    //     if ($('#realestate_business_plot').validate().checkForm()) { // checks form for validity
    //         $('#publiserannonsen').removeClass('button_disabled').prop('disabled', false); // enables button
    //     } else {
    //         $('#publiserannonsen').addClass('button_disabled').prop('disabled', true); // disables button
    //     }
    // });
    // $('#property_holiday_home_for_sale_form input').bind('keyup blur click', function () { // fires on every keyup & blur
    //     if ($('#property_holiday_home_for_sale_form').validate().checkForm()) { // checks form for validity
    //         $('#publiserannonsen').removeClass('button_disabled').prop('disabled', false); // enables button
    //     } else {
    //         $('#publiserannonsen').addClass('button_disabled').prop('disabled', true); // disables button
    //     }
    // });
    // $('#commercial_property_for_sale input,#commercial_property_for_rent input').bind('keyup blur click', function () { // fires on every keyup & blur
    //     if ($('#commercial_property_for_sale, #commercial_property_for_rent').validate().checkForm()) { // checks form for validity
    //         $('#publiserannonsen').removeClass('button_disabled').prop('disabled', false); // enables button
    //     } else {
    //         $('#publiserannonsen').addClass('button_disabled').prop('disabled', true); // disables button
    //     }
    // });
    // $('#job-form input').bind('keyup blur click', function () { // fires on every keyup & blur
    //     if ($('#job-form').validate().checkForm()) {
    //         // checks form for validity
    //         $('#publiserannonsen').removeClass('button_disabled').prop('disabled', false); // enables button
    //     } else {
    //         $('#publiserannonsen').addClass('button_disabled').prop('disabled', true); // disables button
    //     }
    // });

    //   $('#business_for_sale input').bind('keyup blur click', function () { // fires on every keyup & blur
    //       if ($('#business_for_sale').validate().checkForm()) {
    //           // checks form for validity
    //           $('#publiser_annonsen').removeClass('button_disabled').prop('disabled', false); // enables button
    //       } else {
    //           $('#publiser_annonsen').addClass('button_disabled').prop('disabled', true); // disables button
    //       }
    //   });

    $('select').on('change', function () {
        $("form").validate().element('select', '#furnishing');
    });

});
