@if($my_ads->count() > 0)
    @foreach($my_ads as $key=>$ad)
        @php
            if(isset($ad->ad_ad_id) && $ad->ad_ad_id){
                $ad = \App\Models\Ad::find($ad->ad_ad_id);
            }
        @endphp
        @if($ad && $ad->ad_type && $ad->ad_type == 'job' && $ad->job)
            <?php $job = $ad->job; ?>
            @include('user-panel.partials.templates.myads-job', compact('job'))
        @endif
        @if($ad && $ad->ad_type && $ad->ad_type !='job' && $ad->property)
            <?php $property = $ad->property; ?>
            @include('user-panel.partials.templates.myads-property', compact('property'))
        @endif
    @endforeach
@else
    <div class="row alert alert-warning">
        <h3 class=" text-center col-md-12">Du har ingen annonser.</h3>
        <h5 class=" text-center col-md-12">Dine andre annonser kan du finne ved å endre på filteret.</h5>
    </div>
@endif

{{-- <div class="pagination">
    {{ $my_ads->links() }}
    {{ $my_ads->links('user-panel.my-business.my_ads',compact('my_ads')) }}
</div> --}}