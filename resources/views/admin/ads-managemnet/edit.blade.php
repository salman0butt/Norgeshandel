@extends('layouts/admin')


@section('main_title')
    Edit Banner Ad
@endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="text-muted">Edit Ad</a> /
@endsection

@section('page_content')
 <div class="row">
             <div class="col-md-12">
                   @include('common.partials.flash-messages') </div>
            </div>
<form action="{{ url('/admin/ads/'.$banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
           
           <div class="col-md-3">
            <div class="profile" style="padding: 10px; background: #fdfdfd; border: 2px dashed #ddd;">
                <img src="{{ url('public/uploads/banners/'.$banner->image) }}" id="profile_image" style="width:100%; max-height: 250px; height:250px;" alt="">
            </div>
            <div class="custom-file">
                <input type="file" name="banner_image" class="custom-file-input" id="banner_image_select">
                <label class="custom-file-label" for="validatedCustomFile">Choose Banner ad Image...</label>
                <div class="invalid-feedback"></div>
            </div>
        </div>
        

         <div class="col-md-9">
            <div class="row">
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title" class="text-right control-label">Title:</label>
                        <input type="text" class="form-control" id="first_name"
                            autofocus name="title" value="{{ $banner->title }}" placeholder="title">
                    </div>
                </div>
            <div class="col-md-6">
                <label class="col-md-4 control-label" for="is_active">Visibilty<span class="red">*</span></label>
                <div class="col-md-12">
                    <select class="select2 form-control custom-select select2-hidden-accessible" id="is_active" name="is_active"
                            style="width: 100%;" data-select2-id="1" aria-hidden="true" required>
                        <option value="">Select</option>
                        <option value="1" {{ ($banner->is_active == 1 ? 'selected' : '') }}>Active</option>
                        <option value="0" {{ ($banner->is_active == 0 ? 'selected' : '') }}>inActive</option>
                    </select>
                </div>
            </div>
       
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description" class="text-right control-label ">Description<span
                                class="red">*</span></label>
                    <textarea name="description"  id="description" cols="30" rows="10" class="form-control" placeholder="description">{{ $banner->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="url" class="text-right control-label">Link: (Optional)</label>
                        <input type="url" class="form-control" id="url" value="{{ $banner->link }}"
                            autofocus name="url" placeholder="url">
                    </div>
                </div>
                
                 <div class="col-md-6">
                <label class="col-md-4 control-label" for="cat_id">Banner Category<span class="red">*</span></label>
                <div class="col-md-12">
                    <select class="select2 form-control custom-select select2-hidden-accessible" id="cat_id" name="cat_id"
                            style="width: 100%;" data-select2-id="1" aria-hidden="true" required>
                        <option value="">Select</option>
                        <option value="1" value="{{ ($banner->category_id == 1 ? 'selected' : '') }}">Category 1</option>
                        <option value="2" value="{{ ($banner->category_id == 2 ? 'selected' : '') }}">Category 2</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-4 control-label" for="start_at">Start Date<span class="red">*</span></label>
                <div class="col-md-12">
                  <input type="datetime-local" class="form-control" name="start_at" id="start_at"  value="{{ str_replace(' ','T',$banner->start_at) }}"
       min="2020-01-07T00:00" max="2022-06-14T00:00" required>
                </div>
            </div>
              <div class="col-md-6">
                <label class="col-md-4 control-label" for="end_at">End Date<span class="red">*</span></label>
                <div class="col-md-12">
                  <input type="datetime-local" class="form-control" name="end_at" id="end_at" value="{{str_replace(' ','T',$banner->end_at) }}"
       min="2020-01-07T00:00" max="2022-06-14T00:00" required>
                </div>
            </div>
        </div>
      
        <hr>
    </div>
    <!--            end col-md-9-->
     <div class="col-md-9 offset-3">
            <button type="submit" class="btn btn-primary btn-block">Update Ad banner</button>
        </div>
    </div>

</form>




@endsection
