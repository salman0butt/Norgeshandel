@extends('layouts.landingSite')
@section('page_content')
<main>
    <div class="dme-container">
        <div class="row">
            <div class="col-md-8 mt-5 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$list->name}}</h2>
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
            <div class="col-md-8">
                @if(isset($list->favorites) && is_countable($list->favorites) && count($list->favorites)>0)
                    <?php $fav = $list->favorites; ?>
                    @foreach($fav as $item)
                        <?php $ad = $item->ad; ?>
                        @if(isset($ad->ad_type) && $ad->ad_type === "job")
                            @include('user-panel.partials.templates.job-list', compact('ad'))
                        @endif
                    @endforeach
                @else
                    <div class="alert alert-warning p-3">Det er ingen elementer på listen!</div>
                @endif
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</main>
<script>
    $('#landing_list_search').keyup(function (e) {
        if($(this).val().length>0){
            $.each($('.favorite-list-item'), function(){
                if($(this).attr('data-name').toLowerCase().search($('#landing_list_search').val().toLowerCase())<0){
                    $(this).hide()
                }
                else{
                    $(this).show();
                }
            });
        }
        else{
            $('.favorite-list-item').show();
        }
    });
</script>
@endsection
