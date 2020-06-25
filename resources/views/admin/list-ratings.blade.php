@extends('layouts/admin')

@section('main_title')Ratings & Reviews @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Ratings & Reviews</a>
@endsection
@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        a{
            color: #ac304a;
        }
        .custom-control-input:checked~.custom-control-label::before{
            border-color: #ac304a;
            background-color: #ac304a;
        }
        .checked {
            color: orange;
        }
    </style>
@endsection
@section('page_content')
    {{--    @if(isset($response) && $response)<div class="alert alert-success">User has been added successfully</div>@endif--}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('common.partials.flash-messages')
        </div>
        
        <div class="col-md-12">
            <div class="card">
            <br>
                <div class="table-responsive">
                    <table class="table" id="zero_config">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Ad</th>
                            <th scope="col">Receiving User</th>
                            <th scope="col">Posted User</th>
                            <th scope="col">General Rating</th>
                            <th scope="col">Review</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if(isset($ratings) && $ratings->count())
                            @foreach($ratings as $rating)
                                @if($rating->ad)
                                    <tr>
                                        <td title="{{ $rating->ad && $rating->ad->getTitle() ? $rating->ad->getTitle() : '' }}">{{ $rating->ad && $rating->ad->getTitle() ? Str::limit($rating->ad->getTitle(),20) : '' }}</td>
                                        <td>{{ $rating->to_user && $rating->to_user->username ? $rating->to_user->username : 'NH-Bruker' }}</td>
                                        <td>{{ $rating->from_user && $rating->from_user->username ? $rating->from_user->username : 'NH-Bruker' }}</td>
                                        <td>
                                            @if($rating->general_ratings)
                                                @for($i=1;$i<=5;$i++)
                                                    <span class="fa fa-star {{$i <= ( $rating->general_ratings/2)  ? 'checked' : ''}}"></span>
                                                @endfor
                                            @endif
                                        </td>
                                        <td title="{{$rating->review}}">{{ Str::limit($rating->review,30) }}</td>

                                        <td>
                                             <form action="{{route('admin.delete-rating', $rating->id)}}" method="POST"  onsubmit="jarascript:return confirm('Do you want to delete this rating? This rating will be deleted permanently and it will not be shown to user. Thanks!')">
                                                {{ csrf_field() }} {{method_field('DELETE')}}
                                                <input type="submit" name="DELETE" VALUE="DELETE" class="btn btn-danger btn-sm">
                                            </form>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <h4 class="m-2 text-center">No record found.</h4>
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

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
