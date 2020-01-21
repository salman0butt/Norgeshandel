@extends('layouts/admin')

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
                        
                            <th scope="col">Ad name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Link</th>
                            <th scope="col">Clicks</th>
                            <th scope="col">Started At</th>
                            <th scope="col">Ended At</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if(count($banners) > 0)
                            @foreach($banners as $banner)
                            <tr>
                                <td>{{ $banner->title }}</td>
                                <td><img style="height: 70px; width:60px;" src="{{ url('public/uploads/banners/'.$banner->image) }}" alt="" class="mr-2"></td>
                                <td>{{ $banner->description }}</td>
                                <td>{{ $banner->link }}</td>
                                  <td>{{ $banner->clicks }}</td>
                                  <td>{{ $banner->start_at }}</td>
                                 <td>{{ $banner->end_at }}</td>
                                  <td>{{ ($banner->is_active ==1 ? 'Active':'Inactive') }}</td>
                                <td><div class="display_name mb-2"></div>
                                <a href="{{ url('admin/ads/'.$banner->id.'/edit') }}" class="btn btn-default btn-sm float-left m-1">Edit</a>
                                <form action="{{ url('admin/ads/'.$banner->id) }}" method="POST"  onsubmit="jarascript:return confirm('Are you sure to delete the Ad:{{$banner->title}} ')">
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
                                    <h4 class="m-2 text-center">There is no user to display!</h4>
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
