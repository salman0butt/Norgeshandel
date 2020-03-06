@extends('layouts.landingSite')
<style>
    .sidebar {
        background-color: #F6F8FB;
        padding: 10px 15px;
    }

    .status--error {
        background-color: #FFEFEF;
        border-radius: 10px;
        padding: 0 10px;
    }
    .u-pv8 a:hover {
        text-decoration:underline;
    }
</style>
@section('page_content')
<main class="dme-container mt-5">


    <div class="breade-crumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mine annonser</li>
                <li class="breadcrumb-item active" aria-current="page">Pariatur Ut est qui</li>
            </ol>
        </nav>
    </div>
    <div id="content-start">
        <div class="grid row">
            <div class="grid__unit col-md-8">
                <div class="panel u-mb32">
                    <div class="mt-1 mb-2">
                        <span class="status status--error">Påbegynt</span>
                        @php
                            $started = \App\Helpers\common::get_ad_attribute($ad,'started');
                            $expired = \App\Helpers\common::get_ad_attribute($ad,'expired');
                        @endphp
                        @if($started)
                            <span class="u-no-break u-caption">Påbegynt: {{date('d-m-Y', strtotime($started))}}</span>
                        @endif
                        @if($expired)
                            <span class="u-no-break u-caption">Utløper: {{date('d-m-Y', strtotime($expired))}}</span>
                        @endif
                    </div>

                    <div style="display: flex;" class="mt-5">
                        <div class="u-mr16">
                            <div class="img-format img-format--ratio3by2 img-format--centered image-frame u-bg-ice"
                                style="min-width: 98px;">
                                <img class="img-fluid radius-8"
                                    src="{{($ad->company_gallery->count() > 0 && $ad->company_gallery->first()) ? asset(\App\Helpers\common::getMediaPath($ad->company_gallery->first(), '150x150')) : asset('public/images/placeholder150X150.png')}}"
                                    alt="Bilde mangler">
                            </div>
                        </div>
                        <div style="min-width: 0;" class="ml-3">
                            <h4 class="u-truncate" >{{\App\Helpers\common::get_ad_attribute($ad,'heading')}}</h4>
                            <p>
                                {{--417,-&nbsp;--}}
                                <a href="{{url('my-business/my-ads/'.$ad->id.'/statistics')}}">Se statistikk</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid__unit col-md-4">
                <div class="sidebar u-pv8 mt-5">
                    <a class="u-pv8 mt-2" href="@if($ad->ad_type == 'job') {{route('jobs.show', $ad->job)}} @else {{url('general/property/description', [$ad->property->id, $ad->ad_type])}} @endif">Se annonsen</a>
                    <div class="u-pt8">
                        <div class="u-pv8 mt-2">
                            <a href="
                            @if($ad->ad_type == 'property_for_rent') {{ url('new/property/rent/ad/'.$ad->property->id.'/edit')}}
                            @elseif($ad->ad_type == 'property_for_sale') {{ url('new/property/sale/ad/'.$ad->property->id.'/edit')}}
                            @elseif($ad->ad_type == 'property_business_for_sale') {{ url('add/business/for/sale/'.$ad->property->id.'/edit')}}
                            @elseif($ad->ad_type == 'property_holiday_home_for_sale') {{ url('holiday/home/for/sale/'.$ad->property->id.'/edit')}}
                            @elseif($ad->ad_type == 'property_flat_wishes_rented') {{ url('new/flat/wishes/rented/'.$ad->property->id.'/edit')}}
                            @elseif($ad->ad_type == 'property_commercial_plots') {{ url('commercial/plots/'.$ad->property->id.'/edit')}}
                            @elseif($ad->ad_type == 'property_commercial_for_sale') {{ url('add/new/commercial/property/for/sale/'.$ad->property->id.'/edit')}}
                            @elseif($ad->ad_type == 'property_commercial_for_rent') {{ url('add/new/commercial/property/for/rent/'.$ad->property->id.'/edit')}}
                            @elseif($ad->ad_type == 'job' && $ad->status == 'saved') @php $job = $ad->job; @endphp {{route('jobs.edit', compact('job'))}}
                            @else javascript:void(0);
                            @endif">Endre annonsen
                            </a>
                        </div>
                        <div class="u-pv8 mt-2">
                            <div>
                                @if($ad->ad_type == 'job')
                                    <form action="{{route('jobs.destroy', $ad->job)}}" class="mb-0" METHOD="POST" onsubmit="javascript:return confirm('Vil du slette denne annonsen?')">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="link pl-0">Slett
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('delete-property', $ad)}}" class="mb-0" method="POST" onsubmit="javascript:return confirm('Vil du slette denne annonsen?')">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="link pl-0">Slett
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(!$ad->sold_at)
                        <form action="{{route('ad-sold', $ad)}}" class="mb-0" method="POST" onsubmit="javascript:return confirm('Vil du merke denne annonsen som solgt? Du vil ikke kunne endre status senere.')">
                            {{csrf_field()}}
                            <button type="submit" class="link pl-0">Merk som solgt
                            </button>
                        </form>
                    @endif
                    {{--<a class="u-pv8 mt-2" href="#">Merk som solgt</a>--}}

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
