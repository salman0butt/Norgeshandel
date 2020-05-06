@extends('layouts.landingSite')

@section('style')
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-fileinput.css')}}">
@endsection
@section('page_content')

    <main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-10 offset-md-1 mt-5 mb-5">
                    @include('common.partials.flash-messages')
                    <h2 class="text-muted">{{$agent->name ? 'Oppdater' : 'Opprett'}} Agent</h2>

                    <form action="@if(Request::is('my-business/company-agents/*/edit')) {{route('company-agents.update',$agent->id)}} @else {{route('company-agents.store')}} @endif" method="post" id="company_agent" enctype="multipart/form-data">
                        @if(Request::is('my-business/company-agents/*/edit'))
                            <input type="hidden" class="agent_avatar_remove_value" name="agent_avatar_remove_value">
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="">
                            <div class="form-group">
                                <label class="u-t5">Selskap</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <select id="company_id" name="company_id" class="dme-form-control">
                                            <option value="">Velge</option>
                                            @if(Auth::user() && Auth::user()->property_companies->count() > 0)
                                                @foreach(Auth::user()->property_companies as $user_company)
                                                    <option value="{{$user_company->id}}" {{$agent->company_id && $agent->company_id == $user_company->id ? 'selected' : ''}}>{{$user_company->emp_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="error-span company_id"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Navn</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" name="name" value="{{$agent->name}}" class="dme-form-control"/>
                                        <span class="error-span name"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Stilling</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" name="position" value="{{$agent->position}}" class="dme-form-control"/>
                                        <span class="error-span position"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Mobil</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" name="mobile_no" value="{{$agent->mobile_no}}" class="dme-form-control"/>
                                        <span class="error-span mobile_no"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Telefon (valgfritt)</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" name="telephone_no" value="{{$agent->telephone_no}}" class="dme-form-control"/>
                                        <span class="error-span telephone_no"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Bilde</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <div class="input_type_file fileinput fileinput-@if($agent && $agent->avatar){{trim('exists')}}@else{{trim('new')}}@endif" data-provides="fileinput">
                                            <div class="">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail mb-3" style="width: auto; height: 150px;">
                                                    @if($agent && $agent->avatar)
                                                        <img src="{{\App\Helpers\common::getMediaPath($agent->avatar)}}" alt=""/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="">
                                                <a href="javascript:;" class="red fileinput-exists dme-btn-outlined-blue btn-sm ml-2 @if($agent && $agent->avatar) remove_agent_avatar @endif" data-dismiss="fileinput">Fjern</a>
                                                <span class="btn default btn-file mb-2">
                                                    <span class="fileinput-new dme-btn-outlined-blue btn-sm mt-5 mb-5">Velg bilde</span>
                                                    <input type="file" name="agent_avatar" class="input_type_file" accept="image/*">
                                                </span>
                                            </div>
                                        </div>
                                        <span class="error-span telephone_no"></span>
                                    </div>
                                </div>
                            </div>


                            <button class="dme-btn-outlined-blue mb-3 col-12">{{$agent->name ? 'Oppdater' : 'Skape'}}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

@endsection

@section('script')
    <script src="{{asset('public/js/bootstrap-fileinput.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.remove_agent_avatar', function (e) {
                $('.agent_avatar_remove_value').val('yes');
                if($('.input_type_file').hasClass('fileinput-exists')){
                    $('.input_type_file').removeClass('fileinput-exists').addClass('fileinput-new');
                }
            });
        });
    </script>
@endsection