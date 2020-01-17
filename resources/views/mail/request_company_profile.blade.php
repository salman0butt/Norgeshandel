<main class="dme-wrepper">
    <div class="dme-container">
        <div style="min-height: 350px;" class="row">
            <div class="col-md-6 offset-md-3 text-center align-self-center">
                <div class="">
{{--                    <img src="{{asset('public/images/NorgesHondel-logo.png')}}" alt="NorgesHandel" style="max-width: 200px;" class="light-logo img-fluid">--}}
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
                    <h4>
                        Firma detaljer:
                    </h4>
                    @if($form_type == "org_number")
                        <table>
                            <tr>
                                <td>Org.Nr.&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$org_number}}</td>
                            </tr>
                            <tr>
                                <td>Org. Type&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$type}}</td>
                            </tr>
                        </table>
                    @elseif($form_type == "manual_entry")
                        <table>
                            <tr>
                                <td>Firmanavn.&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$org_name}}</td>
                            </tr>
                            <tr>
                                <td>Kontaktperson&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$contact_name}}</td>
                            </tr>
                            <tr>
                                <td>Email&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$contact_email}}</td>
                            </tr>
                            <tr>
                                <td>Telephone&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$contact_phone}}</td>
                            </tr>
                            <tr>
                                <td>Andre detaljer&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$comment}}</td>
                            </tr>
                        </table>
                    @endif

                    <br>
                    <p><a href="{{url('admin/users')}}">Klikk her for å fortsette</a></p>
                    <p><a href="{{ url('/')}}">NorgesHandel</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
