@php
use Illuminate\Database\Eloquent\Builder;
    $now_date_time = date('Y-m-d H:i:00');
    $right_banner_group = \App\Admin\Banners\BannerGroup::whereHas('categories', function (Builder $query) use($banner_ad_category) {
                    $query->where('post_category', $banner_ad_category);
                    })
                        ->whereHas('positions', function (Builder $query) {
                        $query->where('position', 'right');
                        })->where('time_start','<=',$now_date_time)
                        ->orderBy('time_start','ASC')->get();
@endphp
<?php $i = 0; ?>
@if($right_banner_group->count() > 0)
    @foreach($right_banner_group as $right_banner_group_obj_key=>$right_banner_group_obj)
        @if(strtotime($right_banner_group_obj->time_end) >= strtotime($now_date_time))
            @if($right_banner_group_obj->banners->count() > 0)
                @foreach($right_banner_group_obj->banners as $right_banner_group_banner_key=>$right_banner_group_banner)
                    @if($right_banner_group_banner->is_active)
                        @php
                            $path = asset('public/images/top-ad.png');
                            if($right_banner_group_banner->media){
                                $path = \App\Helpers\common::getMediaPath($right_banner_group_banner->media,'160x600');
                            }
                            $time_out = '';
                            $seconds = 1;
                            if($right_banner_group_banner->display_time_type == 'm'){
                                $seconds = 60 * $right_banner_group_banner->display_time_duration;
                            }
                            if($right_banner_group_banner->display_time_type == 's'){
                                $seconds = $right_banner_group_banner->display_time_duration;
                            }
                            if($right_banner_group_banner->display_time_type == 'h'){
                                $seconds = 60 * 60 * $right_banner_group_banner->display_time_duration;
                            }
                            $time_out = $seconds * 1000;


                        @endphp
                        <a href="{{$right_banner_group_banner->link}}" target="_blank" class="{{ $i != 0 ? 'd-none' : 'show_right_banner_img'}} ad_clicked" data-time="{{$time_out}}" data-banner-id="{{ $right_banner_group_banner->id }}">
                            <img class="w-100" src="{{$path}}" alt="First slide" data-id="{{ $right_banner_group_banner->id }}" onload="views(this.dataset.id)">
                        </a>
                        <?php $i++ ?>
                    @endif
                @endforeach
            @endif
        @endif
    @endforeach
@endif
@if($i == 0)
    <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid m-auto" alt="">
@endif