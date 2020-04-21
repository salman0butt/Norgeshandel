@extends('layouts/admin')

@section('main_title')
Edit Banner Group
@endsection
@section('breadcrumb')
<a href="#" class="text-muted">Home</a> /
<a href="#" class="text-muted">Banner Group</a> /
<a href="#" class="">@if(Request::is('admin/banner-group/*/edit'))Edit @else Add new @endif</a>
@endsection

@section('page_content')
<div class="col-md-12">
    @include('common.partials.flash-messages')
</div>

<form action="{{ url('/admin/banner-group/'.$banner_group->id) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
     <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title" class="text-right control-label">Title:</label>
                        <input type="text" class="form-control" id="first_name" value="{{ $banner_group->title}}" autofocus name="title"
                            placeholder="Title">
                    </div>
                </div>
                {{-- {{ dd($banners) }} --}}
                 <div class="col-md-6">
                    <label class="col-md-12">Select Banners</label>
                    <div class="form-group row" data-select2-id="12">
                        <div class="col-md-12" data-select2-id="11">
                            <select class="select2 form-control m-t-15 select2-hidden-accessible" name="banners[]" multiple=""
                                style="height: 36px;width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <optgroup label="BannerGroups" data-select2-id="11">
                                 
                                   @foreach($banners as $banner)
                                    <option value="{{ $banner->id }}" {{ ($banner_group->banners->contains($banner) ? 'selected' : '')}} >{{ $banner->title }}</option>
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
                        <select class="form-control custom-select select2" id="position" name="location[]"
                            style="width: 100%;" aria-hidden="true" required multiple>
                              @php
                            $arr = array('');
                              foreach ($banner_group->positions as $pos){
                                  $arr[$pos->position] = $pos->position;
                                 
                              }    
                                      
                            @endphp
                            <option value="left"{{ ( isset($arr['left']) == 'left' ? 'selected' : '')}}>Left</option>
                            <option value="right" {{ (isset($arr['right']) == 'right' ? 'selected' : '')}}>Right</option>
                            <option value="top" {{ (isset($arr['top']) == 'top' ? 'selected' : '')}}>Top</option>
                        </select>
                    </div>
                </div>
              <div class="col-md-6">
                    <label class="col-md-12 control-label" for="category">Category<span class="red">*</span></label>
                    <div class="col-md-12">
                        <select class="form-control custom-select" id="post_category" name="post_category"
                            style="width: 100%;" aria-hidden="true" required>
                            <option value="">Select</option>
                            <option value="home" {{ ($banner_group->post_category == 'home' ? 'selected' : '')}}>Home</option>
                             <option value="jobs-main" {{ ($banner_group->post_category == 'jobs-main' ? 'selected' : '')}}>Jobs main Category</option>
                            <option value="jobs-sub" {{ ($banner_group->post_category == 'jobs-sub' ? 'selected' : '')}}>Jobs sub Category</option>
                            <option value="real-estate-main" {{ ($banner_group->post_category == 'real-estate-main' ? 'selected' : '')}}>Real Estate main Category</option>
                            <option value="real-estate-sub" {{ ($banner_group->post_category == 'real-estate-sub' ? 'selected' : '')}}>Real Estate sub Category</option>
                            <option value="ad-landing" {{ ($banner_group->post_category == 'ad-landing' ? 'selected' : '')}}>Ads Landing Page</option>
                        
                        </select>
                    </div>
                </div>

            </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-md-6">
                    <label class="col-md-12 control-label" for="time-type">Page Link<span class="red">*</span></label>
                  <input type="url" name="page_url" value="{{ $banner_group->page_url }}" id="page_url" class="form-control url_http" placeholder="Link">
                    </div>

                 <div class="col-md-3">
                    <label class="col-md-12 control-label" for="time-start">Start Time<span class="red">*</span></label>
                    <div class="col-md-12">
                        <input type="datetime-local" name="time_start" value="{{date('Y-m-d\TH:i:s',strtotime($banner_group->time_start))}}" placeholder="Start time" class="form-control">
                    </div>
                </div>
                  <div class="col-md-3">
                    <label class="col-md-12 control-label" for="time-end">End Time<span class="red">*</span></label>
                    <div class="col-md-12">
                  <input type="datetime-local" name="time_end" placeholder="End Time" value="{{date('Y-m-d\TH:i:s',strtotime($banner_group->time_end))}}" class="form-control">
                    </div>
                </div>
      </div>

            <hr>
        </div>
  
           
        <!--            end col-md-9-->
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block">Update Banner Group</button>
        </div>
    </div>

    <!--            end row-->
</form>






<script>
    $(".select2").select2();

</script>
        <script>
                 
                        $('select').on('select2:select', function (e) {
                            var data = e.params.data;
                         
                            if(data.id == 'top'){
                             this.children[0].setAttribute('disabled','disabled');
                              this.children[1].setAttribute('disabled','disabled');
                             $(".select2").select2();
                            }else if(data.id == 'left' || data.id == 'right') {
                            this.children[2].setAttribute('disabled','disabled');
                             $(".select2").select2();
                            }
                        });
                            $('select').on('select2:unselect', function (e) {
                            var data = e.params.data;
                            if(data.id == 'top'){
                              this.children[0].removeAttribute('disabled');
                              this.children[1].removeAttribute('disabled');
                              $(".select2").select2();
                            }  else if(data.id == 'left' || data.id == 'right') {
                              this.children[2].removeAttribute('disabled');
                               $(".select2").select2();
                            }
                        });

                    </script>


@endsection
