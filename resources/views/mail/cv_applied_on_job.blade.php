    <main class="dme-wrapper">
        <div class="container">
            <div style="min-height: 350px;" class="row">
            <div class="col-md-6 offset-md-3 text-center align-self-center">
                <div class="">
                    <img src="{{ asset('public/images/NorgesHondel-logo.png')}}" alt="NorgesHandel" style="max-width: 200px;" class="light-logo img-fluid">
                    <h3 class="u-t3 pt-3">
                        Hei, {{$apply_job->name}}!
                    </h3>
                    <p>Takk for søknaden din på stillingen "<a href="{{route('jobs.show',$apply_job->job_id)}}" target="_blank">{{$apply_job->job->title}}</a>"</p>
                    <br>
                    <p><b>Her er kontaktinformasjonen du sendte:</b></p>
                    <p>Navn: {{$apply_job->name}}</p>
                    <p>E-post: {{$apply_job->email}}</p>
                    <p>Telefon: {{$apply_job->telephone}}</p>
                    <p>Antall vedlegg: {{$file_name}}</p>
                    <p>Lykke til!</p>
                    <br>
                    <p>Hilsen</p>
                    <p><a href="{{ asset('public/images/NorgesHondel-logo.png')}}">NorgesHandel</a></p>
                </div>
            </div>
            </div>
        </div>
    </main>
