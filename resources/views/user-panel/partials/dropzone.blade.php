<div class="clearfix">
    <a href="javascript:void(0);">
        <div action="#" class="dropzone-file-area border-grey font-grey upload-box dz-clickable text-muted" style="border: 1px dashed #474445">
            <p class="">Slipp filer her eller klikk for å laste opp</p>
        </div>
    </a>
</div>
<div action="#" class="picture dropzone-previews sortable">
    @if($dropzone_img_obj && $dropzone_img_obj->ad && $dropzone_img_obj->ad->company_gallery->count() > 0)
        @foreach($dropzone_img_obj->ad->company_gallery as $company_gallery)
            <?php
            $unique_name  =  $company_gallery->name_unique;
            $path  =    \App\Helpers\common::getMediaPath($dropzone_img_obj);
            $full_path  = $path."". $unique_name;
            ?>
            <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete" >
                <div class="dz-image">
                    <img data-dz-thumbnail="" alt="image not found" src="{{$full_path}}">
                </div>
                <div class="dz-details">
                    <div class="dz-filename"><span data-dz-name="">{{@$company_gallery->name}}</span></div>
                </div>
                <a class="dz-remove" href="javascript:undefined;" data-dz-remove=""  id="{{@$company_gallery->name_unique}}">Remove file</a>

                <input type="text" class="form-control dme-form-control mt-2" placeholder="Tittel" name="image_title_{{(@$company_gallery->name_unique)}}" value="{{$company_gallery->title}}">
            </div>
        @endforeach
    @endif
</div>