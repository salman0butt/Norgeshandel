@if(Auth::user()->hasRole('company') || Auth::user()->hasRole('agent'))
    <div class="property_ad_company_agents">
{{--        @if($ad_obj && $ad_obj->company_id && $ad_obj->company_id)--}}
            @php
                $agents = collect();
                if(Auth::user()->hasRole('company') && Auth::user()->property_companies->first() && Auth::user()->property_companies->first()->agents->count()){
                    $agents = Auth::user()->property_companies->first()->agents;
                }

                if(Auth::user()->hasRole('agent')){
                    $agents = \App\User::where('created_by_company_id',Auth::user()->created_by_company_id)->where('id','<>',Auth::id())->get();
                }
                $ad_agents_array = array();
                if($ad_obj->agents->count() > 0){
                    $ad_agents_array = $ad_obj->agents->pluck('id')->toArray();
                }
            @endphp

            @if($agents->count() > 0)
                <div class="form-group">
                    <label class="u-t5">Agenter</label>
                    <div class="row">
                        @foreach($agents as $agent)
                            <div class="col-md-12 input-toggle d-flex align-items-center">
                                <input id="{{$agent->first_name}}-{{$agent->id}}" type="checkbox" value="{{$agent->id}}" class="ad_agent_id" name="agent_id[]" {{is_numeric(array_search($agent->id, $ad_agents_array)) ? 'checked' : ''}}>
                                <label class="smalltext" for="{{$agent->first_name}}-{{$agent->id}}">
                                    <div class="media">
                                        <div class="trailing-border" style="height: 100px; width:100px;
                                                background-image: url('@if($agent->media) {{\App\Helpers\common::getMediaPath($agent->media)}} @else{{asset('public/images/male-avatar.jpg')}}@endif');
                                                background-position: center; @if($agent->media) background-repeat: no-repeat; background-size: 100%; @else background-size: cover;  @endif">
                                        </div>
                                        {{--                            <img class="img-thumbnail img-fluid" src="{{$agent->media ? \App\Helpers\common::getMediaPath($agent->media,'150x150') : asset('/public/images/male-media.jpg')}}" alt="logo" width="100">--}}
                                        <div class="media-body pl-3">
                                            <h5 class="mt-0">{{$agent->first_name.' '.$agent->last_name}}</h5>
                                            <p class="mb-1"><i class="fas fa-address-card fa-lg pr-1"></i>{{$agent->position}}</p>
                                            @if($agent->mobile_number)
                                                <p><i class="fas fa-mobile-alt fa-lg pr-1"></i>{{$agent->mobile_number}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </label>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        {{--@endif--}}
    </div>
@endif