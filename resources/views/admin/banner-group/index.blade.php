@extends('layouts/admin')
<style>
    ul li {
        list-style:none;
    }
</style>
@section('main_title')Banners Ads @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Banner</a>
@endsection
@section('page_content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                   @include('common.partials.flash-messages') </div>
            </div>
        </div>
 
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>

                            <th scope="col">#no</th>
                            <th scope="col">Banner name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Post Category</th>
                            <th scope="col">Page Link</th>
                            <th scope="col">Banners</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                            
       
                        @if(count($banner_groups) > 0)
                            @foreach($banner_groups as $banner_group)
                            <tr>
                                <td>{{ $banner_group->id }}</td>
                                <td>{{ $banner_group->title }}</td>
                                <td>{{ $banner_group->location }}</td>
                                <td>{{ $banner_group->post_category }}</td>
                                  <td>{{ $banner_group->page_url }}</td>
                                  <td>
                                  <ul class="p-0 mb-0">
                                  <?php $banners = $banner_group->banners; ?>
                                  @foreach($banners as $banner)

                                   <li> {{ $banner->title }}</li>

                                     @endforeach
                                     </ul>
                                  </td>
                                  <td>{{ $banner_group->time_start }}</td>
                                 <td>{{ $banner_group->time_end }}</td>
                                 
                                <td><div class="display_name mb-2"></div>
                                <a href="{{ url('admin/banner-group/'.$banner_group->id.'/edit') }}" class="btn btn-default btn-sm float-left m-1">Edit</a>
                                <form action="{{ url('admin/banner-group/'.$banner_group->id) }}" method="POST"  onsubmit="jarascript:return confirm('Are you sure to delete the Banner Group: {{$banner_group->title}} ')">
                                    {{ csrf_field() }} {{method_field('DELETE')}}
                                    <input type="submit" name="DELETE" VALUE="DELETE" class="btn btn-danger btn-sm">
                                </form>
{{--                                    {{dd($user->role)}}--}}
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8">
                                    <h4 class="m-2 text-center">There is no Banner Group to display!</h4>
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
