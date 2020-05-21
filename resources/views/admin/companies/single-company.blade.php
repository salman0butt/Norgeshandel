@extends('layouts/admin')

@section('main_title')Company Detail @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Company</a>
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
        ul li {
            list-style:none;
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
            <div class="card pb-5 pt-5 pl-5">
            <div class="row">
                       <div class="col-md-3"><img class="img-fluid" src="@if($company->company_logo->first()!=null){{asset(\App\Helpers\common::getMediaPath($company->company_logo->first()))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif" alt=""></div>
                <div class="col-md-8">
                <ul>
                    <li><strong>Company Name:</strong> {{ $company->emp_name ?? ''}}</li>
                    <li><strong>Company Type:</strong>  {{ $company->company_type ?? '' }}</li>
                    <li><strong>Information:</strong>  {!! $company->emp_company_information ?? '' !!}</li>
                    <li><strong>Website:</strong>  {{ $company->emp_website ?? 'N/A' }}</li>
                    <li><strong>Facebook:</strong>  {{ $company->emp_website ?? 'N/A' }}</li>
                    <li><strong>Twitter:</strong>  {{ $company->emp_website ?? 'N/A' }}</li>
                    <li><strong>Linkdin:</strong>  {{ $company->emp_website ?? 'N/A' }}</li>
                    <li><strong>Country:</strong>  {{ $company->country ?? 'N/A' }}</li>
                    <li><strong>Zip:</strong>  {{ $company->zip ?? 'N/A' }}</li>
                    <li><strong>City:</strong>  {{ $company->zip_city ?? 'N/A' }}</li>
                    <li><strong>Address:</strong>  {{ $company->address ?? '' }}</li>
                    <li><strong>workplace_video:</strong>  {{ $company->workplace_video ?? '' }}</li>
                    <li><strong>Owner:</strong>  {{ $company->user->username ?? 'N/A' }}</li>
                    <li><strong>Created At:</strong>  {{ $company->created_at ?? 'N/A' }}</li>
                    <li><strong>Updated At:</strong>  {{ $company->updated_at ?? 'N/A' }}</li>
        
                <ul>
            </div>
         
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
