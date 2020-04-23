@extends('layouts/admin')


@section('main_title')
Edit Banner Ad
@endsection
@section('breadcrumb')
<a href="#" class="text-muted">Home</a> /
<a href="#" class="text-muted">Ads</a> /
<a href="#" class="">@if(Request::is('admin/ads/*/edit'))Edit @else Add new @endif</a>
@endsection

@section('page_content')
<div class="col-md-12">
    @include('common.partials.flash-messages')
</div>

<form action="{{ url('/admin/ads/'.$banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-4 mb-1">
            <div class="profile" style="padding: 10px; background: #fdfdfd; border: 2px dashed #ddd;">
                <img src="@if($banner->media!=null){{asset(\App\Helpers\common::getMediaPath($banner->media))}}@else {{asset('public/admin/images/banners/1280x720.png')}} @endif"
                    id="banner_image" style="width:100%; max-height: 600px;min-height:150px;" alt="">
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title" class="text-right control-label">Title:</label>
                        <input type="text" value="{{$banner->title}}" class="form-control" id="first_name" autofocus
                            name="title" placeholder="Title">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="col-md-4 control-label" for="is_active">Visibilty<span class="red">*</span></label>
                    <div class="col-md-12">
                        <select class="select2 form-control custom-select" id="is_active" name="is_active"
                            style="width: 100%;" data-select2-id="1" aria-hidden="true" required>
                            <option value="">Select</option>
                            <option value="1" {{ ($banner->is_active == 1 ? 'selected' : '') }}>Active</option>
                            <option value="0" {{ ($banner->is_active == 0 ? 'selected' : '') }}>InActive</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description" class="text-right control-label ">Description<span
                                class="red">*</span></label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                            placeholder="Description">{{ $banner->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="url" class="text-right control-label">Link: (Optional)</label>
                        <input type="url" class="form-control url_http" id="url" value="{{ $banner->link }}" autofocus
                            name="url" placeholder="Url">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="col-md-12">Banner Group Select</label>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select class="select2 form-control " name="banner_group[]" multiple="multiple"
                                style="width: 100%;" data-select2-id="1">
                                @foreach($groups as $group)
                                <option value="{{ $group->id }}" data-select2-id="{{ $group->id }}"
                                    {{ ($banner->groups->contains($group) ? 'selected' : '') }}>{{ $group->title }}
                                </option>
                                @endforeach
                            </select>
                            {{--  <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="5" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" style="display:none !important;"  role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="Nebraska" data-select2-id="74"><span class="select2-selection__choice__remove" role="presentation">×</span>Nebraska</li><li class="select2-selection__choice" title="New Mexico" data-select2-id="75"><span class="select2-selection__choice__remove" role="presentation">×</span>New Mexico</li><li class="select2-selection__choice" title="South Dakota" data-select2-id="76"><span class="select2-selection__choice__remove" role="presentation">×</span>South Dakota</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="col-md-12 control-label" for="time-type">Display Time Type<span
                            class="red">*</span></label>
                    <div class="col-md-12">
                        <select class="form-control custom-select" id="time-type" name="display_time_type"
                            style="width: 100%;" aria-hidden="true" required>
                            <option value="">Select</option>
                            <option value="h" {{ ($banner->display_time_type == 'h' ? 'selected' : '') }}>Hours</option>
                            <option value="m" {{ ($banner->display_time_type == 'm' ? 'selected' : '') }}>Minutes
                            </option>
                            <option value="s" {{ ($banner->display_time_type == 's' ? 'selected' : '') }}>Seconds
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-12 control-label" for="time-type">Display Time Duration<span
                            class="red">*</span></label>
                    <div class="col-md-12">
                        <input type="number" name="display_time_duration" value="{{ $banner->display_time_duration }}"
                            placeholder="Duration" class="form-control">
                    </div>
                </div>
                    <div class="col-md-3">

                    <label class="radio-inline p-3">
                        <input type="radio" name="full_banner" value="0" {{ $banner->full_banner == 0 ? 'checked' : '' }}>Normal
                    </label>
                
                    <label class="radio-inline p-3">
                        <input type="radio" name="full_banner" value="1" {{ $banner->full_banner == 1 ? 'checked' : '' }}>Full
                    </label>
                </div>
            </div>

            <hr>
  
 
            <div class="custom-file">
                <input type="file" name="banner_image" class="custom-file-input" id="banner_image_select"
                    onchange="readURL(this);">
                <label class="custom-file-label" for="validatedCustomFile">Choose Banner ad Image...</label>
                <div class="invalid-feedback"></div>
            </div>
      


        <!--            end col-md-9-->
        <div class="mt-2">
            <button type="submit" class="btn btn-primary btn-block">Update banner</button>
        </div>
    </div>

    <!--            end row-->
</form>
      </div>
<script>
    $(".select2").select2();

</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#banner_image')
                    .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


@endsection
