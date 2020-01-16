@extends('layouts.landingSite')
@section('page_content')
    <main class="company_request_form pb-5">
        <div class="dme-container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <h3 class="font-weight-normal">Bli bedriftskunde på FINN jobb</h3>
                    <p>Det koster ingenting å bli bedriftskunde, alt vi trenger er ditt organisasjonsnummer</p>
                </div>
                <div class="col-md-12 collapse" id="form_org_number">
                    <form>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Org.Nr.</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" placeholder="9 siffer" name="org_number">
                            </div>
                            <div class="col-md-3">
                                <button type="submit"
                                        class="btn dme-btn-outlined-blue">Gå videre</button>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="u-mb64">
                                <button type="button" id="btn_manual_entry" class="prevent link" data-toggle="collapse" data-target="#form_manual_entry">Jeg har ikke organisasjonsnummer</button>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 collapse show" id="form_manual_entry">
                    <form>
                        <div class="form-group row">
                            <div class="col-md-12">
                                manual entry
                                <label for="">Org.Nr.</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" placeholder="9 siffer" name="org_number">
                            </div>
                            <div class="col-md-3">
                                <button type="submit"
                                        class="btn dme-btn-outlined-blue">Gå videre</button>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="u-mb64">
                                <button type="button" id="btn_org_number" class="prevent link" data-toggle="collapse" data-target="#form_org_number">Org.Nr.</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="font-weight-normal">Dette får du som bedriftskunde</h3>
                    <div class="row">
                        <div class="col-md-4">
                                <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Gratis bedriftsprofil</h4>
                                <p>Kandidater får en god oversikt over alle aktive stillinger i bedriften, og de kan følge
                                    bedriften for
                                    å bli varslet når en ny stilling legges ut
                                </p>
                        </div>
                        <div class="col-md-4">
                                <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Søknadene samles i ett enkelt system</h4>
                                <p>Du får oversikt over alle søkere på dine stillinger samlet på ett sted</p>
                        </div>
                        <div class="col-md-4">
                                <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Det koster ingenting å bli bedriftkunde</h4>
                                <p>Du betaler bare for de annonsene du har lagt ut</p>
                        </div>
                        <div class="col-md-4">
                                <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Rabatterte priser</h4>
                                <p class="u-mb0">Basert på antall annonser du legger ut.</p><a href="/prisoversikt">Se
                                    prisoversikt
                                    her</a>
                        </div>
                        <div class="col-md-4">
                                <h4 class="u-t4"><span class="fa fa-check-circle color-maroon" style="font-size: 16px;"></span> Månedlig faktura</h4>
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
            })
        })
    </script>
@endsection
