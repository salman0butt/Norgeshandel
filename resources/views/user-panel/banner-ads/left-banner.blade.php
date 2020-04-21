@php
use Illuminate\Database\Eloquent\Builder;
    $now_date_time = date('Y-m-d H:i:00');
    $left_banner_group = \App\Admin\Banners\BannerGroup::where('post_category',$banner_ad_category)
                        ->whereHas('positions', function (Builder $query) {
                        $query->where('position', 'left');
                        })->where('time_start','<=',$now_date_time)
                        ->orderBy('time_start','ASC')->get();
@endphp
<?php $i = 0; ?>
@if($left_banner_group->count() > 0)
    @foreach($left_banner_group as $left_banner_group_obj_key=>$left_banner_group_obj)
        @if(strtotime($left_banner_group_obj->time_end) >= strtotime($now_date_time))
            @if($left_banner_group_obj->banners->count() > 0)
                @foreach($left_banner_group_obj->banners as $left_banner_group_banner_key=>$left_banner_group_banner)
                    @if($left_banner_group_banner->is_active)
                        @php
                            $path = asset('public/images/top-ad.png');
                            if($left_banner_group_banner->media){
                                $path = \App\Helpers\common::getMediaPath($left_banner_group_banner->media,'160x600');
                            }
                            $time_out = '';
                            $seconds = 1;
                            if($left_banner_group_banner->display_time_type == 'm'){
                                $seconds = 60 * $left_banner_group_banner->display_time_duration;
                            }
                            if($left_banner_group_banner->display_time_type == 's'){
                                $seconds = $left_banner_group_banner->display_time_duration;
                            }
                            if($left_banner_group_banner->display_time_type == 'h'){
                                $seconds = 60 * 60 * $left_banner_group_banner->display_time_duration;
                            }
                            $time_out = $seconds * 1000;


                        @endphp
                        <a href="{{$left_banner_group_banner->link}}" target="_blank" class="{{ $i != 0 ? 'd-none' : 'show_left_banner_img'}}" data-time="{{$time_out}}">
                            <img class="w-100" src="{{$path}}" alt="First slide">
                        </a>
                        <?php $i++ ?>
                    @endif
                @endforeach
            @endif
        @endif
    @endforeach
@endif
@if($i == 0)
    <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid m-auto" alt="">
@endif