@extends('layouts.landingSite')
@section('page_content')
    <main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-8 mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Favoritter</h2>
                            <p>For å legge en annonse i «Favoritter» trykker du på det lille hjertet som finnes i hver annonse.</p>
                            <a class="btn dme-btn-outlined-blue" href="#"  data-toggle="modal" data-target="#modal_landing_new_category">
                                <div class="">Lag ny liste</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-5 pt-5">
                    <div class="input-group search-box ">
                        <input type="text" name="landing_list_search" id="landing_list_search" class="form-control search-control" placeholder="Filtrer..." autofocus="">
                        <label for="search"><span class="input-group-addon">
                        <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" height="32" width="32">
                        <path fill="currentColor" fill-rule="evenodd" d="M22.412
                            21.198l-.558.656-.656.558a10.449 10.449 0 0 1-6.754 2.476C8.685
                            24.888 4 20.203 4 14.444 4 8.685 8.685 4 14.444 4c5.759 0 10.445
                            4.685 10.445 10.444 0 2.473-.88 4.872-2.477 6.754zm1.524
                            1.294a12.393 12.393 0 0 0 2.953-8.048C26.889 7.571 21.317 2 14.444 2
                            7.572 2 2 7.571 2 14.444c0 6.873 5.572 12.444 12.444 12.444 3.069 0
                            5.878-1.11 8.048-2.952L28.556 30 30 28.555l-6.064-6.063z"></path>
                        </svg>
                        </span></label>
                    </div>
                </div>
            </div>
            <div class="row landing_lists" id="landing_lists">
                @if(isset($lists))
                    @foreach($lists as $list)
                        <div class="col-sm-3 pr-0" style="position: relative" data-name="{{$list->name}}">
                            <a href="{{url('my-business/favorite-list/'.$list->id)}}" class="row product-list-item mr-1 p-sm-1 mt-3" data-id="{{$list->id}}" id="select_list" style="text-decoration: none;">
                                <div class="image-section col-sm-12  p-2">
                                    <div class="trailing-border">
{{--                                        {{dd($list->favorites)}}--}}
{{--                                        @if(isset($list->favorites()->first()->ad->job->gallery()->get()->first))--}}
{{--                                            {{$list->favorites->first()->ad->job->gallery()->get()->first}}--}}
{{--                                        @endif--}}
{{--                                        <img alt="" src="" style="width: 100%; min-height: 200px;padding-top:70px;font-size: 35px;" class="radius-8">--}}
                                        <span style="width: 100%; min-height: 200px;padding-top:70px;font-size: 35px;" class="fas fa-list radius-8"></span>
                                    </div>
                                </div>
                                <div class="detailed-section col-sm-10 pl-2 pr-2">
                                    <div class="title color-grey">{{$list->name}}</div>
                                    <div class="detail u-t5 text-muted">{{count($list->favorites)}} annonser</div>
                                </div>
                            </a>
                            <a href="#" data-id="{{$list->id}}" data-name="{{$list->name}}" data-share-link="{{url('shared-lists/'.$list->share_link)}}" data-target="#modal_landing_edit_category" data-toggle="modal" class="edit_list" style="position: absolute;right: 25px;bottom: 15px;"><span class="fa fa-pencil-alt"></span></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
    <div id="modal_landing_new_category" class="modal fade" role="dialog">
        <div class="modal-dialog pt-5">
            <div class="modal-content">
                <div class="modal-body" id="list-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="u-t2">Ny liste</h3>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <form action="#">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="landing_category_name">Gi listen et navn</label>
                                <input type="text" class="form-control" required name="category_name" id="landing_category_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <a href="#" data-dismiss="modal"><span class="fa fa-angle-left"></span> Tilbake</a>
                                <button type="submit" class="btn btn-success float-right" data-dismiss="modal" id="landing_save_category">Lagre</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_landing_edit_category" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg pt-5">
            <div class="modal-content">
                <div class="modal-body" id="list-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="u-t2">Rediger liste</h3>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>


                        <div id="accordion">

                            <div class="card m-3">
                                <a href="#rename" data-toggle="collapse" class="card-header bg-white">
{{--                                    <a class="card-link" data-toggle="collapse" href="#collapseOne">--}}
                                    Endre navn på listen
{{--                                    </a>--}}
                                </a>
                                <div id="rename" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        <form action="" id="form-rename">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="landing_list_name">Gi listen et navn</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="dme-form-control form-control" id="landing_list_name" autofocus required>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="dme-btn-outlined-blue float-right">Lagre</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card m-3">
                                <a href="#share" data-toggle="collapse" class="card-header bg-white">
{{--                                    <a class="card-link" data-toggle="collapse" href="#collapseOne">--}}
                                    Deling
{{--                                    </a>--}}
                                </a>
                                <div id="share" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <form action="" id="form-copy-link">
                                            <div class="form-group row mr-2 mt-2">
                                                <label for="is_copying" class="col-md-8">
                                                    <input type="checkbox" name="is_copying" id="is_copying" required> Del listen med lenke
                                                </label>
                                                <button type="submit" class="col-md-4 dme-btn-outlined-blue">Kopiér lenke</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card m-3">
                                <a href="#delete" data-toggle="collapse" class="card-header bg-white">
                                    Slett listen
                                </a>
                                <div id="delete" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <form action="" id="form-delete">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="font-weight-bold">Ønsker du å slette hele listen?</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>Alle annonsene og kommentarene du har lagret i denne listen vil da bli borte, og du kan ikke angre valget ditt.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="dme-btn-outlined-blue float-right">Ja, slett listen</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <button class="dme-btn-outlined-blue float-right mr-3" data-dismiss="modal">Ferdig</button>

                        </div>


                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="url_raname" value="{{url('my-business/rename-list')}}">
    <input type="hidden" id="url_delete" value="{{url('my-business/delete-list')}}">
    <input type="text" style="visibility: collapse" id="list_link" value="">

    <script type="text/javascript">
        var landing_list_id = 0;
        var list_name = "";
        $(document).ready(function () {
            $('#form-rename').submit(function (e) {
                e.preventDefault();
                var url = $('#url_raname').val();
                var name = $('#landing_list_name').val();
                if(name.length>0) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url + '/' + landing_list_id + '/' +name,
                        type: "GET",
                        success: function (response) {
                            location.reload();
                        }
                    });
                }
            });
            $('#form-delete').submit(function (e) {
                e.preventDefault();
                url = $('#url_delete').val();
                if(confirm('Er du sikker på at du vil slette denne listen?')){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url + '/' + landing_list_id,
                        type: "GET",
                        success: function (response) {
                            location.reload();
                        }
                    });
                }
            });
            $('#form-copy-link').submit(function (e) {
                e.preventDefault();
                var link = $('#list_link').val();
                var dummy = $('<input>').val(link).appendTo('body').select();
                document.execCommand('copy');
                alert("Del lenke kopiert til utklippstavlen");
            });


            $('#landing_list_search').keyup(function (e) {
                if($(this).val().length>0){
                    $.each($('#landing_lists>div'), function(){
                        if($(this).attr('data-name').toLowerCase().search($('#landing_list_search').val().  toLowerCase())<0){
                            $(this).hide()
                        }
                        else{
                            $(this).show();
                        }
                    });
                }
                else{
                    $('#landing_lists>div').show();
                }
            });
            $('.edit_list').click(function (e) {
                landing_list_id = $(this).attr('data-id');
                list_name = $(this).attr('data-name');
                $('#list_link').val($(this).attr('data-share-link'));

                $('#landing_list_name').val(list_name);

            });
            $('#landing_save_category').click(function () {
                var url = $('#add_list_url').val();
                var name = $('#landing_category_name').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url+'/'+name,
                    type: "GET",
                    success: function (response) {
                    }
                });

                setTimeout(function () {
                    location.reload();
                }, 500);
            });
        });
    </script>
@endsection
