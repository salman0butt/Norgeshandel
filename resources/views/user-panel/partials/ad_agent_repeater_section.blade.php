<div class="append-agent d-none">
    <div class="form-group">
        <input type="hidden" name="agent_key[]" />
        <div class="row">
            <div class="col-sm-6 pr-md-0">
                <div class="row">
                    <div class="col-12">
                        <label class="u-t5">Navn</label>
                        <input type="text" name="agent_name[]" class="dme-form-control" required="required">
                    </div>
                    <div class="col-12">
                        <label class="u-t5">Stilling</label>
                        <input type="text" name="agent_position[]" class="dme-form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input_type_file fileinput fileinput-{{trim('new')}}" data-provides="fileinput">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail mb-3" style="width: auto; height: 150px;">
                            </div>
                        </div>
                        <div class="align-self-end">
                            <a href="javascript:;" class="red fileinput-exists dme-btn-outlined-blue btn-sm dz-remove ml-2" data-dismiss="fileinput">Fjern</a>
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
                <input type="number" min="1" step="1" name="agent_mobile_no[]" class="dme-form-control" required="required">
            </div>
            <div class="col-sm-5 pr-md-0">
                <label class="u-t5">Telefon (valgfritt)</label>
                <input type="number" min="1" step="1" name="agent_telephone[]" class="dme-form-control">
            </div>
            <div class="col-sm-1 pr-md-0">
                <button type="button" id="add_more_viewing_times" class="dme-btn-outlined-blue remove-agent-button"><span class="fa fa-trash"></span></button>
            </div>
        </div>
    </div>
</div>