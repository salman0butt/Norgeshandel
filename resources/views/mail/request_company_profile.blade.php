<main class="dme-wrepper">
    <div class="container">
        <div style="min-height: 350px;" class="row">
            <div class="col-md-6 offset-md-3 text-center align-self-center">
                <div class="">
                    <img src="{{asset('public/images/NorgesHondel-logo.png')}}" alt="NorgesHandel" style="max-width: 200px;" class="light-logo img-fluid">
                    <h3 class="u-t3 pt-3">
                        Hei NorgesHandel
                    </h3>
                    <p>
                        Du fikk en ny forespørsel om firmaprofil fra følgende bruker:
                    </p>
                    <table>
                        <tr>
                            <td>Firmanavn:</td>
                            <td>{{$username}}</td>
                        </tr>
                        <tr>
                            <td>Visningsnavn:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td>{{$username}}</td>
                        </tr>
                        <tr>
                            <td>E-post:</td>
                            <td><a href="mailto:{{$email}}">{{$email}}</a></td>
                        </tr>
                    </table>
                    <br>
                    <p><a href="{{url('admin/users')}}">Klikk her for å fortsette</a></p>
                    <p><a href="{{ url('/')}}">NorgesHandel</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
