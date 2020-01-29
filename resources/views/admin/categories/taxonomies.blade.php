@extends('layouts.admin')
@section('page_content')

    <main>
        <div class="container">
            <form action="{{route('tax.store')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-3">Taxonomy Name</div>
                    <div class="col-md-7">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
{{--            @dd($taxonomies)--}}
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped mt-3">
                        <tr>
                            <th class="p-2">Id</th>
                            <th class="p-2">Name</th>
                            <th class="p-2">Slug</th>
                            <th class="p-2">Detail</th>
                        </tr>
                        @foreach($taxonomies as $tax)
                            <tr>
                                <td class="p-2">{{$tax->id}}</td>
                                <td class="p-2">{{$tax->name}}</td>
                                <td class="p-2">{{$tax->slug}}</td>
                                <td class="p-2">{{$tax->detail}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </main>

@endsection
