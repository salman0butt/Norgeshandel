@extends('layouts.landingSite')

@section('page_content')
    <style type="text/css">
        a.edit-btn {
            font-size: 15px;
            border: 1px solid;
            padding: 2px 14px;
            font-weight: 400;
        }

        .table-main {
            padding: 25px 20px 72px;
            background-color: rgba(176, 64, 88, 0.07);
            margin-top: 50px;
            border-radius: 4px;
        }

        .row-border {
            border-bottom: 1px solid #ccc;
        }

        tbody th, tbody tr {
            border-top: 1px solid #dfe4e8;
            vertical-align: top;
            font-weight: 400;
        }

        .row.row-border {
            padding-bottom: 30px;
        }
    </style>
    <main class="cv">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Min handel </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Your CV</li>
                    </ol>
                </nav>
            </div>
            <div class="mt-5 mb-5">
                <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Din CV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false">CV-innstillinger</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                           aria-controls="contact" aria-selected="false">Dine forespørsler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="preview-tab" data-toggle="tab" href="#preview" role="tab"
                           aria-controls="preview" aria-selected="false">Forhåndsvis CV</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">Your CV<span
                                    class="float-right"><a href="#"><img src="{{asset('public/images/united-kingdom.svg')}}" width="16px"></a> <a href="#">
                                        <img src="{{asset('public/images/norway.svg')}}" width="20px"></a></span></h3>
                            <p class="text-dark">CVen din er inaktiv, med utløpsdato 08.09.2019. Personlige detaljer er
                                ikke synlige.</p>
                            <p class="text dark pt-5 pb-5">CVen din kan bare vises av våre kunder når du har registrert
                                personopplysninger og utdanning eller erfaring.</p>

                            <hr>
                            <div class="row">
                                <div class="col-md-6 mt-4 mb-4">

                                    <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:22px;">
                                        Personalia <span class="float-right"><a href="#"
                                                                                class="edit-btn"> Endre</a></span></h3>

                                    <div class="table-main">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">CV-tittel *</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                                <small id="emailHelp" class="form-text text-muted">F.eks "Bachelor med 4
                                                    års erfaring som regnskapsfører" eller "Anestesisykepleier med
                                                    betydelig erfaring fra akuttmedisin, ambulansetjeneste og kirurgi
                                                    utført på polikliniske pasienter"</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput2">Fornavn*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput3">Etternavn*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput4">Adresse*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput5">Postnummer*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput6">Poststed*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput7">Land*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlemail">E-post*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput8">Telefon*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput8">Mobil*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Gender*</label>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option>Choose</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Occupational status*</label>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option value="0" selected="selected">Choose</option>
                                                    <option value="1">Job hunting</option>
                                                    <option value="2">Part time job</option>
                                                    <option value="3">Permanent</option>
                                                    <option value="4">Freelance</option>
                                                    <option value="5">Self employed</option>
                                                    <option value="6">Student</option>
                                                    <option value="7">Temporary employed</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput8">Homepage*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                                <small id="Help" class="form-text text-muted"> Only to be filled in if
                                                    you have a homepage or profile page</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput8">Drivers license*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                                <small id="Help" class="form-text text-muted"> E.g. A, B, C1 or
                                                    D1E</small>
                                            </div>


                                            <a class="dme-btn-outlined-blue float-left" href="/NorgesHandel/user.php">
                                                <div class="ml-2">Save changes</div>
                                            </a>
                                            <a class="dme-btn-outlined-blue float-left ml-2"
                                               href="/NorgesHandel/user.php">
                                                <div class="ml-2">Cancel</div>
                                            </a>
                                        </form>
                                    </div>

                                </div>

                                <!--================================
                                      tab 1 form
                          ====================================-->

                                <div class="col-md-6  mb-4">
                                    <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:22px;">Bilde
                                        <span class="float-right">

                          <p>
                              <a class="edit-btn" data-toggle="collapse" href="#colapsedata" role="button"
                                 aria-expanded="false" aria-controls="colapsedata">
                                Endre
                              </a>

                            </p>

                          </span></h3>
                                    <small id="Help" class="form-text text-muted pl-4 pr-4 mb-5"> Du har ikke lagret et
                                        bilde til din CV.</small>
                                    <div class="collapse" id="colapsedata">
                                        <div class="card card-body">
                                            <form>
                                                <input type="file">
                                            </form>
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <!--================================
                                      tab 1 profile
                          ====================================-->
                        </div>
                        <hr>
                        <div class="row row-border">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">Utdanning
                                    <span class="float-right"> <a class="edit-btn" data-toggle="collapse"
                                                                  href="#colapedu" role="button" aria-expanded="false"
                                                                  aria-controls="colapedu">Legg til</a></span></h3>
                                <small id="Help" class=" font-weight-normal form-text text-muted pl-4 pr-4 pb "> Ingen
                                    utdannelse er registrert</small>
                                <div class="collapse" id="colapedu" style="margin-top: -40px;">
                                    <div class="table-main">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Skole *</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                                <small id="emailHelp" class="form-text text-muted">F.eks "Bachelor med 4
                                                    års erfaring som regnskapsfører" eller "Anestesisykepleier med
                                                    betydelig erfaring fra akuttmedisin, ambulansetjeneste og kirurgi
                                                    utført på polikliniske pasienter"</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Fag*</label>
                                                <select name="education.tradeValueId" id="trade" class="form-control"
                                                        required="true">
                                                    <option value="0">Velg..</option>
                                                    <option value="74">Annet</option>
                                                    <option value="1">Allmennfag</option>
                                                    <option value="2">Arkeologi</option>
                                                    <option value="3">Astronomi</option>
                                                    <option value="73">Automasjon</option>
                                                    <option value="4">Bibliotek</option>
                                                    <option value="5">Billedkunst</option>
                                                    <option value="6">Biologi</option>
                                                    <option value="67">Business</option>
                                                    <option value="7">Bygg og anlegg</option>
                                                    <option value="8">Dans</option>
                                                    <option value="9">Data og Internett</option>
                                                    <option value="10">Design</option>
                                                    <option value="11">Elektrofag</option>
                                                    <option value="12">Energiteknikk</option>
                                                    <option value="70">Entreprenørskap</option>
                                                    <option value="13">Farmasi</option>
                                                    <option value="14">Film og TV</option>
                                                    <option value="15">Filosofi</option>
                                                    <option value="16">Flyskoler</option>
                                                    <option value="17">Fysikk</option>
                                                    <option value="18">Fysioterapi</option>
                                                    <option value="19">Geofag</option>
                                                    <option value="20">Havbruk og fiske</option>
                                                    <option value="21">Helsefag</option>
                                                    <option value="22">Historie</option>
                                                    <option value="59">Hotell og restaurant</option>
                                                    <option value="63">HR og personal</option>
                                                    <option value="23">Idrett</option>
                                                    <option value="24">Informatikk</option>
                                                    <option value="71">Innovasjon</option>
                                                    <option value="25">Journalistikk</option>
                                                    <option value="26">Jus</option>
                                                    <option value="27">Kjemi</option>
                                                    <option value="60">Kultur</option>
                                                    <option value="28">Landbruk</option>
                                                    <option value="29">Litteratur</option>
                                                    <option value="64">Logistikk</option>
                                                    <option value="30">Marinteknologi</option>
                                                    <option value="58">Markedsføring</option>
                                                    <option value="31">Maskinteknikk</option>
                                                    <option value="32">Matematikk</option>
                                                    <option value="33">Mediefag</option>
                                                    <option value="34">Medisin</option>
                                                    <option value="35">Militærvesen</option>
                                                    <option value="66">Molekylærbiologi</option>
                                                    <option value="36">Musikk</option>
                                                    <option value="37">Natur- og miljøvern</option>
                                                    <option value="38">Naturfag</option>
                                                    <option value="39">Odontologi</option>
                                                    <option value="61">Organisasjon og ledelse</option>
                                                    <option value="40">Pedagogikk</option>
                                                    <option value="65">Politifag</option>
                                                    <option value="75">PR og kommunikasjon</option>
                                                    <option value="41">Psykologi</option>
                                                    <option value="42">Realfag</option>
                                                    <option value="43">Reiseliv</option>
                                                    <option value="44">Samfunn og politikk</option>
                                                    <option value="45">Sjøfart</option>
                                                    <option value="46">Skogbruk</option>
                                                    <option value="47">Sosialantropologi</option>
                                                    <option value="69">Sos-pedagogikk</option>
                                                    <option value="48">Sosiologi</option>
                                                    <option value="68">Spes-pedagogikk</option>
                                                    <option value="49">Språk</option>
                                                    <option value="62">Strategi og ledelse</option>
                                                    <option value="72">Svakstrøm</option>
                                                    <option value="50">Sykepleie</option>
                                                    <option value="51">Teater</option>
                                                    <option value="52">Tekniske fag</option>
                                                    <option value="53">Teologi</option>
                                                    <option value="54">Veterinærmedisin</option>
                                                    <option value="55">Yrkesfag</option>
                                                    <option value="56">Zoologi</option>
                                                    <option value="57">Økonomi</option>


                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput2">Fornavn*</label>
                                                <select name="education.levelValueId" id="level" class="form-control"
                                                        required="true">
                                                    <option value="0">Velg..</option>
                                                    <option value="2">Vgs/Yrkesskole</option>
                                                    <option value="1">Folkehøgskole</option>
                                                    <option value="7">Etatsutdannelse</option>
                                                    <option value="9">Fagskole</option>
                                                    <option value="3">1-2 år høy. utd</option>
                                                    <option value="4">Bachelor</option>
                                                    <option value="8">4 årig Høyskole/Universitet</option>
                                                    <option value="5">Master</option>
                                                    <option value="6">Phd</option>
                                                    <option value="74">Annet</option>


                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput3">Grad*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp">
                                                <small>Velg det som passer best i nedtrekksfeltet og evt. spesifiser
                                                    grad</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Beskrivelse</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                          rows="3"></textarea>
                                            </div>


                                            <a class="dme-btn-outlined-blue float-left" href="/NorgesHandel/user.php">
                                                <div class="ml-2">Save changes</div>
                                            </a>
                                            <a class="dme-btn-outlined-blue float-left ml-2"
                                               href="/NorgesHandel/user.php">
                                                <div class="ml-2">Cancel</div>
                                            </a>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row row-border">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">Erfaring <span class="float-right"> <a class="edit-btn" data-toggle="collapse" href="#colapeder" role="button" aria-expanded="false" aria-controls="colapeder">Legg til</a></span></h3>
                                <small id="Help" class=" font-weight-normal form-text text-muted pl-4 pr-4 pb "> Ingen utdannelse er registrert</small>
                                <div class="collapse" id="colapeder" style="margin-top: -40px;">
                                    <div class="table-main">
                                        <form>
                                            <div class="formelement">
                                                <label class="required">Periode fra</label>
                                                <div class="input">

                                                    <div class="line">
                                                        <input type="hidden" name="from.day" value="1" id="form_from_day">

                                                        <select name="from.month" id="fromMonth" class="span2" required="true">
                                                            <option value="1">Jan</option>
                                                            <option value="2">Feb</option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Apr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun</option>
                                                            <option value="7">Jul</option>
                                                            <option value="8">Aug</option>
                                                            <option value="9">Sep</option>
                                                            <option value="10">Okt</option>
                                                            <option value="11">Nov</option>
                                                            <option value="12">Des</option>


                                                        </select>



                                                        <select name="from.year" id="fromYear" class="span2">
                                                            <option value="2019">2019</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2012">2012</option>
                                                            <option value="2011">2011</option>
                                                            <option value="2010">2010</option>
                                                            <option value="2009">2009</option>
                                                            <option value="2008">2008</option>
                                                            <option value="2007">2007</option>
                                                            <option value="2006">2006</option>
                                                            <option value="2005">2005</option>
                                                            <option value="2004">2004</option>
                                                            <option value="2003">2003</option>
                                                            <option value="2002">2002</option>
                                                            <option value="2001">2001</option>
                                                            <option value="2000">2000</option>
                                                            <option value="1999">1999</option>
                                                            <option value="1998">1998</option>
                                                            <option value="1997">1997</option>
                                                            <option value="1996">1996</option>
                                                            <option value="1995">1995</option>
                                                            <option value="1994">1994</option>
                                                            <option value="1993">1993</option>
                                                            <option value="1992">1992</option>
                                                            <option value="1991">1991</option>
                                                            <option value="1990">1990</option>
                                                            <option value="1989">1989</option>
                                                            <option value="1988">1988</option>
                                                            <option value="1987">1987</option>
                                                            <option value="1986">1986</option>
                                                            <option value="1985">1985</option>
                                                            <option value="1984">1984</option>
                                                            <option value="1983">1983</option>
                                                            <option value="1982">1982</option>
                                                            <option value="1981">1981</option>
                                                            <option value="1980">1980</option>
                                                            <option value="1979">1979</option>
                                                            <option value="1978">1978</option>
                                                            <option value="1977">1977</option>
                                                            <option value="1976">1976</option>
                                                            <option value="1975">1975</option>
                                                            <option value="1974">1974</option>
                                                            <option value="1973">1973</option>
                                                            <option value="1972">1972</option>
                                                            <option value="1971">1971</option>
                                                            <option value="1970">1970</option>
                                                            <option value="1969">1969</option>
                                                            <option value="1968">1968</option>
                                                            <option value="1967">1967</option>
                                                            <option value="1966">1966</option>
                                                            <option value="1965">1965</option>
                                                            <option value="1964">1964</option>
                                                            <option value="1963">1963</option>
                                                            <option value="1962">1962</option>
                                                            <option value="1961">1961</option>
                                                            <option value="1960">1960</option>
                                                            <option value="1959">1959</option>
                                                            <option value="1958">1958</option>
                                                            <option value="1957">1957</option>
                                                            <option value="1956">1956</option>
                                                            <option value="1955">1955</option>
                                                            <option value="1954">1954</option>
                                                            <option value="1953">1953</option>
                                                            <option value="1952">1952</option>
                                                            <option value="1951">1951</option>
                                                            <option value="1950">1950</option>
                                                            <option value="1949">1949</option>
                                                            <option value="1948">1948</option>
                                                            <option value="1947">1947</option>
                                                            <option value="1946">1946</option>
                                                            <option value="1945">1945</option>
                                                            <option value="1944">1944</option>
                                                            <option value="1943">1943</option>
                                                            <option value="1942">1942</option>
                                                            <option value="1941">1941</option>
                                                            <option value="1940">1940</option>
                                                            <option value="1939">1939</option>
                                                            <option value="1938">1938</option>
                                                            <option value="1937">1937</option>
                                                            <option value="1936">1936</option>
                                                            <option value="1935">1935</option>
                                                            <option value="1934">1934</option>


                                                        </select>


                                                    </div>

                                                    til

                                                    <div class="line">
                                                        <input type="hidden" name="to.day" value="1" id="form_to_day">

                                                        <select name="to.month" id="toMonth" class="span2">
                                                            <option value="1">Jan</option>
                                                            <option value="2">Feb</option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Apr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun</option>
                                                            <option value="7">Jul</option>
                                                            <option value="8">Aug</option>
                                                            <option value="9">Sep</option>
                                                            <option value="10">Okt</option>
                                                            <option value="11">Nov</option>
                                                            <option value="12" selected="selected">Des</option>


                                                        </select>




                                                        <select name="to.year" id="toYear" class="span2">
                                                            <option value="2019" selected="selected">2019</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2016">2016</option>



                                                        </select>


                                                    </div>

                                                    <label for="untilPresent" class="inline mlm">
                                                        <input type="checkbox" name="to.untilPresent" value="true" id="untilPresent" class="checkbox">
                                                        <input type="hidden" name="__checkbox_to.untilPresent" value="true">

                                                        <span>Er fortsatt i studiet</span>
                                                    </label>


                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Skole *</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Stillingstittel *</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Fag*</label>
                                                <select name="education.tradeValueId" id="trade" class="form-control" required="true">
                                                    <option value="0">Velg..</option>
                                                    <option value="74">Annet</option>
                                                    <option value="1">Allmennfag</option>
                                                    <option value="2">Arkeologi</option>
                                                    <option value="3">Astronomi</option>
                                                    <option value="73">Automasjon</option>
                                                    <option value="4">Bibliotek</option>
                                                    <option value="5">Billedkunst</option>
                                                    <option value="6">Biologi</option>
                                                    <option value="67">Business</option>
                                                    <option value="7">Bygg og anlegg</option>
                                                    <option value="8">Dans</option>
                                                    <option value="9">Data og Internett</option>
                                                    <option value="10">Design</option>
                                                    <option value="11">Elektrofag</option>
                                                    <option value="12">Energiteknikk</option>
                                                    <option value="70">Entreprenørskap</option>
                                                    <option value="13">Farmasi</option>
                                                    <option value="14">Film og TV</option>
                                                    <option value="15">Filosofi</option>
                                                    <option value="16">Flyskoler</option>
                                                    <option value="17">Fysikk</option>
                                                    <option value="18">Fysioterapi</option>
                                                    <option value="19">Geofag</option>
                                                    <option value="20">Havbruk og fiske</option>
                                                    <option value="21">Helsefag</option>
                                                    <option value="22">Historie</option>
                                                    <option value="59">Hotell og restaurant</option>
                                                    <option value="63">HR og personal</option>
                                                    <option value="23">Idrett</option>
                                                    <option value="24">Informatikk</option>
                                                    <option value="71">Innovasjon</option>
                                                    <option value="25">Journalistikk</option>
                                                    <option value="26">Jus</option>
                                                    <option value="27">Kjemi</option>
                                                    <option value="60">Kultur</option>
                                                    <option value="28">Landbruk</option>
                                                    <option value="29">Litteratur</option>
                                                    <option value="64">Logistikk</option>
                                                    <option value="30">Marinteknologi</option>
                                                    <option value="58">Markedsføring</option>
                                                    <option value="31">Maskinteknikk</option>
                                                    <option value="32">Matematikk</option>
                                                    <option value="33">Mediefag</option>
                                                    <option value="34">Medisin</option>
                                                    <option value="35">Militærvesen</option>
                                                    <option value="66">Molekylærbiologi</option>
                                                    <option value="36">Musikk</option>
                                                    <option value="37">Natur- og miljøvern</option>
                                                    <option value="38">Naturfag</option>
                                                    <option value="39">Odontologi</option>
                                                    <option value="61">Organisasjon og ledelse</option>
                                                    <option value="40">Pedagogikk</option>
                                                    <option value="65">Politifag</option>
                                                    <option value="75">PR og kommunikasjon</option>
                                                    <option value="41">Psykologi</option>
                                                    <option value="42">Realfag</option>
                                                    <option value="43">Reiseliv</option>
                                                    <option value="44">Samfunn og politikk</option>
                                                    <option value="45">Sjøfart</option>
                                                    <option value="46">Skogbruk</option>
                                                    <option value="47">Sosialantropologi</option>
                                                    <option value="69">Sos-pedagogikk</option>
                                                    <option value="48">Sosiologi</option>
                                                    <option value="68">Spes-pedagogikk</option>
                                                    <option value="49">Språk</option>
                                                    <option value="62">Strategi og ledelse</option>
                                                    <option value="72">Svakstrøm</option>
                                                    <option value="50">Sykepleie</option>
                                                    <option value="51">Teater</option>
                                                    <option value="52">Tekniske fag</option>
                                                    <option value="53">Teologi</option>
                                                    <option value="54">Veterinærmedisin</option>
                                                    <option value="55">Yrkesfag</option>
                                                    <option value="56">Zoologi</option>
                                                    <option value="57">Økonomi</option>


                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput3">Grad*</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                <small>Velg det som passer best i nedtrekksfeltet og evt. spesifiser grad</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Beskrivelse</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>


                                            <a class="dme-btn-outlined-blue float-left" href="/NorgesHandel/user.php">
                                                <div class="ml-2">Save changes</div>
                                            </a>
                                            <a class="dme-btn-outlined-blue float-left ml-2" href="/NorgesHandel/user.php">
                                                <div class="ml-2">Cancel</div>
                                            </a>
                                        </form>
                                    </div>

                                </div>
                            </div>




                        </div>
                        <div class="row row-border">



                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">Nøkkelkompetanse <span class="float-right"> <a class="edit-btn" data-toggle="collapse" href="#colapednok" role="button" aria-expanded="false" aria-controls="colapednok">Legg til</a></span></h3>
                                <small id="Help" class=" font-weight-normal form-text text-muted pl-4 pr-4 pb "> Ingen utdannelse er registrert</small>
                                <div class="collapse" id="colapednok" style="margin-top: -40px;">
                                    <div class="table-main">
                                        <form>


                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Nøkkelkompetanse</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                <small>F.eks. "Anestesisykepleier med bred erfaring innen akutt medisin, ambulansetransport, sentraloperasjon og dagkirurgi."</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Annen erfaring, tillitsverv, interesser etc.</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>


                                            <a class="dme-btn-outlined-blue float-left" href="/NorgesHandel/user.php">
                                                <div class="ml-2">Save changes</div>
                                            </a>
                                            <a class="dme-btn-outlined-blue float-left ml-2" href="/NorgesHandel/user.php">
                                                <div class="ml-2">Cancel</div>
                                            </a>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row row-border">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">Language<span class="float-right"><a href="#" class="edit-btn"> Add</a></span></h3>
                                <small id="Help" class=" font-weight-normal form-text text-muted pl-4 pr-4 mb-5"> No Language is registered</small>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">Preferences for future positions  <span class="float-right"><a href="#" class="edit-btn"> Edit</a></span></h3>

                                <div class="mhl pl-4 pr-4">
                                    <table class="sectioninfo super-condensed border-white w-100" cellspacing="0" summary="Preferences for future positions">
                                        <tbody><tr>
                                            <th class="th_row size1of4" scope="row">Job category</th>
                                            <td id="float-left">Not given</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Personnel responsibility</th>
                                            <td id="future-personnel"></td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Result responsibility</th>
                                            <td id="future-accountmanager"></td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Ready to relocate</th>
                                            <td id="future-move"></td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Maximum days of travel per year</th>
                                            <td id="future-travel"></td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Salary</th>
                                            <td id="future-salary"></td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Term of notice in current position</th>
                                            <td id="future-period">Not given</td>
                                        </tr>
                                        </tbody></table>
                                </div>


                            </div>
                        </div>
                        <p class="pt-5 pb-5 pl-4 pr-4 text-dark">Your CV can only be viewed by our customers when you have registered personal details and education or experience.</p>
                        <p class="text-dark pl-4 pr-4">10670303</p>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="inner-tab">
                            <p class="text-dark pb-4">Your CV can only be viewed by our customers when you have
                                registered
                                personal details and education or experience.</p>
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">CV Setting</h3>
                            <p class="text-dark pb-4">This is where you manage your CV. Remember to keep it updated with
                                your latest information. This way your chances of being contacted by potential employers
                                will increase.</p>
                        </div>

                        <div class="row row-border pb-4" style="border-top:1px solid #ccc">
                            <div class="col-md-4 pt-4"><p class="text-dark ">Your CVs</p></div>
                            <div class="col-md-8"><p class="text-dark ">
                                </p>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="check1" name="vehicle1"
                                                   value="something" @if($cv->status==="published") checked @endif>Published
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="check2">
                                            <input type="checkbox" class="form-check-input" id="check2" name="vehicle2"
                                                   value="something" @if($cv->status==="inactive") checked @endif>Inactive
                                        </label>
                                    </div>
                                    <p class="text-dark pt-3">When your CV is published, it will be available for all
                                        companies who uses NorgesHandel. You will have to register either a valid
                                        education
                                        or a valid experience before the CV is published.</p>
                                </div>

                                <p></p></div>
                        </div>
                        <div class="row row-border pb-4">
                            <div class="col-md-4 pt-4"><p class="text-dark ">Show personal information</p></div>
                            <div class="col-md-8"><p class="text-dark ">
                                </p>
                                <div class="form-group">

                                    <div class="form-check">
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="check1" name="vehicle1"
                                                   value="something" @if($cv->visibility==="visible") checked @endif>Personal information visible
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="check2">
                                            <input type="checkbox" class="form-check-input" id="check2" name="vehicle2"
                                                   value="something" @if($cv->visibility==="anonymous") checked @endif>Anonymous
                                        </label>
                                    </div>
                                    <p class="text-dark pt-3">Your contact information will only be visible to
                                        recruitment
                                        agencies. Other companies will have to contact you with a request in order to
                                        get
                                        access to your details. If a company requests access to your personal
                                        information,
                                        it is up to you as CV-owner to decide if they should gain access or not..</p>
                                </div>

                                <p></p></div>
                        </div>

                        <div class="row row-border ">
                            <div class="col-md-4 pt-2"><p class="text-dark ">Registered for the first time</p></div>
                            <div class="col-md-8 pt-2"><p class="text-dark ">{{date('d.m.Y', strtotime($cv->user->created_at))}}</p></div>
                        </div>
                        <div class="row row-border ">
                            <div class="col-md-4 pt-2"><p class="text-dark ">Last updated</p></div>
                            <div class="col-md-8 pt-2"><p class="text-dark ">{{date('d.m.Y', strtotime($cv->created_at))}}</p></div>
                        </div>
                        <div class="row row-border ">
                            <div class="col-md-4 pt-2"><p class="text-dark ">Your CV-number</p></div>
                            <div class="col-md-8 pt-2"><p class="text-dark ">{{$cv->id}}</p></div>
                        </div>
                        <div class="row row-border">
                            <div class="col-md-4 pt-2"><p class="text-dark ">Expires</p></div>
                            <div class="col-md-8 pt-2"><p class="text-dark ">{{date('d.m.Y', strtotime($cv->expiry))}}<a class="ml-3" href="{{url('my-business/cv/extend')}}">Another
                                        6
                                        months</a></p></div>
                        </div>
                        <div class="row row-border ">
                            <div class="col-md-4 pt-2"><p class="text-dark ">CV terms</p></div>
                            <div class="col-md-8 pt-2"><p class="text-dark "><a href="#">Read CV terms</a></p></div>
                        </div>
                        <div class="btn-group mt-3">
                            <a class="dme-btn-outlined-blue float-left" href="#">
                                <div class="ml-2">Save</div>
                            </a>
                            <a class="dme-btn-outlined-blue float-left ml-3" href="#">
                                <div class="ml-2">Delete the cv</div>
                            </a>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">Your inquiries</h3>
                            <p class="text-dark">This is where you manage your inquiries. You may accept or reject
                                these.</p>


                            <div class="mt-5 inquiries-table">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                           href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Unanswered</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                           href="#nav-profile" role="tab" aria-controls="nav-profile"
                                           aria-selected="false">Answered</a>

                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                         aria-labelledby="nav-home-tab">

                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Requested by</th>
                                                <th scope="col">On behalf of</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                         aria-labelledby="nav-profile-tab">


                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Requested by</th>
                                                <th scope="col">On behalf of</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">CV preview</h3>
                            <p class="text-dark">This preview shows how your CV will be presented for recruitment
                                agencies
                                and companies which use the NorgesHandel CV-database Previews open CV.</p>
                            <div class="row mb-5">
                                <div class="col-md-8">
                                    <div class="btn-group mt-3">
                                        <a class="dme-btn-outlined-blue float-left" href="#">
                                            <div class="ml-2">Preview of the open CV</div>
                                        </a>
                                        <a class="dme-btn-outlined-blue float-left ml-3" href="#">
                                            <div class="ml-2">Preview of the anonymous CV</div>
                                        </a>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group mt-3">
                                        <a class="dme-btn-outlined-blue float-left" href="#">
                                            <div class="ml-2">Download as PDF</div>
                                        </a>
                                        <a class="dme-btn-outlined-blue float-left ml-3" href="#">
                                            <div class="ml-2">Print CV</div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p class="pt-3">CV-id: 10670303</p>
                            <div class="table-main-1">
                                <div class="row">
                                    <div class="col-md-8 pr-4">
                                        <h3 class="text-dark font-weight-normal pt-4 pb-4" style="font-size:22px;">
                                            Personal
                                            information</h3>
                                        <table class="w-100" cellspacing="0" summary="Personal information">


                                            <tbody>
                                            <tr>
                                                <th class="th_row" scope="row">Name</th>
                                                <td id="cvdetails-name"></td>
                                            </tr>


                                            <tr>
                                                <th class="th_row" scope="row">Date of birth</th>
                                                <td id="cvdetails-birthdate"></td>
                                            </tr>


                                            <tr>
                                                <th class="th_row size1of4" scope="row">Address</th>
                                                <td id="cvdetails-address"></td>
                                            </tr>


                                            <tr>
                                                <th class="th_row" scope="row">City</th>
                                                <td id="cvdetails-postcode"></td>
                                            </tr>

                                            <tr>
                                                <th class="th_row" scope="row">Gender</th>
                                                <td id="cvdetails-gender"></td>
                                            </tr>

                                            <tr>
                                                <th class="th_row" scope="row">Country</th>
                                                <td id="cvdetails-country"></td>
                                            </tr>


                                            <tr>
                                                <th class="th_row" scope="row">Phone number</th>
                                                <td id="cvdetails-phone"></td>
                                            </tr>

                                            <tr>
                                                <th class="th_row" scope="row">Alternate phone number</th>
                                                <td id="cvdetails-phone2"></td>
                                            </tr>

                                            <tr>
                                                <th class="th_row" scope="row">E-mail</th>
                                                <td id="cvdetails-email"></td>
                                            </tr>

                                            <tr>
                                                <th class="th_row" scope="row">Homepage</th>
                                                <td id="cvdetails-homepage"></td>
                                            </tr>


                                            <tr>
                                                <th class="th_row" scope="row">Occupational status</th>
                                                <td id="cvdetails-employmentstatus"></td>
                                            </tr>

                                            <tr>
                                                <th class="th_row" scope="row">Driving licence</th>
                                                <td id="cvdetails-driverslicense"></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="text-dark font-weight-normal pt-4" style="font-size:22px;">Personal
                                            information</h3>
                                        <small class="text-dark">Picture is missing in this CV</small>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <h3 class="text-dark font-weight-normal pt-4 pb-4" style="font-size:22px;">
                                            Preferences for future positions</h3>
                                        <table class="w-100" cellspacing="0" summary="Preferences for future positions">
                                            <tbody>
                                            <tr>
                                                <th class="th_row size1of4" scope="row">Job category</th>
                                                <td id="future-jobtype">Not given</td>
                                            </tr>
                                            <tr>
                                                <th class="th_row" scope="row">Personnel responsibility</th>
                                                <td id="future-personnel"></td>
                                            </tr>
                                            <tr>
                                                <th class="th_row" scope="row">Result responsibility</th>
                                                <td id="future-accountmanager"></td>
                                            </tr>
                                            <tr>
                                                <th class="th_row" scope="row">Ready to relocate</th>
                                                <td id="future-move"></td>
                                            </tr>
                                            <tr>
                                                <th class="th_row" scope="row">Maximum days of travel per year</th>
                                                <td id="future-travel"></td>
                                            </tr>
                                            <tr>
                                                <th class="th_row" scope="row">Salary</th>
                                                <td id="future-salary"></td>
                                            </tr>
                                            <tr>
                                                <th class="th_row" scope="row">Term of notice in current position</th>
                                                <td id="future-period">Not given</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


    </main>

@endsection
