@php
use Illuminate\Database\Eloquent\Builder;
    $now_date_time = date('Y-m-d H:i:00');
    $top_banner_group = \App\Admin\Banners\BannerGroup::whereHas('categories', function (Builder $query) use($banner_ad_category) {
                    $query->where('post_category', $banner_ad_category);
                    })
                    ->whereHas('positions', function (Builder $query) {
                    $query->where('position', 'top');
                    })->where('time_start','<=',$now_date_time)->orderBy('time_start','ASC')->get();    
@endphp
<?php $i = 0; ?>
@if($top_banner_group->count() > 0)
    @foreach($top_banner_group as $top_banner_group_obj_key=>$top_banner_group_obj)
        @if(strtotime($top_banner_group_obj->time_end) >= strtotime($now_date_time))
            @if($top_banner_group_obj->banners->count() > 0)
                @foreach($top_banner_group_obj->banners as $top_banner_group_banner_key=>$top_banner_group_banner)
                    @if($top_banner_group_banner->is_active)
                        @php
                            $path = asset('public/images/top-ad.png');
                            if($top_banner_group_banner->media){
                                $path = \App\Helpers\common::getMediaPath($top_banner_group_banner->media,'1000x150');
                            }
                            $time_out = '';
                            $seconds = 1;
                            if($top_banner_group_banner->display_time_type == 'm'){
                                $seconds = 60 * $top_banner_group_banner->display_time_duration;
                            }
                            if($top_banner_group_banner->display_time_type == 's'){
                                $seconds = $top_banner_group_banner->display_time_duration;
                            }
                            if($top_banner_group_banner->display_time_type == 'h'){
                                $seconds = 60 * 60 * $top_banner_group_banner->display_time_duration;
                            }
                            $time_out = $seconds * 1000;
                            $is_full_banner = $top_banner_group_banner->full_banner;
                               if($is_full_banner){
                                   echo '<script>
                                   $(".dme-wrapper > .dme-container").attr("style","padding:0px 8px");
                                   </script>';
                               }
                        @endphp
                        <a href="{{$top_banner_group_banner->link}}" target="_blank" class="{{ $i != 0 ? 'd-none' : 'show_top_banner_img'}}" data-time="{{$time_out}}" style="margin:0 auto;">
                            <img class="d-block w-100" src="{{$path}}" alt="First slide" style="max-height: 150px;" data-id="{{ $top_banner_group_banner->id }}" onload="view()">
                        </a>
                        <?php $i++ ?>
                    @endif
                @endforeach
            @endif
        @endif
    @endforeach
@endif
@if($i == 0)
    <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
@endif