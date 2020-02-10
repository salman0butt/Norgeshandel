@extends('layouts.landingSite')

@section('page_content')
{{--    @dd($searches)--}}
    <main class="saved-searches">
        <div class="dme-container mb-3">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('my-business')}}">Min handel </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Endre profil</li>
                    </ol>
                </nav>
            </div>
            <!---- end breadcrumb----->
            @include('common.partials.flash-messages')
            <div class="row">
                <div class="col-md-12">
                    <h3>Lagrede søk</h3>
                    <p>Søk på noe du har lyst på og trykk «Lagre søk». Da varsler NorgesHandel deg når det dukker opp
                        nye
                        annonser.</p>
                    <a href="#">Nyttig informasjon om lagrede søk</a>
                </div>
            </div>
            <div class="row" id="saved-search-editor">
                {{--                <div class="col-md-12"><h3 class="u-t3">Jobb</h3></div>--}}
            </div>
            @foreach($searches as $search)
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="bg-maroon-lighter p-3 radius-8">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="u-t4">
                                        <a href="{{!empty($search->filter)?url($search->filter):'#'}}">{{$search->name}}</a>
                                    </h3>
                                    <p>
                                        <span class="u-truncate u-display-block">{{$search->notification_email?'E-post ':''}}{{$search->notification_sms?'Push ':''}}{{$search->notification_web?'På NorgesHandel.no ':''}}</span>
                                    </p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <button type="button" data-target="#search_detail_{{$search->id}}" data-toggle="collapse"
                                            class="btn btn-default color-maroon"><span
                                            class="fa fa-edit"></span> Endre
                                    </button>
                                </div>
                            </div>
                            {{--                        end row--}}
                            <div class="row collapse" id="search_detail_{{$search->id}}">
                                <div class="col-md-12">
                                    <form id="update-form" action="{{route('search.update', compact('search'))}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('PUT')}}
                                        <pre>
                                        <?php
                                            $final = "";
                                        $str = explode('?', $search->filter);
                                        $str2 = "";
                                        if (count($str)>1){
                                        $str2 = $str[1];
                                        }
                                        else{
                                            $str2 = $str[0];
                                        }
                                                $pairs = explode('&', $str2);
                                        foreach ($pairs as $pair){
                                            $key_val = explode('=',$pair);
                                            $final.= !empty($key_val[1])?str_replace('-', ' ', str_replace('_', ' ', $key_val[1].', ')):'';
                                        }
                                        ?>
                                            </pre>
                                        <h3 class="u-t4">{{rtrim($final, ', ')}}</h3>
                                        <div class="form-group row">
                                            <label class="col-md-1">Navn</label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="name"
                                                       value="{{$search->name}}">
                                            </div>
                                            <div class="col-md-5">
                                            </div>
                                        </div>
                                        <h4 class="u-mt16">Varslingsinnstillinger</h4>
                                        <div class="">
                                            <input name="notification_email" type="checkbox" value="1" id="notification_email_{{$search->id}}" {{$search->notification_email?'checked':''}}>
                                            <label for="notification_email_{{$search->id}}">
                                                 <strong class="">Daglig e-postvarsling</strong>
                                                <span
                                                    class="">Nye treff for dette søket sendes til din e-postadresse</span>
                                            </label>
                                        </div>
                                        <div class="">
                                            <input name="notification_sms" type="checkbox" value="1" id="notification_sms_{{$search->id}}" {{$search->notification_sms?'checked':''}}>
                                            <label for="notification_sms_{{$search->id}}">
                                                 <strong class="">Umiddelbar push-varsling</strong>
                                                <span class="">Sanntidsvarsling for dette søket sendes til NorgesHandel-appen på iPhone, iPad og Android</span>
                                            </label>
                                        </div>
                                        <div class="">
                                            <input name="notification_web" type="checkbox" value="1" id="notification_web_{{$search->id}}" {{$search->notification_web?'checked':''}}>
                                            <label for="notification_web_{{$search->id}}">
                                                 <strong class="">Umiddelbar varsling på NorgesHandel.no</strong>
                                                <span class="">Sanntidsvarsling i toppmenyen på NorgesHandel.no</span>
                                            </label>
                                        </div>
                                        <div class="mb-2 mt-2">
                                            <button type="submit" class="btn dme-btn-maroon radius-8">Ferdig</button>
                                        </div>
                                    </form>
                                        <div class="">
                                            <form action="{{route('search.destroy', compact('search'))}}" method="post">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button type="button" class="btn dme-btn-outlined-blue"
                                                        onclick="javascript:$('#search_detail_{{$search->id}}').slideUp();">Avbryt
                                                </button>
                                                <button type="submit" class="link text-danger"><span class="fa fa-trash"></span> Slett
                                                    søket
                                                </button>
                                            </form>
                                        </div>
                                </div>
                                {{--                            end col--}}
                            </div>
                            {{--                        end row--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>


@endsection
