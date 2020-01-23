@extends('layouts/admin')


@section('main_title')
Add new Banner Group
@endsection
@section('breadcrumb')
<a href="#" class="text-muted">Home</a> /
<a href="#" class="text-muted">Banner Group</a> /
<a href="#" class="">@if(Request::is('admin/ads/*/edit'))Edit @else Add new @endif</a>
@endsection

@section('page_content')
<div class="col-md-12">
    @include('common.partials.flash-messages')
</div>

<form action="{{ route('banner-group-new') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
     <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title" class="text-right control-label">Title:</label>
                        <input type="text" class="form-control" id="first_name" value="" autofocus name="title"
                            placeholder="Title">
                    </div>
                </div>
                {{-- {{ dd($banners) }} --}}
                 <div class="col-md-6">
                    <label class="col-md-12">Select Banners</label>
                    <div class="form-group row" data-select2-id="12">
                        <div class="col-md-12" data-select2-id="11">
                            <select class="select2 form-control m-t-15 select2-hidden-accessible" name="banners" multiple=""
                                style="height: 36px;width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <optgroup label="BannerGroups" data-select2-id="11">
                                   {{ $banners }}
                                   @foreach($banners as $banner)
                                    <option value="{{ $banner->id }}">{{ $banner->title }}</option>
                                   @endforeach
                                </optgroup>
                            </select>
                            {{-- <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="5" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" style="display:none !important;"  role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="Nebraska" data-select2-id="74"><span class="select2-selection__choice__remove" role="presentation">×</span>Nebraska</li><li class="select2-selection__choice" title="New Mexico" data-select2-id="75"><span class="select2-selection__choice__remove" role="presentation">×</span>New Mexico</li><li class="select2-selection__choice" title="South Dakota" data-select2-id="76"><span class="select2-selection__choice__remove" role="presentation">×</span>South Dakota</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> --}}
                        </div>
                    </div>
                </div>

            </div>
        
            <div class="row">
                  <div class="col-md-6">
                    <label class="col-md-12 control-label" for="Location">Location<span class="red">*</span></label>
                    <div class="col-md-12">
                        <select class="form-control custom-select" id="Location" name="location"
                            style="width: 100%;" aria-hidden="true" required>
                            <option value="">Select</option>
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                            <option value="top">Top</option>
                        </select>
                    </div>
                </div>
              <div class="col-md-6">
                    <label class="col-md-12 control-label" for="category">Category<span class="red">*</span></label>
                    <div class="col-md-12">
                        <select class="form-control custom-select" id="post_category" name="post_category"
                            style="width: 100%;" aria-hidden="true" required>
                            <option value="">Select</option>
                            <option value="jobs">Jobs</option>
                            <option value="real-estate">Real Estate</option>
                        
                        </select>
                    </div>
                </div>

            </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-md-6">
                    <label class="col-md-12 control-label" for="time-type">Page Link<span class="red">*</span></label>
                  <input type="url" name="page_url" id="page_url" class="form-control" placeholder="Link">
                    </div>
               
                 <div class="col-md-3">
                    <label class="col-md-12 control-label" for="time-start">Start Time<span class="red">*</span></label>
                    <div class="col-md-12">
                  <input type="time" name="time_start" placeholder="Start time" class="form-control">
                    </div>
                </div>
                  <div class="col-md-3">
                    <label class="col-md-12 control-label" for="time-end">End Time<span class="red">*</span></label>
                    <div class="col-md-12">
                  <input type="time" name="time_end" placeholder="End Time" class="form-control">
                    </div>
                </div>
      </div>

            <hr>
        </div>
  
           
        <!--            end col-md-9-->
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block">Ad Banner Group</button>
        </div>
    </div>

    <!--            end row-->
</form>






<script>
    $(".select2").select2();

</script>



@endsection
