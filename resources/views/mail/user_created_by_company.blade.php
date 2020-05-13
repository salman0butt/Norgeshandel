    <main class="dme-wrapper">
        <div class="container">
            <div style="min-height: 350px;" class="row">
            <div class="col-md-6 offset-md-3 text-center align-self-center">
                <div class="">
                    <img src="{{ asset('public/images/NorgesHondel-logo.png')}}" alt="NorgesHandel" style="max-width: 200px;" class="light-logo img-fluid">
                    <h3 class="u-t3 pt-3">
                        Hei,
                    </h3>
                    <p>Vi vil informere deg om at {{$user->created_by_company && $user->created_by_company->emp_name ? $user->created_by_company->emp_name : ''}} har opprettet profilen din hos NorgesHandel.</p>
                    <br>
                    <p><b>Her er kontodetaljer</b></p>
                    <p>E-post: {{$user->email}}</p>
                    <p>Passord: {{$password}}</p>
                    <br>
                    <p>Logg inn på <a href="{{url('login')}}">NorgesHandel</a></p>
                    <br>
                    <p>Hilsen</p>
                    <p><a href="{{ asset('public/images/NorgesHondel-logo.png')}}">NorgesHandel</a></p>
                </div>
            </div>
            </div>
        </div>
    </main>
