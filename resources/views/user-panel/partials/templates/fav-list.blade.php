<div class="col-sm-4 pr-0 appended-fav-list">
    <a href="javascript:void(0);" class="row product-list-item mr-1 p-sm-1 mt-3" data-id="{{$list->id}}" id="select_list" style="text-decoration: none;">
        <div class="image-section col-sm-12  p-2">
            <div class="trailing-border">
                <span style="width: 100%; min-height: 150px;padding-top:55px;font-size: 35px;" class="fas fa-list radius-8"></span>
            </div>
        </div>
        <div class="detailed-section col-sm-12 pl-2 pr-2">
            <div class="title color-grey">{{$list->name}}</div>
            <div class="detail u-t5 text-muted">{{\App\Helpers\common::count_list_ads($list->id)}} annonser</div>
            <div class="dealer-logo float-right mt-3" ><img src="#" style="max-height: 40px;" alt="" class="img-fluid"></div>
        </div>
    </a>
</div>
