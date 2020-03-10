<style>
    .dme-btn-outlined-blue{

    }

</style>
<main class="dme-wrapper">
        <div class="container">
            <div style="min-height: 350px;" class="row">
            <div class="col-md-6 offset-md-3 text-center align-self-center">
                <div class="">
                    <img src="{{ asset('public/images/NorgesHondel-logo.png')}}" alt="NorgesHandel" style="max-width: 200px;" class="light-logo img-fluid">
                    <h3 class="u-t3 pt-3">
                        Hei {{$user->username ? $user->username : ''}},
                    </h3>
                    <p>
                        Du har nylig lagt til følgende epost i din Schibsted-konto:<br>
                        <b>{{$to_email}}</b><br>
                        Bekreft at dette er din korrekte e-postadresse ved å klikke på denne linken.
                    </p>
                    <a href="#" style="  border: 2px solid #ac304a;
                                background-color: #fff;
                                border-radius: 8px;
                                padding: 8px 12px !important;
                                cursor: pointer;
                                font-weight: bold;
                                transition: all 0.5s;
                                color: #ac304a;
                                text-decoration: none;"
                    >Bekreft min e-post adresse</a>
                    <br>
                    <p>Hilsen</p>
                    <p><a href="{{ asset('public/images/NorgesHondel-logo.png')}}">NorgesHandel</a></p>
                </div>
            </div>
            </div>
        </div>
    </main>
