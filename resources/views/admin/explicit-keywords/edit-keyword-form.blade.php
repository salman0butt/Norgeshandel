<form method="post" action="{{route('admin.explicit-keywords.update',$explicit_keyword->id)}}">
    @csrf
    <input type="hidden" name="_method" value="PATCH"/>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Value</label>
            <input type="text" class="form-control input-lg" name="value" value="{{$explicit_keyword->value}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" value="submit" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
</form>
