<style>
    #suggestions > div > div.col-md-6 > ul {
        margin-bottom: 0;
    }
</style>

{{--@dd(count($job_fulltime));--}}
<div class="row m-2 search-result-topic" style="margin-bottom: 0 !important;">
    <div class="col-md-3 p1 offset-1">
        @if (count($job_parttime) > 0 || count($job_fulltime) > 0 || count($job_management) >0)
            Jobs
        @endif
    </div>
    <div class="col-md-7">
        <ul class="p-1">
            @if (count($job_parttime)> 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=part_time')}}">På deltid
                        ({{count($job_parttime)}})</a></li>
            @endif
            @if(count($job_fulltime) > 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=full_time')}}">På heltid
                        ({{count($job_fulltime)}})</a></li>
            @endif
            @if(count($job_management) > 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=management')}}">På ledelse
                        ({{count($job_management)}})</a></li>
            @endif
        </ul>
    </div>
</div>
<div class="row m-2 search-result-topic" style="margin-top: 0px !important;">
    @if((isset($property_for_rent) && count($property_for_rent)>0) ||
        (isset($property_for_sale) && count($property_for_sale)>0) ||
        (isset($property_for_holiday_home_for_Sale) && count($property_for_holiday_home_for_Sale)>0) ||
        (isset($property_realstate_business) && count($property_realstate_business)>0) ||
        (isset($property_flat_wishes) && count($property_flat_wishes)>0) ||
        (isset($commercial_property_for_sale) && count($commercial_property_for_sale)>0) ||
        (isset($commercial_property_for_rent) && count($commercial_property_for_rent)>0) ||
        (isset($commercial_plot) && count($commercial_plot)>0) ||
        (isset($Business_for_sale)) && count($Business_for_sale)>0)

        <div class="col-md-3 p1 offset-1">
            Property
        </div>
        <div class="col-md-7">
            <ul class="p-1">
                @if (count($property_for_rent)> 0)
                    <li><a href="#">In Property For Rent ({{count($property_for_rent)}})</a></li>
                @endif
                @if(count($property_for_sale) > 0)
                    <li><a href="#">In Property For Sale ({{count($property_for_sale)}})</a></li>
                @endif
                @if(count($property_for_holiday_home_for_Sale) > 0)
                    <li><a href="#">In Property for holiday home for Sale
                            ({{count($property_for_holiday_home_for_Sale)}})</a></li>
                @endif
                @if(count($property_realstate_business) > 0)
                    <li><a href="#">In Property Realstate Business ({{count($property_realstate_business)}})</a></li>
                @endif
                @if(count($property_flat_wishes) > 0)
                    <li><a href="#">In Property Flat Wishes ({{count($property_flat_wishes)}})</a></li>
                @endif
                @if(count($commercial_property_for_sale) > 0)
                    <li><a href="#">In Commercial Property For Sale ({{count($commercial_property_for_sale)}})</a></li>
                @endif
                @if(count($commercial_property_for_rent) > 0)
                    <li><a href="#">In Commercial Property For Rent ({{count($commercial_property_for_rent)}})</a></li>
                @endif
                @if(count($commercial_plot) > 0)
                    <li><a href="#">In Commercial Plot ({{count($commercial_plot)}})</a></li>
                @endif
                @if(count($Business_for_sale) > 0)
                    <li><a href="#">In Business For Sale ({{count($Business_for_sale)}})</a></li>
                @endif
            </ul>
        </div>
    @endif

</div>
