<div class="append-agent-section">
    @if(count($ad_agents))
        @foreach($ad_agents as $key=>$ad_agent)
            <div class="single remove">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6 pr-md-0">
                            <label class="u-t5">Navn</label>
                            <input type="text" name="agent_name[]" value="{{$ad_agent->name}}" class="dme-form-control" required>
                        </div>
                        <div class="col-sm-6 pr-md-0">
                            <label class="u-t5">Stilling</label>
                            <input type="text" name="agent_position[]" value="{{$ad_agent->position}}" class="dme-form-control" required>
                        </div>
                        <div class="col-sm-6 pr-md-0">
                            <label class="u-t5">Mobil</label>
                            <input type="number" min="1" step="1" name="agent_mobile_no[]" value="{{$ad_agent->mobile_no}}" class="dme-form-control" required>
                        </div>
                        <div class="col-sm-5 pr-md-0">
                            <label class="u-t5">Telefon (valgfritt)</label>
                            <input type="number" min="1" step="1" name="agent_telephone[]" value="{{$ad_agent->telephone}}" class="dme-form-control">
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