<main class="dme-wrapper">
    <div class="container">
        <div style="min-height: 350px;" class="row">
            <div class="col-md-6 offset-md-3 text-center align-self-center">
                <div class="">
                    <img src="{{ asset('public/images/NorgesHondel-logo.png')}}" alt="NorgesHandel" style="max-width: 200px;" class="light-logo img-fluid">
                    <h3 class="u-t3 pt-3">
                        Hei,
                    </h3>
                    <p>
                        Vi vil informere deg om at {{$apply_job->user && $apply_job->user->username ? $apply_job->user->username : ''}} søkte Cv på din {{$apply_job->job && $apply_job->job->title ? $apply_job->job->title : ''}} jobb.
                    </p>
                    <p>
                        Logg inn på <a href="{{route('login')}}">NorgesHandel</a> for å se detaljene.</p>
                    <br>
                    <p>Hilsen</p>
                    <p><a href="{{ asset('public/images/NorgesHondel-logo.png')}}">NorgesHandel</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
