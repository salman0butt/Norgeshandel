    <!-- Button trigger modal -->
    <button type="button" id="save_search_dialog_btn" class="btn bg-maroon text-white" data-toggle="modal"
       @if(Auth::check()) data-target="#basicExampleModal" @else    data-target="#modal_saved" @endif style="margin-top: -3%;position: absolute;z-index: 999;">
        Lagre søk
    </button>
    {{--        @include('common.partials.flash-messages)--}}
    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-top:10%">
            <div class="modal-content">
                <form action="{{ url('/savedsearches') }}" id="save_search" name="save-search" method="POST">
                    {{csrf_field()}}
                    {{method_field('POST')}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lagre søk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="modal__content">
                            <div>
                                <h2 class="u-t3 u-strong">Lagre søk</h2>
                            </div>
                            <div>
                                <div class="input input--text">
                                    <label>Navn
                                        <input placeholder="Navn på søk" name="name" size="30" value="{{ (isset($_GET['search'])) ? $_GET['search'] : '' }}" required=""
                                            class="form-control search-control">
                                    </label>
                                    <input type="hidden" name="filter" id="filter">
                                </div>
                                <div class="input-toggle">
                                    <input type="checkbox" id="notify" name="notify" checked="" value="1">
                                    <label for="notify">Ja takk, varsle meg om nye treff!</label>
                                </div>
                                <p>
                                   Du blir varslet på e-post og her på NorgesHandel.no
                                </p>


                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-maroon text-white" data-dismiss="modal">Lukk
                        </button>
                        <input type="submit" Value="Lagre endringer" class="btn bg-maroon text-white">
                        <input type="hidden" id="recent-search" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>