@if($obj->ad && $obj->ad->status == 'saved')
    <div class="ad_published_payment_method_div">
        <div class="form-group">
            <label class="u-t5">Betalingsløsning</label>
            <div class="row pl-3">
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

        <div class="form-group ad_form_user_package_section d-none">
            <label class="u-t5">Brukerpakke</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    @php
                        if(Auth::user()->hasRole('agent')){
                            $user_packages = \App\UserPackage::where('user_id',Auth::user()->created_by_company->user_id)->where('status',1)->where('available_ads','>',0)->get();
                        }else{
                            $user_packages = Auth::user()->packages->where('status',1)->where('available_ads','>',0);
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