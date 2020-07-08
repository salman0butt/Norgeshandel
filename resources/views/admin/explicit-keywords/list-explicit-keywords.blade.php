@extends('layouts/admin')

@section('main_title')Explicit Keywords @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Explicit Keywords</a> /
    <a href="#" class="" data-toggle="modal" data-target="#create_explicit_keyword" >Add Explicit Keyword</a>
@endsection

@section('page_content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include('common.partials.flash-messages')
        </div>
        
        <div class="col-md-12">
            <div class="card">
            <br>
                <div class="row">

                    <div class="col-6">

                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table" id="zero_config">
                        <thead class="thead-light">
                        <tr>
                            <th width="5">
                                <label class="customcheckbox mt-3">
                                    <input type="checkbox" id="mainCheckbox">
                                    <span class="checkmark"></span>
                                </label>
                                <form action="{{route('admin.destroy-multiple-keywords')}}" method="POST" class="ml-4">
                                    {{ csrf_field() }}
                                    <div id="keywords_list"></div>
                                    <input type="submit" id="delete_keywords" class="btn btn-danger btn-sm" value="DELETE" name="change_role_submit">
                                </form>
                            </th>
                            {{--<th scope="col">#</th>--}}
                            <th scope="col">Keyword</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if($explicit_keywords->count())
                            @foreach($explicit_keywords as $key=>$explicit_keyword)
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                        <input type="checkbox" class="listCheckbox" data-value="{{$explicit_keyword->id}}" data-id="keywords_checklist">
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    
{{--                                    <td>{{$key+1}}</td>--}}
                                    <td>{{$explicit_keyword->value}}</td>
                                    <td>
                                        <a href="#updateModal" class="edit-modal btn btn-primary btn-sm" data-ajaxurl="{{route('admin.explicit-keywords.edit', $explicit_keyword->id)}}" data-toggle="modal"   data-target="#updateModal">
                                            EDIT
                                        </a>

                                        <form class="d-inline" action="{{route('admin.explicit-keywords.destroy', $explicit_keyword->id)}}" method="POST"  onsubmit="jarascript:return confirm('Do you want to delete this keyword?')">
                                            {{ csrf_field() }} {{method_field('DELETE')}}
                                            <input type="submit" name="DELETE" VALUE="DELETE" class="btn btn-danger btn-sm">
                                        </form>
                                    </td>

                                </tr>
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


<!-- Reactivate ad modal -->
<div class="modal fade mt-5" id="create_explicit_keyword" tabindex="-1" role="dialog" aria-labelledby="create_explicit_keyword">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Keyword</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.explicit-keywords.store')}}" id="ad-sold" class="mb-0" method="POST">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Value</label>
                        <input type="text" class="form-control input-lg" name="value">
                        <span>Use "," to add multiple keywords</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="Submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href="#" data-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal For Update -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Keyword</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="modal-loader" class="loader padding-tb-10" style="text-align: center; display: none;">
                <img src="{{url('/')}}/public/images/loader-spinning.gif">
            </div>

            <div id="ws-dynamic-content">

            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function (e) {
            $('#delete_keywords').click(function (e) {
                var len = $( "#keywords_list" ).children('input').length;
                if(len === 0){
                    alert('Please select at least one record to delete it. Thanks!');
                    return false;
                }

            });



            $('input[data-id=keywords_checklist]').change(function (e) {
                var id = '#keyword_'+$(this).attr('data-value');
                if(this.checked){
                    $('#keywords_list').append('<input type="hidden" name="keywords[]" value="'+$(this).attr('data-value')+'" id="keyword_'+$(this).attr('data-value')+'">');
                    //console.log($(this).attr('data-value'));
                }
                else{
                    $(id).remove();
                }
            });
            $('#mainCheckbox').change(function (e) {
                $('#keywords_list input').remove();
                if (this.checked){
                    $('input[data-id=keywords_checklist]').each(function (e) {
                        $('#keywords_list').append('<input type="hidden" name="keywords[]" value="'+$(this).attr('data-value')+'" id="keyword_'+$(this).attr('data-value')+'">');
                    })
                }
            })
        })
        
        $(document).on('click','.edit-modal',function (e) {
            e.preventDefault();
            var action = $(this).data('ajaxurl');
            $('#ws-dynamic-content').hide();
            $('#modal-loader').show();
            $.ajax({
                type: "GET",
                url: action,
                dataType :"Json",
                success:function(response){
                    $('#modal-loader').hide();
                    $('#ws-dynamic-content').show();
                    $('#ws-dynamic-content').html(response.data);
                },
                failure:function () {
                    //$('#modal-loader').hide();
                }
            });


        });
    </script>
@endsection
