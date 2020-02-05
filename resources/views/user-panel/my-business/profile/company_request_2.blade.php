@extends('layouts.landingSite')
@section('page_content')
    <main class="company_request_form pb-5">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                        <li class="breadcrumb-item"><a href="{{url('my-business/profile')}}">Min prifil </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Be om firmaprofil</li>
                    </ol>
                </nav>
            </div>            <!---- end breadcrumb----->
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
                                <input type="number" class="form-control" placeholder="9 siffer" id="org_number" name="org_number">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn dme-btn-outlined-blue">Gå videre </button>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="u-mb64">
                                <button type="button" id="btn_manual_entry" class="prevent link" data-toggle="collapse" data-target="#form_manual_entry">Jeg har ikke organisasjonsnummer </button>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 collapse" id="form_manual_entry">
                    <form class="contact-info-form" method="post" name="contact_info_form" action="{{route('request_company_profile')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="type" value="{{$type}}">
                        <input type="hidden" name="form_type" value="manual_entry">
                        <div class="form-group row">
                            <label for="org_name_2" class="col-md-2">Firmanavn</label>
                            <input name="org_name" class="form-control col-md-4" id="org_name_2" type="text" maxlength="255">
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
                                <input class="form-control"
                                    placeholder="Fornavn" name="first_name" id="first_name" type="text"
                                    maxlength="255" aria-required="true" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Etternavn</label>
                                <input class="form-control" placeholder="Etternavn" name="last_name" id="last_name" type="text" maxlength="255" aria-required="true" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">E-post</label>
                                <input class="form-control" placeholder="e-post" name="email" id="email" type="email" aria-required="true" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Telefon (valgfritt)</label>
                                <input class="form-control" placeholder="Telefon" name="phone" id="phone" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="comment">Kommentar (valgfritt)</label>
                                <textarea class="form-control" name="comment" id="comment" style="height: 90px;"></textarea>
                            </div>
                        </div>
                        <button type="submit" name="contact_info_form_submit" class="btn bg-maroon color-white">Kontakt meg</button>
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
                    <h3 class="font-weight-normal">Dette får du som bedriftskunde</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="u-t4">
                                <span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Gratis bedriftsprofil</h4>
                            <p>Kandidater får en god oversikt over alle aktive stillinger i bedriften, og de kan følge
                                bedriften for
                                å bli varslet når en ny stilling legges ut
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="u-t4">
                                <span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Søknadene samles i ett enkelt system
                            </h4>
                            <p>Du får oversikt over alle søkere på dine stillinger samlet på ett sted</p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="u-t4">
                                <span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Det koster ingenting å bli
                                bedriftkunde</h4>
                            <p>Du betaler bare for de annonsene du har lagt ut</p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="u-t4">
                                <span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Rabatterte priser</h4>
                            <p class="u-mb0">Basert på antall annonser du legger ut.</p>
                            <a href="/prisoversikt">Se prisoversikt
                                her</a>
                        </div>
                        <div class="col-md-4">
                            <h4 class="u-t4"><span class="fa fa-check-circle color-maroon"
                                                   style="font-size: 16px;"></span> Månedlig faktura</h4>
                            <p>Vi samler opp kjøpene dine slik at du får færre fakturaer og mer oversikt</p>
                        </div>
                    </div>
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
                if ($(this).val().length<=9){
                    num = $('#org_number').val();
                }
                else{
                    $(this).val(num);
                }
            })
        })
    </script>
@endsection
