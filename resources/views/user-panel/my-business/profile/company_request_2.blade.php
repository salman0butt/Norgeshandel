@extends('layouts.landingSite')
@section('page_content')
<style>
.u-t4 {
    font-weight: normal !important;
}
</style>
<main class="company_request_form pb-5">
    <div class="dme-container">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                    <li class="breadcrumb-item"><a href="{{url('my-business/profile')}}">Min profil </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Be om firmaprofil</li>
                </ol>
            </nav>
        </div>
        <!---- end breadcrumb----->
        @include('common.partials.flash-messages')
        <div class="row">
            <div class="col-md-12 mt-4">
                <h3 class="font-weight-normal">Bli bedriftskunde hos Norges Handel</h3>
            </div>
            <div class="col-md-12 collapse show" id="form_org_number">
                <p>Det koster ingenting å bli bedriftskunde, alt vi trenger er ditt organisasjonsnummer</p>
                <form class="org-number" method="post" name="org_number" action="{{route('request_company_profile')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="type" value="{{$type}}">
                    <input type="hidden" name="form_type" value="org_number">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="org_number">Org.Nr.</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" placeholder="9 siffer" id="org_number"
                                name="org_number" minlength="9" maxlength="9" required>
                            <div id="error-show"></div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn dme-btn-outlined-blue find_detail_button">Gå videre
                            </button>
                            <div id="0" style="display:none; margin-top:15%; padding-bottom: 15%">
                             {{-- <img src="{{ asset('public\spinner.gif') }}" alt="spinner" id="imageLoader"
                                    height="50px">  --}}
                            </div>
                        </div><br>

                        <div class="col-md-5">

                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <p class="u-mb64">
                            <button type="button" id="btn_manual_entry" class="prevent link" data-toggle="collapse"
                                data-target="#form_manual_entry">Jeg har ikke organisasjonsnummer </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 collapse" id="form_manual_entry">
                <form class="contact-info-form" method="post" name="contact_info_form"
                    action="{{route('request_company_profile')}}">
                    {{csrf_field()}}
                    <div class="bg-maroon-lighter radius-8 company_details p-2 mb-3 d-none">
                        <div class="row">
                            <div class="col-md-6">Firma:</div>
                            <div class="col-md-6 company_name font-weight-bold"></div>
                            <div class="col-md-6">Org.nr.:</div>
                            <div class="col-md-6 company_reg_no font-weight-bold"></div>
                            <div class="col-md-6">Adresse:</div>
                            <div class="col-md-6 company_address font-weight-bold"></div>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="{{$type}}">
                    <input type="hidden" name="form_type" value="manual_entry">
                    <div class="form-group row company_name_section">
                        <label for="org_name_2" class="col-md-2">Firmanavn</label>
                        <input name="org_name" class="form-control col-md-4" id="org_name_2" type="text" maxlength="255"
                            required="required">
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="u-t3">Kontaktperson</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="first_name">Fornavn</label>
                            <input class="form-control" placeholder="Fornavn" name="first_name" id="first_name"
                                type="text" maxlength="255" aria-required="true" value="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name">Etternavn</label>
                            <input class="form-control" placeholder="Etternavn" name="last_name" id="last_name"
                                type="text" maxlength="255" aria-required="true" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="email">E-post</label>
                            <input class="form-control" placeholder="e-post" name="email" id="email" type="email"
                                aria-required="true" value="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone">Telefon (valgfritt)</label>
                            <input class="form-control" placeholder="Telefon" name="phone" id="phone" type="text"
                                value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="comment">Kommentar (valgfritt)</label>
                            <textarea class="form-control" name="comment" id="comment" style="height: 90px;"></textarea>
                        </div>
                    </div>
                    <button type="submit" name="contact_info_form_submit" class="btn bg-maroon color-white">Kontakt
                        meg</button>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <p class="u-mb64">
                            <button type="button" id="btn_org_number" class="prevent link" data-toggle="collapse"
                                data-target="#form_org_number">Har organisasjonsnummer?
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="font-weight-normal">Dette får du som bedriftskunde</h3><br>
                <div class="row">
                    {{-- <div class="col-md-4">
                        <h4 class="u-t4">
                            <span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Gratis
                            bedriftsprofil</h4>
                        <p>Kandidater får en god oversikt over alle aktive stillinger i bedriften, og de kan følge
                            bedriften for
                            å bli varslet når en ny stilling legges ut
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="u-t4">
                            <span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Søknadene
                            samles i ett enkelt system
                        </h4>
                        <p>Du får oversikt over alle søkere på dine stillinger samlet på ett sted</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="u-t4">
                            <span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Det koster
                            ingenting å bli
                            bedriftkunde</h4>
                        <p>Du betaler bare for de annonsene du har lagt ut</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="u-t4">
                            <span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Rabatterte
                            priser</h4>
                        <p class="u-mb0">Basert på antall annonser du legger ut.</p>
                        
                    </div>
                    <div class="col-md-4">
                        <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span>
                            Månedlig faktura</h4>
                        <p>Vi samler opp kjøpene dine slik at du får færre fakturaer og mer oversikt</p>
                    </div>--}}
                     <div class="col-md-4"> 
                        <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span>
                           Vårt mål er å bidra til at din bedrift får fornøyde kunder</h4>
                        {{-- <p>&emsp;</p> --}}
                    </div>
                         <div class="col-md-4">
                        <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span>
                           Kredittid og en faktura på alle annonser</h4>
                        {{-- <p>&emsp;</p> --}}
                    </div>
                       <div class="col-md-4">
                        <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span>
                           Individuelle betingelser og priser</h4>
                        {{-- <p>&emsp;</p> --}}
                    </div>
                       <div class="col-md-4">
                        <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span>
                          Firmaprofilering</h4>
                        {{-- <p>&emsp;</p> --}}
                    </div>
                        <div class="col-md-6">
                        <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span>
                          Lenke til bedriftens nettside i alle annonser</h4>
                       {{-- <p></p> --}}
                     
                    </div><br>
                </div>
                    <a href="{{url('price-chart')}}">Se prisoversikt her</a>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {
        $('#btn_manual_entry, #btn_org_number').click(function (e) {
            $('.collapse').removeClass('show');
        });
        var num = $('#org_number').val();
        $('#org_number').keyup(function (e) {
            if ($(this).val().length <= 9) {
                num = $('#org_number').val();
            } else {
                $(this).val(num);
            }
        })

        //Press enter in org-number submit a form
        $(document).on('keypress', '.org-number #org_number', function (e) {
            var key = e.which;
            if (key == 13) // the enter key code
            {
                $('.org-number .find_detail_button[type="button"]').click();
                return false;
            }
        });

        // find company detail
        $(document).on('click', '.org-number .find_detail_button[type="button"]', function () {
            var org_number = $('.org-number #org_number').val();
            var api_url =
            'https://data.brreg.no/enhetsregisteret/api/enheter/'; // api link concatenate the registration number
            if (org_number) {
                if (org_number <= 0) {
                    alert('Organisasjonsnummeret må være positiv 9 tall.');
                    return false;
                }

                if (org_number.length != 9) {
                    alert('Organisasjonsnummeret må bestå av 9 tall.');
                    return false;
                }
                $.ajax({
                    type: "GET",
                    url: api_url + org_number,
                    success: function (response) {
                        $('#form_org_number #btn_manual_entry').click();
                        //$('.org-number #imageLoader').css('display', 'inline');
                        var registration_number = response[
                        'organisasjonsnummer']; //  get the company registration number
                        var company_name = response['navn']; //get the company name
                        var company_address = response['forretningsadresse'][
                        'adresse']; // get the company address
                        var zip_code = response['forretningsadresse'][
                        'postnummer']; // get the postal code of company
                        var post_office = response['forretningsadresse'][
                        'poststed']; // get the post office
                        var company_add_zip = company_address + ' ' + zip_code + ' ' +
                            post_office;
                        $('.company_details').removeClass('d-none');
                        $('.company_name_section').addClass('d-none');
                        $('.company_name_section #org_name_2').val(company_name);
                        $('.company_details .company_name').html(company_name);
                        $('.company_details .company_reg_no').html(registration_number);
                        $('.company_details .company_address').html(company_add_zip);
                    },

                    error: function (response) {
                        if (response['status'] == 404) {
                            $('#error-show').html(
                                "<p style='color:red;'>Organisasjonsnummer ikke funnt</p>"
                                );
                        } else {
                            //console.log('Noe gikk galt.');
                        }

                    }
                });
            } else {
                alert('Oppgi org.no');
            }
        });
    })

</script>
@endsection
