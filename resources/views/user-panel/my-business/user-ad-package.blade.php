@if($obj->ad && $obj->ad->status == 'saved')
    <div class="ad_published_payment_method_div">
        <div class="form-group @if($obj->ad->ad_type == 'job') row @endif">
            <label class="u-t5 @if($obj->ad->ad_type == 'job') col-2 @endif">Betalingsløsning</label>
            <div class=" @if($obj->ad->ad_type == 'job') col-md-10 col-sm-12 col-xs-12 @endif">
                <div class="col-md-12 input-toggle">
                    <input class="to_user_ad_publish checkmark" type="radio" value="online_payment" name="to_publish_ad" id="online_payment" checked>
                    <label for="online_payment" class="radio-lbl"> Bruk online betaling</label>
                </div>
                <div class="col-md-12 input-toggle">
                    <input class="to_user_ad_publish checkmark" type="radio" value="package" name="to_publish_ad" id="package">
                    <label for="package" class="radio-lbl"> Bruk pakken</label>
                </div>
            </div>
        </div>

        <div class="form-group ad_form_user_package_section d-none @if($obj->ad->ad_type == 'job') row @endif">
            <label class="u-t5 @if($obj->ad->ad_type == 'job') col-2 @endif">Brukerpakke</label>
            <div class="@if($obj->ad->ad_type == 'job') col-10 @else row @endif">
                <div class="@if($obj->ad->ad_type != 'job') col-sm-12 @endif pr-md-0">
                    @php
                        if(Auth::user()->hasRole('agent')){
                            $user_id = Auth::user()->created_by_company->user_id;
                            $created_user = \App\User::find($user_id);
                            $user = $created_user;
                        }else{
                            $user = Auth::user();
                        }

                        if($user){
                            if($obj->ad->ad_type == 'job'){
                                $user_packages = $user->job_packages->where('status',1)->where('available_ads','>',0);
                            }else{
                                $user_packages = $user->property_packages->where('status',1)->where('available_ads','>',0);
                            }
                        }
                    @endphp
                    <select id="package_id" name="package_id" class="dme-form-control"  required>
                        <option value="">Velg</option>
                        @if($user_packages->count())
                            @foreach($user_packages as $user_package)
                                <option value="{{$user_package->id}}">{{$user_package->package->title. '('.$user_package->available_ads.')'}}</option>
                            @endforeach
                        @endif

                    </select>
                    <span class="error-span package_id"></span>

                </div>
            </div>
        </div>
    </div>
@endif