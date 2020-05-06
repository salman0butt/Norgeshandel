<div class="form-group">
    <label class="u-t5">Agenter</label>
    <div class="row">
        @if($agents->count() > 0)
            @foreach($agents as $agent)
                <div class="col-md-12 input-toggle d-flex align-items-center">
                    <input id="{{$agent->name}}-{{$agent->id}}" type="checkbox" value="{{$agent->id}}" class="ad_agent_id" name="agent_id[]" {{is_numeric(array_search($agent->id, $ad_agents_array)) ? 'checked' : ''}}>
                    <label class="smalltext" for="{{$agent->name}}-{{$agent->id}}">
                        <div class="media">
                            <div class="trailing-border" style="height: 100px; width:100px;
                                    background-image: url('@if($agent->avatar) {{\App\Helpers\common::getMediaPath($agent->avatar)}} @else{{asset('public/images/male-avatar.jpg')}}@endif');
                                    background-position: center; @if($agent->avatar) background-repeat: no-repeat; background-size: 100%; @else background-size: cover;  @endif">
                            </div>
{{--                            <img class="img-thumbnail img-fluid" src="{{$agent->avatar ? \App\Helpers\common::getMediaPath($agent->avatar,'150x150') : asset('/public/images/male-avatar.jpg')}}" alt="logo" width="100">--}}
                            <div class="media-body pl-3">
                                <h5 class="mt-0">{{$agent->name}}</h5>
                                <p class="mb-1"><i class="fas fa-address-card fa-lg pr-1"></i>{{$agent->position}}</p>
                                <p><i class="fas fa-mobile-alt fa-lg pr-1"></i>{{$agent->mobile_no}}</p>
                            </div>
                        </div>
                    </label>

                </div>
            @endforeach
        @endif
    </div>
</div>