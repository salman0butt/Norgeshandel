<div id="add_more_viewing_times_fields">
    @if($obj && $obj->ad && $obj->ad->visting_times->count() > 0)
        @foreach($obj->ad->visting_times as $key=>$visting_time)
            <div class="appended_viewing_times_fields">
                <div class="form-group">
                    <label class="u-t5">Visningsdato (valgfritt)</label>
                    <div class="row">
                        <div class="col-sm-4 pr-md-0">
                            <input type="text" name="delivery_date[]" value="{{$visting_time->delivery_date}}" class="dme-form-control date-picker">
                            <span class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="u-t5">Fra klokken (valgfritt)</label>
                    <div class="row">
                        <div class="col-sm-4 pr-md-0">
                            <input type="text" name="time_start[]" value="{{$visting_time->time_start}}" placeholder="tt.mm" class="dme-form-control">
                            <span class="u-t5">Tid (eksempel 18:00)</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="u-t5">Til klokken (valgfritt)</label>
                    <div class="row">
                        <div class="col-sm-4 pr-md-0">
                            <input type="text" name="time_end[]" value="{{$visting_time->time_end}}" placeholder="tt.mm" class="dme-form-control">
                            <span class="u-t5">Tid (eksempel 19:00)</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="u-t5">Merknad (valgfritt)</label>
                    <div class="row">
                        <div class="col-sm-12 pr-md-0">
                            <input type="text" name="note[]" value="{{$visting_time->note}}" placeholder="F.eks.: visning etter avtale"
                                   class="dme-form-control">
                        </div>
                    </div>
                </div>
                @if($key)
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 pr-md-0">
                                <button type="button" class="dme-btn-outlined-blue remove_appended_viewing_times_fields">Fjern</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="form-group">
            <label class="u-t5">Visningsdato (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="delivery_date[]" value="" class="dme-form-control date-picker">
                    <span class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Fra klokken (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="time_start[]" value="" placeholder="tt.mm" class="dme-form-control">
                    <span class="u-t5">Tid (eksempel 18:00)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Til klokken (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="time_end[]" value="" placeholder="tt.mm" class="dme-form-control">
                    <span class="u-t5">Tid (eksempel 19:00)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Merknad (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="note[]" value="" placeholder="F.eks.: visning etter avtale"
                           class="dme-form-control">
                </div>
            </div>
        </div>
    @endif
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-12 pr-md-0">
            <button type="button" id="add_more_viewing_times" class="dme-btn-outlined-blue">+ Visningstidspunt</button>
        </div>
    </div>
</div>