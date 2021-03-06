@extends('layouts.landingSite')
@section('page_content')
<main>
    @php $banner_ad_category = 'property-landing'; @endphp
        <div class="left-ad float-left" id="left_banner_ad">
            @include('user-panel.banner-ads.left-banner')
        </div>
    <div class="dme-container">
           <div class="row top-ad" id="top_banner_ad">
                @include('user-panel.banner-ads.top-banner')
            </div>
    </div>
    <div class="dme-container p-3">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <div class="row pl-3 pr-3">
                    <div class="col-md-6 p-0">
                        <ol class="breadcrumb w-100 "
                            style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel </a></li>
                            <li class="breadcrumb-item active"><a href="{{url('property/realestate')}}">Eiendom</a></li>
                            <li class="breadcrumb-item active"><a href="{{url('property/flat-wishes-rented/search')}}">Bolig ønskes leid</a></li>
                        </ol>
                    </div>
                    <div class="col-md-6 p-0">
                        <ul class="breadcrumb w-100   text-right d-block"
                            style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                            <li class="breadcrumb-item active d-inline-block">@if(!empty($prev))<a href="#"> &lt;
                                    Forrige </a> @else <span class="text-muted">Forrige</span>@endif</li>
                            <li class="breadcrumb-item active d-inline-block"><a href="{{url('property/flat-wishes-rented/search')}}">Til
                                    søket</a></li>
                            <li class="breadcrumb-item active d-inline-block">@if(!empty($next))<a href="#"> Neste ></a>
                                @else <span class="text-muted">Neste</span>@endif</li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                @php $name = $property_data->ad->company_gallery; @endphp
                @include('user-panel.partials.landing_page_slider',compact('name'))
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                @php $ad = $property_data->ad; @endphp
                @include('user-panel.partials.favorite-button',compact('ad'))

                <div class="row single-realestate-detail p-3">
                    <div class="col-md-12">

                        <h1 class="u-t2">{{$property_data->headline}}</h1>
                    </div>
                    @if($property_data->max_rent_per_month)
                        <div class="col-md-12 font-weight-bold mt-3">Maks månedsleie</div>
                        <div class="col-md-12 u-t3">{{number_format($property_data->max_rent_per_month,0,""," ")}} Kr</div>
                    @endif
                    @php
                        $property_type = $property_region = array();
                        if($property_data->property_type){
                            $property_type = explode(',',$property_data->property_type);
                            $property_type = array_filter($property_type);
                        }
                        if($property_data->region){
                            $property_region = explode(',',$property_data->region);
                            $property_region = array_filter($property_region);
                        }
                    @endphp
                    <div class="clearfix"></div>
                    <div class="bg-light-grey radius-8 col-md-12 p-3">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="font-weight-bold">Boligtype: </span>&nbsp;
                                {{--<span>--}}
                                @if(count($property_type) > 0)
                                    @foreach($property_type as $key=>$property_type_obj)
                                        <span>{{ucfirst($property_type_obj)}}{{count($property_type) == ($key+1) ? '' : ', '}}</span>
                                    @endforeach
                                @endif
                                    {{--{{rtrim($property_data->property_type,',')}} </span>--}}
                            </div>
                            <div class="col-md-12">
                                <span class="font-weight-bold">Ønsket område:</span>&nbsp;
                                @if(count($property_region) > 0)
                                    @foreach($property_region as $key=>$property_region_obj)
                                        <span>{{ucfirst($property_region_obj)}}{{count($property_region) == ($key+1) ? '' : ', '}}</span>
                                    @endforeach
                                @endif
                                {{--<span>{{rtrim($property_data->region,',')}}</span>--}}
                            </div>
                            @if($property_data->number_of_tenants)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">
                                        Antall beboere:
                                    </span>&nbsp;
                                    <span>{{rtrim($property_data->number_of_tenants)}}</span>
                                </div>
                            @endif

                            @if($property_data->wanted_from)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Ønskes fra: </span>&nbsp;
                                    <span>{{date("d.m.Y", strtotime($property_data->wanted_from))}}</span>
                                </div>
                            @endif

                            @if($property_data->furnishing)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Møblert: </span>&nbsp;
                                    <span>{{$property_data->furnishing}}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- <a href="#" class="mt-2"><svg width="12" height="12" viewBox="0 0 12 12"><line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line><line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line></svg> Flere detaljer</a> -->


                    @if($property_data->description)
                        <div class="col-md-12">
                            <span class="font-weight-bold">Beliggenhet</span>
                            <p style="white-space: pre-line">@php echo $property_data->description; @endphp</p>
                        </div>
                    @endif

                    <div class="col-md-12"><span class="font-weight-bold">Handel: </span> <span> {{$property_data->ad->id}}</span>
                    </div>
                    <div class="col-md-12"><span class="font-weight-bold">Sist endret: </span> <span>
                            {{date("d.m.Y H:i", strtotime($property_data->updated_at))}}</span></div>
                    <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                </div>
               
            </div>
            <div class="col-md-4">
                @if($property_data->user && $property_data->user->roles->first() && $property_data->user->roles->first()->name != 'company' && $property_data->user->roles->first()->name != 'agent')
                    <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                        @if(!$property_data['published-on'])
                            <center>
                                <img src="@if($property_data->user->media!=null){{asset(\App\Helpers\common::getMediaPath($property_data->user->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif"
                                     alt="Profile image" style="width:100px;">
                                <p class="mt-3"> {{ $property_data->user->username ? $property_data->user->username : 'NH-Bruker' }}</p>
                            </center>
                        @else
                            <p class="mt-3">NH-Bruker</p>
                        @endif
                        @if($property_data->phone)
                            <div class="mb-2">
                                <span>Mobil: </span>
                                <span>
                            <a href="tel:+4746545247" class="u-select-all" data-controller="trackSendSMS">
                                {{$property_data->phone}}
                            </a>
                        </span>
                            </div>
                        @endif
                        @if(!$property_data['published-on'])
                            <div class="mb-2">
                                <a href="{{url('property/flat-wishes-rented/search?user_id='.$property_data->ad->user->id)}}">Flere annonser fra annonsør</a>
                            </div>
                        @endif
                        @if(!$property_data->ad->is_mine())
                            <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
                        @endif
                    </div>
                    </div>
                @else
                    @php
                        $show_more_ad_url = url('property/flat-wishes-rented/search?company_id='.$property_data->ad->company_id);
                        $property_published_on = $property_data['published-on'];
                    @endphp
                    @include('user-panel.partials.templates.landing_page_company_information')
                @endif
                       
                <div class="mt-3 mb-3">
                    <h5>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">{{$property_data->street_address}}</font>
                        </font><br>
                    </h5>
                </div>

                {{-- <div style="width: 306px; height: 153px;">
                 <h5 class="text-muted">{{ $property_data->full_address }}</h5>
                     <div id="map" style="height: 306px; width: 100%;"></div>
                </div> --}}
        </div>
    </div>
    </div>

        <div class="right-ad pull-right" id="right_banner_ad">
             @include('user-panel.banner-ads.right-banner')
        </div>
</main>

@endsection
{{-- @php $map_obj = $property_data @endphp
@include('common.partials.description_map',compact('map_obj')) --}}