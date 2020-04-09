<style>
    .extended-profile{
        color: #000000;
        padding: 20px;
    }
    .company-information .company-logo{
        width: 80%;
    }
    .company-information .user-profile-picture{
        height: 85px;
        border: 1px solid rgba(0, 0, 0, 0.5);
        max-width: 100%;
    }
    .company-information .expandable-area li{
        border-bottom: 1px solid black;
    }
    .company-information .expandable-area li a{
        color: black;
        font-size: 14px;
    }
</style>

<div class="mb-4 company-information">
    <div class="extended-profile" style="background-color: #d3edda;">
        <div>
            <h2 class="text-center">
                <img src="https://images.finncdn.no/mmo/logo/object/1406570743/iad_8464198797665854225krogsveen_profil.png" class="centered-element company-logo" alt="Krogsveen avd. Torshov">
            </h2>
        </div>

        <div class="expandable-area">
            <div>
                <div class="text-center">
                    @if(!$property_published_on)
                        <div>
                            <img class="user-profile-picture" src="@if($property_data->user->media!=null){{asset(\App\Helpers\common::getMediaPath($property_data->user->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif" alt="">
                        </div>
                    @endif

                    <h5 class="mt-2">
                        @if(!$property_published_on)
                            {{$property_data->user && $property_data->user->username ? $property_data->user->username : 'NH-Bruker'}}
                        @else
                            NH-Bruker
                        @endif
                    </h5>

                    <div>Eiendomsmeglerfullmektig</div>

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

                        @if(!$property_data->ad->is_mine())
                            <li class="py-2"><a  href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></li>
                        @endif

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