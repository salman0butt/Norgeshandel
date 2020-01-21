<style>
#suggestions > div > div.col-md-6 > ul {
    margin-bottom: 0px;
}
</style>

{{--@dd(count($job_fulltime));--}}
<div class="row m-2 search-result-topic">
    <div class="col-md-4 p1 offset-1">
            Jobs
    </div>
    <div class="col-md-6">
        <ul class="p-1">
            <li><a href="#">In part time ({{count($job_parttime)}})</a></li>
            <li><a href="#">In fulltime ({{count($job_fulltime)}})</a></li>
            <li><a href="#">In managemnt ({{count($job_management)}})</a></li>
        </ul>
    </div>
</div>
<div class="row m-2 search-result-topic">
    <div class="col-md-4 p1 offset-1">
            Property
    </div>
    <div class="col-md-6">
        <ul class="p-1">
            <li><a href="#">In part time ({{count($property_for_rent)}})</a></li>
        </ul>
    </div>
</div>
