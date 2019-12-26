@extends("layouts.admin")

@section('page_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('media.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="file" name="single_file" id="file" class="form-control" multiple><br>
                <input type="file" name="multi_files[]" id="files" class="form-control">
                <input type="submit" name="submit" id="submit" class="btn btn-default">
                {{--{{dd('')}}--}}
            </form>
        </div>
    </div>
</div>
@endsection