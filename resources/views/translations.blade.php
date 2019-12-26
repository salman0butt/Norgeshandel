<?php
?>
<html>
<head>
    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
</head>
<body>
<form action="{{route('trans.store')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="container mt-3">
        @include('common.partials.flash-messages')
        <div class="row">
            <div class="col-md-3 font-weight-bold p-3 bg-light">String</div>
            <div class="col-md-3 font-weight-bold p-3 bg-light">Translation</div>
            <div class="col-md-3 font-weight-bold p-3 bg-light">String</div>
            <div class="col-md-3 font-weight-bold p-3 bg-light">Translation</div>
        </div>
        <div class="row">
            @for ($i=0; $i<count($strings); $i++)
                <div class="col-md-3 border-bottom p-1">
                    <input name="key[]" type="text" id="key_{{$i}}" class="form-control disabled" value="{{$strings[$i]}}" readonly>
                </div>
                <div class="col-md-3 border-bottom p-1">
                    <input name="val[]" type="text" id="val_{{$i}}" class="form-control" value="{{@$translated[$strings[$i]]}}">
                </div>
            @endfor
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary float-right mt-2 mb-2">
    </div>
</form>
</body>
</html>
<?php
