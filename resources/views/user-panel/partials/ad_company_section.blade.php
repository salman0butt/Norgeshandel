@if(Auth::user()->hasRole('company'))
    <div class="form-group">
        <label class="u-t5">Selskap</label>
        <div class="row">
            <div class="col-sm-12 pr-md-0">
                <select name="company_id" id="ad_company_id" data-ad_id ={{$ad_obj->id}} class="dme-form-control" data-ajaxurl="{{route('get-company-agents')}}" required>
                    <option value="">Velg</option>
                    @if(Auth::user()->property_companies->count() > 0)
                        @foreach(Auth::user()->property_companies as $property_company)
                            <option value="{{$property_company->id}}" {{$ad_obj && $ad_obj->company_id && $ad_obj->company_id == $property_company->id ? 'selected' : ''}}>{{$property_company->emp_name}}</option>
                        @endforeach
                    @endif
                </select>
                <span class="error-span company_id"></span>
            </div>
        </div>
    </div>
    <div class="property_ad_company_agents">
        @if($ad_obj && $ad_obj->company_id && $ad_obj->company_id)
            @php
                $ad_agents_array = array();
                $agents = $ad_obj->company->agents;
                if($ad_obj->agents->count() > 0){
                    $ad_agents_array = $ad_obj->agents->pluck('id')->toArray();
                }
            @endphp
            @include('user-panel.partials.company_agent_inner',compact('agents','ad_agents_array'))
        @endif
    </div>
@endif