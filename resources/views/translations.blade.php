<?php
    $total = 0;
    $new_translations = 0;
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
            <?php $i = 0; ?>
            @foreach($translated as $key=>$value)
                <div class="col-md-3 border-bottom p-1">
                    <input name="key[]" type="text" id="key_{{$i}}" class="form-control disabled" value="{{$key}}" readonly>
                </div>
                <div class="col-md-3 border-bottom p-1">
                    <input name="val[]" type="text" id="val_{{$i}}" class="form-control" value="{{$value}}">
                </div>
            <?php $i++; $total++;?>
            @endforeach
            @for ($i=0; $i<count($strings); $i++)
                @if(!array_key_exists($strings[$i], $translated))
                    <div class="col-md-3 border-bottom p-1">
                        <input name="key[]" type="text" id="key_{{$i}}" class="form-control disabled" value="{{$strings[$i]}}" readonly>
                    </div>
                    <div class="col-md-3 border-bottom p-1">
                        <input name="val[]" type="text" id="val_{{$i}}" class="form-control" value="{{@$translated[$strings[$i]]}}">
                    </div>
                    <?php $total++; ?>
                @endif
            @endfor
{{--                {{dd(count($strings))}}--}}
            <div class="col-md-12 font-weight-bold">Total {{$total}} ({{$total-count($translated)}} untranslted)</div>

        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary float-right mt-2 mb-2">
    </div>
</form>
</body>
</html>
<?php
