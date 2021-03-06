<div class="input_type_file fileinput fileinput-@if(isset($single_image_obj) && $single_image_obj->ad && $single_image_obj->ad->company_logo->count() > 0){{trim('exists')}}@else{{trim('new')}}@endif " data-provides="fileinput">
{{--<div class="fileinput fileinput-{{trim('new')}}" data-provides="fileinput">--}}
    <div class="d-flex justify-content-between">
        <div class="">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail mb-3" style="width: auto; height: 150px;">
                @if(isset($single_image_obj) && $single_image_obj->ad && $single_image_obj->ad->company_logo->count() > 0)
                    <img src="{{\App\Helpers\common::getMediaPath($single_image_obj->ad->company_logo->first())}}" alt=""/>
                @endif
            </div>
        </div>
        <div class="align-self-end">
            @php
                $file_name_unique = '';
                if(isset($single_image_obj) && $single_image_obj->ad && $single_image_obj->ad->company_logo->count() > 0){
                    $file_name_unique = $single_image_obj->ad->company_logo->first()->name_unique;
                }
            @endphp
            <a href="javascript:;" class="red fileinput-exists dme-btn-outlined-blue btn-sm dz-remove ml-2" id="{{$file_name_unique}}" data-dismiss="fileinput">Fjern</a>
            <span class="btn default btn-file mb-2">
            <span class="fileinput-new dme-btn-outlined-blue btn-sm mt-5 mb-5">Velg bilde</span>
                {{--<span class="fileinput-exists dme-btn-outlined-blue btn-sm">Endre</span>--}}
                <input type="file" name="{{$file_upload_name}}" class="input_type_file" accept="image/*">
        </span>
        </div>
    </div>
</div>