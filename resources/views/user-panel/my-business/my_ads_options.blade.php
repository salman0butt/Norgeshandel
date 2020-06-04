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
    <input type="hidden" class="show_rating" value="{{session('ratings') ? session('ratings') : ''}}">
    <div class="breade-crumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{url('my-business/my-ads')}}">Mine annonsers</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Flere valg</a></li>
            </ol>
        </nav>
    </div>
    <div id="content-start">
        <div class="grid row">
            <div class="col-12">
                @include('common.partials.flash-messages')
            </div>
            <div class="grid__unit col-md-8">
                <div class="panel u-mb32">
                    <div class="mt-1 mb-2">
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

                    <div style="display: flex;" class="mt-3">
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
                            @if($ad->status != 'saved')
                                <p>
                                    <a href="{{url('my-business/my-ads/'.$ad->id.'/statistics')}}">Se statistikk</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid__unit col-md-4">
                <div class="sidebar u-pv8 mt-5">
                    <a class="u-pv8 mt-2" href="@if($ad->ad_type == 'job') {{route('jobs.show', $ad->job)}} @else {{url('/', $ad->id)}} @endif">Se annonsen</a>
                    <div class="u-pt8">
                        <div class="u-pv8 mt-2">
                            @if(!$ad->sold_at && $ad->status !='sold')
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
                            @endif
                        </div>
                        @if($ad->status == 'published')
                            <div class="u-pv8 mt-2">
                                <a href="{{url('update-ad-visibility?ad_id='.$ad->id)}}" class="link pl-0 mb-2">
                                    @if($ad->visibility)
                                        Skjul annonsen i søkeresultater
                                    @else
                                        Vis annonsen din i søkeresultatene
                                    @endif
                                </a>
                            </div>
                        @endif
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
                        <div class="u-pv8 mt-2">
                            @if(!$ad->sold_at && $ad->status == 'published' && $ad->ad_type != 'job')
                                <form action="{{route('ad-sold', $ad)}}" class="mb-0" method="POST" onsubmit="javascript:return confirm('Vil du merke denne annonsen som @if($ad->ad_type == 'property_for_rent' || $ad->ad_type == 'property_flat_wishes_rented' || $ad->ad_type == 'property_commercial_for_rent') utleid @else solgt @endif? Du vil ikke kunne endre status senere.')">
                                    {{csrf_field()}}
                                    <button type="submit" class="link pl-0">
                                        @if($ad->ad_type == 'property_for_rent' || $ad->ad_type == 'property_flat_wishes_rented' || $ad->ad_type == 'property_commercial_for_rent')
                                            Merk som utleid
                                        @else
                                            Merk som solgt
                                        @endif
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{--<a class="u-pv8 mt-2" href="#">Merk som solgt</a>--}}

                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rangeringer og anmeldelser</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Ønsker du å rangere bruker relatert til denne annonsen.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{url('my-business/my-ads/'.$ad->id.'/ratings')}}">Ja</a>
                <a class="btn btn-danger" href="#" data-dismiss="modal">Nei</a>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <script>
            $(function() {
                $('#exampleModal').modal('show');
            });
        </script>
    @endif
@endsection
