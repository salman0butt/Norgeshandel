@extends('layouts.landingSite')
@section('page_content')
<main>
    <div class="dme-container">
        <div class="row">
            <div class="col-md-8 mt-5 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$list->name}}</h2>
                        @include('common.partials.flash-messages')
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
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="fav-list row mt-5">
            <div class="col-md-12">
                <?php
                    use Illuminate\Support\Facades\Auth;
                    $fav = $list->favorites->where('user_id',Auth::id());
                    $count = 0;
                ?>
                @if(isset($list->favorites) && is_countable($list->favorites) && count($list->favorites) > 0)
                    @foreach($fav as $item)
                        <?php $ad = $item->ad; $date = Date('y-m-d',strtotime('-7 days')); $fav_item = $item;?>
                        @if(isset($ad->ad_type) && $ad->visibility  && (strtotime($ad->sold_at) > strtotime($date) || !$ad->sold_at))
                            <?php $count++; ?>
                            @if($ad->ad_type === "job" )
{{--                                @include('user-panel.partials.templates.job-list', compact('ad','fav_item'))--}}
                                @include('user-panel.partials.templates.fav-job-list', compact('ad','fav_item'))
                            @else
                                @include('user-panel.partials.templates.property-list', compact('ad','fav_item'))
                            @endif
                        @endif
                    @endforeach
                @endif
                @if(!$count)
                    <div class="alert alert-warning p-3">Det er ingen elementer på listen!</div>
                @endif
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <div id="ad_note_for_fav" class="modal fade d-none" role="dialog">
        <div class="modal-dialog modal-lg pt-5">
            <div class="modal-content">
                <div class="modal-body" id="list-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="u-t2">Merk</h3>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{url('store-fav-note')}}" method="POST" id="fav_note_form">
                                @csrf
                                <input type="hidden" name="fav_id" class="fav_id">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="landing_list_name">Legg inn noen lapp</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="dme-form-control note" name="note"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="dme-btn-outlined-blue float-right">Lagre</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <button class="dme-btn-outlined-blue float-right mr-3" data-dismiss="modal">Ferdig</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>

    //Collapse button
    $(document).on('click', '.plus_note_button', function () {
        $(this).addClass('d-none');
        $(this).closest('div').find('textarea').val('');
    });

    //close button
    $(document).on('click', '.close_button', function () {
        var id = $(this).attr('data-target');
        $('a[data-target="'+id+'"]').removeClass('d-none');
    });

    //close button when an note is exist
    $(document).on('click', '.close_button_for_note', function () {
        $(this).closest('form').find('textarea').attr( 'disabled', 'disabled');

        $(this).closest('form').find('.float-right').addClass('d-none');
        $(this).closest('form').find('.remove_button_area').addClass('d-none');
        $(this).closest('form').find('.ad_note_link').removeClass('d-none');
        // $(this).addClass('d-none');
    });

    //Edit link for note
    $(document).on('click', '.ad_note_link', function () {
        $(this).closest('form').find('textarea').removeAttr("disabled");

        var searchInput = $(this).closest('form').find('textarea');
        var strLength =  searchInput.val().length * 2;
        searchInput.focus();
        searchInput[0].setSelectionRange(strLength, strLength);

        $(this).closest('form').find('div').removeClass('d-none');
        $(this).closest('form').find('.remove_button_area').removeClass('d-none');
        $(this).addClass('d-none');

    });


    //Remove Note
    $(document).on('click', '.remove_note_button', function (e) {
        e.preventDefault();
        if (confirm("Er du sikker på å fjerne dette notatet?") == true) {
            var id = $(this).closest('form').find('input[name="id"]').val();
            if(id){
                $.ajax({
                    url: "{{url('remove-fav-note')}}",
                    type: "GET",
                    data: {id:id},
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    }
                })
            }
        }
    });

    //Store Note
    $(document).on('click', '.submit_button', function (e) {
        var val =  $(this).closest('form').find('textarea').val();
        if(!val){
            alert("Skriv inn et notat.");
            return false;
        }
        e.preventDefault();
        var form_id = $(this).data('target');
        var myform = document.getElementById(form_id);
        var fd = new FormData(myform);
        $.ajax({
            url: "{{url('store-fav-note')}}",
            type: "POST",
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                location.reload();
            }
        })
    });



    $('#landing_list_search').keyup(function (e) {
        if($(this).val().length>0){
            $.each($('.end_fav_item'), function(){
                if($(this).attr('data-name').toLowerCase().search($('#landing_list_search').val().toLowerCase())<0){
                    $(this).hide()
                }
                else{
                    $(this).show();
                }
            });
        }
        else{
            $('.end_fav_item').show();
        }
    });
</script>
@endsection
