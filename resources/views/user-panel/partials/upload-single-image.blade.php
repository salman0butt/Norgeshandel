<div class="fileinput fileinput-@if(isset($single_image_obj) && $single_image_obj->ad && $single_image_obj->ad->company_logo->count() > 0){{trim('exists')}}@else{{trim('new')}}@endif " data-provides="fileinput">
{{--<div class="fileinput fileinput-{{trim('new')}}" data-provides="fileinput">--}}
    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;">
        @if(isset($single_image_obj) && $single_image_obj->ad && $single_image_obj->ad->company_logo->count() > 0)
            <img src="{{\App\Helpers\common::getMediaPath($single_image_obj->ad->company_logo->first())}}" alt="" />
        @endif
    </div>
    <div>
        <span class="btn default btn-file">
            <span class="fileinput-new btn btn-primary btn-sm">Velg bilde</span>
            <span class="fileinput-exists btn btn-success btn-sm">Endring</span>
            <input type="file" name="{{$file_upload_name}}">
        </span>
        @php
            $file_name_unique = '';
            if(isset($single_image_obj) && $single_image_obj->ad && $single_image_obj->ad->company_logo->count() > 0){
                $file_name_unique = $single_image_obj->ad->company_logo->first()->name_unique;
            }
        @endphp
        <a href="javascript:;" class="btn red fileinput-exists btn btn-danger btn-sm dz-remove" id="{{$file_name_unique}}" data-dismiss="fileinput">Fjerne</a>
    </div>
</div>