<style>
#suggestions > div > div.col-md-6 > ul {
    margin-bottom: 0px;
}
</style>

{{--@dd(count($job_fulltime));--}}
<div class="row m-2 search-result-topic" style="margin-bottom: 0px !important;">
    <div class="col-md-3 p1 offset-1">
     @if (count($job_parttime) > 0 && count($job_fulltime) > 0 && count($job_management) >0)
            Jobs
      @endif
    </div>
    <div class="col-md-7">
        <ul class="p-1">
        @if (count($job_parttime)> 0)
            <li><a href="#">In part time ({{count($job_parttime)}})</a></li>
            @elseif(count($job_fulltime) > 0)
            <li><a href="#">In fulltime ({{count($job_fulltime)}})</a></li>
            @elseif(count($job_management) > 0)
            <li><a href="#">In managemnt ({{count($job_management)}})</a></li>
            @endif
        </ul>
    </div>
</div>
<div class="row m-2 search-result-topic" style="margin-top: 0px !important;">
    <div class="col-md-3 p1 offset-1">
            Property
    </div>
    <div class="col-md-7">
        <ul class="p-1">
            @if (count($property_for_rent)> 0)
            <li><a href="#">In Property For Rent ({{count($property_for_rent)}})</a></li>
             @elseif(count($property_for_sale) > 0)
            <li><a href="#">In Property For Sale ({{count($property_for_sale)}})</a></li>
             @elseif(count($property_for_holiday_home_for_Sale) > 0)
            <li><a href="#">In Property for holiday home for Sale ({{count($property_for_holiday_home_for_Sale)}})</a></li>
             @elseif(count($property_realstate_business) > 0)
            <li><a href="#">In Property Realstate Business ({{count($property_realstate_business)}})</a></li>
             @elseif(count($property_flat_wishes) > 0)
            <li><a href="#">In Property Flat Wishes ({{count($property_flat_wishes)}})</a></li>
             @elseif(count($commercial_property_for_sale) > 0)
            <li><a href="#">In Commercial Property For Sale ({{count($commercial_property_for_sale)}})</a></li>
             @elseif(count($commercial_property_for_rent) > 0)
            <li><a href="#">In Commercial Property For Rent ({{count($commercial_property_for_rent)}})</a></li>
             @elseif(count($commercial_plot) > 0)
            <li><a href="#">In Commercial Plot ({{count($commercial_plot)}})</a></li>
             @elseif(count($Business_for_sale) > 0)
            <li><a href="#">In Business For Sale ({{count($Business_for_sale)}})</a></li>
            @endif
        </ul>
    </div>
</div>