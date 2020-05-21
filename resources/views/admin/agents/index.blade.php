@extends('layouts/admin')

@section('main_title')Agents @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Agents</a>
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
                            <th>
                                <label class="customcheckbox m-b-20">
                                    <input type="checkbox" id="mainCheckbox">
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                       
                            {{-- <th scope="col">Agent Company</th> --}}
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if(isset($agents))
                            @foreach($agents as $agent)
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox" data-value="{{$agent->id}}" data-id="agent_checklist">
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    {{-- <td><img style="height: 70px; width:60px;" src="@if($agent->company->company_logo->first()!=null){{asset(\App\Helpers\common::getMediaPath($agent->company->company_logo->first()))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif" alt="" class="mr-2"></td> --}}
                                    {{-- <td>{{ dd($agent->company) }}</td> --}}
                                    <td>{{ $agent->username ?? 'N/A' }}</td>
                                    <td>{{ $agent->email ?? 'N/A' }}</td>
                                    <td>{{ $agent->mobile_number ?? 'N/A' }}</td>
                                    <td>{{ ($agent->address ?? ''.' '.$agent->city ?? ''.' '.$agent->zip ?? '') ?? 'N/A' }}</td>
                                    <td>{{ ($agent->status ? 'Not Active' : 'Active' ) }}</td>
                                     <td>{{ $agent->created_at }}</td>
                                    <td><div class="display_name mb-2">{{$agent->username ?? ''}}</div>
                                        {{-- <a href="{{route('admin.company.view', $agent->id)}}" class="btn btn-primary float-left mr-1 btn-sm">View Detail</a> --}}
                                        <form action="{{route('admin.agent.delete', $agent->id)}}" method="POST"  onsubmit="jarascript:return confirm('Do you want to delete this Company? Ads are deleted from this user. And you can\'t restore it again. Thanks!')">
                                            {{ csrf_field() }} {{method_field('DELETE')}}
                                            <input type="submit" name="DELETE" VALUE="DELETE" class="btn btn-danger btn-sm">
                                        </form>
                                    </td>
                           
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <h4 class="m-2 text-center">There is no Agent to display!</h4>
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
<script type="text/javascript">
    $(document).ready(function (e) {
        $('input[data-id=users_checklist]').change(function (e) {
            var id = '#user_'+$(this).attr('data-value');
            if(this.checked){
                $('#users_list').append('<input type="hidden" name="user[]" value="'+$(this).attr('data-value')+'" id="user_'+$(this).attr('data-value')+'">');
                //console.log($(this).attr('data-value'));
            }
            else{
                $(id).remove();
            }
        });
        $('#mainCheckbox').change(function (e) {
            $('#users_list input').remove();
            if (this.checked){
                $('input[data-id=users_checklist]').each(function (e) {
//                    //console.log($(this).attr('data-value'));
                    $('#users_list').append('<input type="hidden" name="user[]" value="'+$(this).attr('data-value')+'" id="user_'+$(this).attr('data-value')+'">');
                })
            }
        })
    })
</script>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
