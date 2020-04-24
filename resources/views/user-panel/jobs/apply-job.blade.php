@extends('layouts.landingSite')
@section('page_content')
    <main class="public_profile">
        <div class="dme-container py-4">
            <div class="col-md-12">

                @include('common.partials.flash-messages')
                
                <div class="col-md-6">
                    <p>Søk på stilling som {{$job->title}} i {{$job->emp_name}}</p>
                </div>
                <hr>

                <form action="{{route('applied-jobs.update',$job->id)}}" method="post" method="post" id="applied_job" enctype="multipart/form-data">
                    @csrf @method('PATCH')

                    <div class="form-group col-md-6">
                        <h6>Vedlegg</h6>

                        <label title="Du må fylle ut ditt nåværende passord">
                            Last opp søknadsdokumenter
                        </label>

                        <p class="norgeshandel-section d-none">
                            <a class="norgeshandel-cv">Norgeshandel-cv.pdf</a>
                            <span class="remove-selected-file-button remove_noregeshandel_cv pl-2"><i class="fa fa-trash  mt-1"></i></span>
                        </p>

                        <input type="file" name="cv" id="cv" class="cv_pdf" accept="application/pdf" required>
                        <span class="remove-selected-file-button remove_cv_pdf d-none"><i class="fa fa-trash fa-lg mt-1"></i></span>
                        <p class="pt-2">
                            <a href="#" class="choose-norgeshandel-cv">Bruk min CV på NorgesHandel</a>
                        </p>

                        <input type="hidden" class="cv-status" value="{{(Auth::user() && Auth::user()->cv && Auth::user()->cv->personal && Auth::user()->cv->personal->title && Auth::user()->cv->personal->first_name && Auth::user()->cv->personal->last_name && Auth::user()->cv->personal->address) ? 'success' : 'failure'}}">

                    </div>

                    <hr>

                    <h6 class="p-3">Personlige detaljer</h6>

                    <div class="form-group col-md-6">
                        <label title="Navn">
                            Navn
                        </label>
                        <input type="text" name="name" class="dme-form-control col-md-12"  />
                    </div>

                    <div class="form-group col-md-6">
                        <label title="Epost">
                            Epost
                        </label>
                        <input type="email" name="email" class="dme-form-control col-md-12"  />
                    </div>

                    <div class="form-group col-md-6">
                        <label title="Telefon">
                            Telefon
                        </label>
                        <input type="text" name="telephone" class="dme-form-control col-md-12"  />
                    </div>

                    <div class="form-group col-md-6">
                        <label title="Fødselsår">
                            Fødselsår
                        </label>
                        <input type="text" name="dob" class="dme-form-control col-md-12"  />
                    </div>


                    <div class="form-group col-md-6">
                        <label title="Fødselsår">
                            Utdannelse
                        </label>
                        <select name="education" class="dme-form-control" id="UserUserGender">
                            <option value=""></option>
                            <option value="Grunnskole">Grunnskole</option>
                            <option value="Videregående/yrkesskole">Videregående/yrkesskole</option>
                            <option value="Folkehøyskole">Folkehøyskole</option>
                            <option value="Etatsutdannelse">Etatsutdannelse</option>
                            <option value="1-2 års høyskole/universitet">1-2 års høyskole/universitet</option>
                            <option value="2-4 års høyskole/universitet">2-4 års høyskole/universitet</option>
                            <option value="4 + års høyskole/universitet">4 + års høyskole/universitet</option>
                            <option value="PhD">PhD</option>
                        </select>

                    </div>

                    <div class="form-group col-md-6">
                        <label title="Nåværende stilling">
                            Nåværende stilling
                        </label>
                        <input type="text" name="current_position" class="dme-form-control col-md-12"  />
                    </div>

                    <div class="form-group col-md-6">
                        <label title="Nåværende stilling">
                            Søkertekst (valgfritt)
                        </label>
                        <textarea type="text" name="note" class="dme-form-control col-md-12"></textarea>
                    </div>
                    <hr>

                    <input type="submit" value="Søk stilling" class="dme-btn-outlined-blue ml-3">
                    <a href="{{route('jobs.show',$job->id)}}">Tilbake til annonsen</a>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function (e) {

            // Choose external CV to apply the job
            $(document).on('change', '.cv_pdf', function (e) {

                $('.remove_cv_pdf').addClass('d-none');
                if (this.files.length > 0) {
                    $('.remove_cv_pdf').removeClass('d-none');
                    $('.cv_pdf').css('pointer-events','none');
                    $('.choose-norgeshandel-cv').css('pointer-events','none');
                }
            });

            //Remove CV from input type
            $(document).on('click', '.remove_cv_pdf', function () {
                var $el = $('.cv_pdf');
                $el.wrap('<form>').closest('form').get(0).reset();
                $el.unwrap();
                $('.remove_cv_pdf').addClass('d-none');
                $('.cv_pdf').css('pointer-events','auto');
                $('.choose-norgeshandel-cv').css('pointer-events','auto');
            });


            //Add Norgeshandel CV
            $(document).on('click', '.choose-norgeshandel-cv', function () {
                if($('.cv-status').val() == 'success'){
                    $('.cv_pdf').attr('disabled','disabled');
                    $('.cv_pdf').removeAttr('required');
                    $('.norgeshandel-section').removeClass('d-none');
                    $('#cv-error').css('display','none');
                }else{
                    alert('Beklager, du kan ikke laste opp Norgeshandel CV. Du må fylle den før du søker på jobb.');
                }
            });

            //Remove Notrgeshandel
            $(document).on('click', '.remove_noregeshandel_cv', function () {
                $('.cv_pdf  ').removeAttr('disabled');
                $('.cv_pdf').prop('required','true');
                $('.norgeshandel-section').addClass('d-none');
            });
        });
    </script>
@endsection
