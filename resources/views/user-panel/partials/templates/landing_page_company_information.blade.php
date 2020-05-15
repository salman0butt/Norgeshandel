@php
    $text_color = '#ffffff';
    if($property_data->ad && $property_data->ad->company && $property_data->ad->company->text_color){
        $text_color = $property_data->ad->company->text_color;
    }
@endphp
<style>
    .extended-profile{
        color: {{$text_color}};
        padding: 20px;
    }
    .company-information .company-logo{
        width: 60%;
    }
    .company-information .user-profile-picture{
        height: 85px;
        border: 1px solid {{$text_color}};
        max-width: 100%;
    }
    .company-information .expandable-area li{
        border-bottom: 1px solid {{$text_color}};
        /*border-bottom: 1px solid black;*/
    }
    .company-information .expandable-area li a{
        color: {{$text_color}};
        font-size: 14px;
    }
</style>

<div class="mb-4 company-information">
    <div class="extended-profile" style="background-color: {{$property_data->ad->company && $property_data->ad->company->background_color ? $property_data->ad->company->background_color : '#000000'}}">
        @if(!$property_published_on && $property_data->ad->company_id && $property_data->ad->company && $property_data->ad->company->company_logo->first())
        <div>
            <h2 class="text-center">
                <img src="{{asset(\App\Helpers\common::getMediaPath($property_data->ad->company->company_logo->first()))}}" class="centered-element company-logo" alt="Krogsveen avd. Torshov">
            </h2>
        </div>
        @endif

        <div class="expandable-area">
            <div>
                <div class="text-center">
                    {{--@if(!$property_published_on && $property_data->user->media)--}}
                        {{--<div>--}}
                            {{--<img class="user-profile-picture" src="@if($property_data->user->media!=null){{asset(\App\Helpers\common::getMediaPath($property_data->user->media))}} @endif" alt="">--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    <h5 class="mt-2 mb-1">
                        @if(!$property_published_on)
                            {{$property_data->ad && $property_data->ad->company ? $property_data->ad->company->emp_name : 'NH-Bruker'}}
                        @else
                            NH-Bruker
                        @endif
                    </h5>
                    @if($property_data->user->hasRole('company'))
                        @if(!$property_data->ad->is_mine())
                            <div>
                                <img class="user-profile-picture" src="{{$property_data->user->media ? asset(\App\Helpers\common::getMediaPath($property_data->user->media)) : asset('/public/images/male-avatar.jpg')}}" alt="">
                            </div>

                            <ul class="list-unstyled mb-0">
                                @if($property_data->user->first_name || $property_data->user->last_name)
                                    <li class="py-2"><h6 class="mt-2">{{$property_data->user->first_name.' '.$property_data->user->last_name}}</h6></li>
                                @endif
                                <li class="py-2"><a  href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></li>
                            </ul>
                        @endif
                    @endif
                    <ul class="list-unstyled">
                        <li></li>
                    </ul>

                    @if(!$property_published_on && $property_data->user)
                        @if(!$property_data->user->hasRole('company'))
                            <div>
                                <img class="user-profile-picture" src="{{$property_data->user->media ? asset(\App\Helpers\common::getMediaPath($property_data->user->media)) : asset('/public/images/male-avatar.jpg')}}" alt="">
                            </div>
                            <h6 class="mt-2">{{$property_data->user->first_name.' '.$property_data->user->last_name}}</h6>
                            <p class="mb-0">{{$property_data->user->position}}</p>
                            @if($property_data->user->mobile_number)
                                <ul class="list-unstyled mb-0">
                                    <li class="py-2"><a  href="tel:{{$property_data->user->mobile_number}}">Mobil  {{$property_data->user->mobile_number}}</a></li>
                                </ul>
                            @endif
                            @if(!$property_data->ad->is_mine())
                                <ul class="list-unstyled mb-0">
                                    <li class="py-2"><a  href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></li>
                                </ul>
                            @endif
                        @endif
                    @else
                        <div>
                            <img class="user-profile-picture" src="{{asset('/public/images/male-avatar.jpg')}}" alt="">
                        </div>
                        <h6 class="mt-2">NH-Bruker</h6>
                    @endif


                    @if($property_data->ad && $property_data->ad->agents->count() > 0)
                        @foreach($property_data->ad->agents as $ad_agent)
                            <div class="mt-2">
                                <img class="user-profile-picture" src="{{$ad_agent->media ? asset(\App\Helpers\common::getMediaPath($ad_agent->media)) : asset('/public/images/male-avatar.jpg')}}" alt="">
                            </div>
                            <h6 class="mt-2">{{$ad_agent->first_name.' '.$ad_agent->last_name}}</h6>
                            <p class="mb-0">{{$ad_agent->position}}</p>

                            <ul class="list-unstyled mb-0">
                                @if($ad_agent->mobile_number)
                                    <li class="py-2"><a  href="tel:{{$ad_agent->mobile_number}}">Mobil  {{$ad_agent->mobile_number}}</a></li>
                                @endif
                            </ul>
                        @endforeach
                    @endif

                    <ul class="list-unstyled">

                        @if(Auth::user() && Auth::user()->mobile)
                            <li class="py-2"><a  href="tel:{{Auth::user()->mobile}}">Mobil  {{Auth::user()->mobile}}</a></li>
                        @endif

                        @if($property_data->phone)
                            <li class="py-2"><a  href="tel:{{$property_data->phone}}">Telefon  {{$property_data->phone}}</a></li>
                        @endif

                        @if(!$property_published_on && $show_more_ad_url)
                            <li class="py-2"><a  href="{{$show_more_ad_url}}">Flere annonser fra annonsør</a></li>
                        @endif

                        {{--@if(!$property_data->ad->is_mine())--}}
                            {{--<li class="py-2"><a  href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></li>--}}
                        {{--@endif--}}

                        @if($property_data->offer_url)
                            <li class="py-2"><a  href="{{$property_data->offer_url}}" target="_blank">Hjemmeside</a></li>
                        @endif

                        @if($property_data && $property_data->ad && $property_data->ad->sales_information->count() > 0)
                            <li class="py-2"><a  href="{{\App\Helpers\common::getMediaPath($property_data->ad->sales_information->first())}}" target="_blank">Se komplett salgsoppgave</a></li>
                        @endif

                        @if($property_data && $property_data->ad && $property_data->ad->pdf->count() > 0)
                            <li class="py-2"><a  href="{{\App\Helpers\common::getMediaPath($property_data->ad->pdf->first())}}" target="_blank">PDF</a></li>
                        @endif

                        @if($property_data->state_report_link)
                            <li class="py-2"><a  href="{{$property_data->state_report_link}}" target="_blank">Tilstandsrapport</a></li>
                        @endif

                        @if($property_data->link_to_terif_documents)
                            <li class="py-2"><a  href="{{$property_data->link_to_terif_documents}}" target="_blank">Takstdokumenter</a></li>
                        @endif

                        @if($property_data->task_link)
                            <li class="py-2"><a  href="{{$property_data->task_link}}" target="_blank">Salgsoppgave</a></li>
                        @endif

                        @if($property_data->link && $property_data->link_for_information)
                            <li class="py-2"><a href="{{$property_data->link_for_information}}" target="_blank">{{$property_data->link}}</a></li>
                        @endif

                        @if($property_data->line_text && $property_data->link_for_information)
                            <li class="py-2"><a href="{{$property_data->link_for_information}}" target="_blank">{{$property_data->line_text}}</a></li>
                        @endif

                        @if($property_data->link && $property_data->text_for_information)
                            <li class="py-2"><a href="{{$property_data->text_for_information}}" target="_blank">{{$property_data->link}}</a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>