<div class="append-agent-section">
    @if($ad->agents->count())
        @foreach($ad->agents as $key=>$ad_agent)
            <div class="single remove">
                <div class="form-group">
                    @php
                        if($ad_agent->agent_details){
                            $ad_agent_details = json_decode($ad_agent->agent_details);
                        }
                    @endphp
                    <div class="row">
                        <div class="col-sm-6 pr-md-0">
                            <div class="row">
                                <div class="col-12">
                                    <label class="u-t5">Navn</label>
                                    <input type="text" name="agent_name[]" value="{{$ad_agent_details->name}}" class="dme-form-control" required="required">
                                </div>
                                <div class="col-12">
                                    <label class="u-t5">Stilling</label>
                                    <input type="text" name="agent_position[]" value="{{$ad_agent_details->position}}" class="dme-form-control" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input_type_file fileinput fileinput-@if(isset($ad_agent) && $ad_agent->avatar){{trim('exists')}}@else{{trim('new')}}@endif " data-provides="fileinput">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail mb-3" style="width: auto; height: 150px;">
                                            @if(isset($ad_agent) && $ad_agent->avatar)
                                                <img src="{{\App\Helpers\common::getMediaPath($ad_agent->avatar)}}" alt=""/>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="align-self-end">
                                        @php
                                            $file_name_unique = '';
                                            if(isset($ad_agent) && $ad_agent->avatar){
                                                $file_name_unique = $ad_agent->avatar->name_unique;
                                            }
                                        @endphp
                                        <a href="javascript:;" class="red fileinput-exists dme-btn-outlined-blue btn-sm dz-remove ml-2" id="{{$file_name_unique}}" data-dismiss="fileinput">Fjern</a>
                                        <span class="btn default btn-file mb-2">
                                            <span class="fileinput-new dme-btn-outlined-blue btn-sm mt-5 mb-5">Velg bilde</span>
                                            <input type="file" name="agent_avatar[]" class="input_type_file" accept="image/*">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 pr-md-0">
                            <label class="u-t5">Mobil</label>
                            <input type="number" min="1" step="1" name="agent_mobile_no[]" value="{{$ad_agent_details->mobile_no}}" class="dme-form-control" required>
                        </div>
                        <div class="col-sm-5 pr-md-0">
                            <label class="u-t5">Telefon (valgfritt)</label>
                            <input type="number" min="1" step="1" name="agent_telephone[]" value="{{$ad_agent_details->telephone}}" class="dme-form-control">
                        </div>
                        <div class="col-sm-1 pr-md-0">
                            <button type="button" id="add_more_viewing_times" class="dme-btn-outlined-blue remove-agent-button"><span class="fa fa-trash"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>