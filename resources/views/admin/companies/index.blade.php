@extends('layouts/admin')

@section('main_title')Companies @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Comapnies</a>
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
                       
                            <th scope="col">image</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Company Type</th>
                            <th scope="col">Company Owner</th>
                            <th scope="col">Company Address</th>
                            <th scope="col">Employees</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if(isset($companies))
                            @foreach($companies as $company)
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox" data-value="{{$company->id}}" data-id="company_checklist">
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td><img style="height: 70px; width:60px;" src="@if($company->company_logo->first()!=null){{asset(\App\Helpers\common::getMediaPath($company->company_logo->first()))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif" alt="" class="mr-2"></td>
                                    <td>{{ $company->emp_name }}</td>
                                    <td>{{ $company->company_type }}</td>
                                    <td>{{ $company->user->username }}</td>
                                    <td>{{ $company->full_address }}</td>
                                    <td>{{$company->agents->count()}}</td>
                                    <td>{{ ($company->trashed() ? 'Deleted' : 'Active' ) }}</td>
                                     <td>{{ $company->created_at }}</td>
                                    <td><div class="display_name mb-2">{{$company->user->name}}</div>
                                     <a href="{{ url('admin/company/agent/'.$company->id) }}" class="btn btn-info float-left mr-1 btn-sm">View Agents</a>
                                        <a href="{{route('admin.company.view', $company->id)}}" class="btn btn-primary float-left mr-1 btn-sm">View Detail</a>
                                        @if (!$company->trashed())
                                        <form action="{{route('admin.company.delete', $company->id)}}" method="POST"  onsubmit="jarascript:return confirm('Do you want to delete this Company? Ads are deleted from this user. And you can\'t restore it again. Thanks!')">
                                            {{ csrf_field() }} {{method_field('DELETE')}}
                                            <input type="submit" name="DELETE" VALUE="DELETE" class="btn btn-danger btn-sm">
                                        </form>
                                        @endif
                                    </td>
                           
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <h4 class="m-2 text-center">There is no Company to display!</h4>
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
