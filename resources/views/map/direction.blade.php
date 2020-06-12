
 <div id="mapCanvas" onload=initialize()>&#160;</div>
    <div id="directionsPanel">
        <a href="#geoLocation" id="useGPS">Bruk min beliggenhet</a>
        <p class="or">[ELLER]</p>
        <div class="directionInputs">
            <form>
                <p>
                    <label>Fra</label>
                    <input type="text" value="" id="dirSource" placeholder="Velg startpunkt eller klikk på kartet ..."/>
                </p>
                <p>
                    <label>Til</label>
                    <input type="text" value="" id="dirDestination" placeholder="Velg destinasjon..."/>
                </p>
                <a href="#getDirections" id="getDirections">Få veibeskrivelse</a>
                <a href="#reset" id="paneReset">Nullstill</a>
            </form>
        </div>
        <div id="directionSteps">
            <p class="msg">Retningstrinn vil gjengis her</p>
        </div>
        <a href="#toggleBtn" id="paneToggle" class="out">&lt;</a>
    </div>
<script src="{{ asset('public/js/diriection.js') }}"></script>


    {{-- <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script> --}}
</div>



