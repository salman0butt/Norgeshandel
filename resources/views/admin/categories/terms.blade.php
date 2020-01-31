@extends('layouts.admin')
@section('page_content')

    <main>
        <div class="container">
            <form action="{{route('term.store')}}">
                {{csrf_field()}}
                <div class="row form-group">
                    <div class="col-md-2">Term Name</div>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <select name="parent" id="" class="form-control">
                            <option value="">Select parent</option>
                            @foreach($terms as $term)
                                <option value="{{$term->id}}">{{$term->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">Select term type</div>
                    <div class="col-md-8">
                        <select name="parent" id="" class="form-control" required>
                            <option value="">Select Type</option>
                            @foreach($taxonomies as $tax)
                                <option value="{{$tax->id}}">{{$tax->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped mt-3">
                        <tr>
                            <th class="p-2">Id</th>
                            <th class="p-2">Name</th>
                            <th class="p-2">Slug</th>
                            <th class="p-2">Parent</th>
                            <th class="p-2">Type</th>
                        </tr>
                        @foreach($terms as $term)
                            <tr>
                                <td class="p-2">{{$term->id}}</td>
                                <td class="p-2">{{$term->name}}</td>
                                <td class="p-2">{{$term->slug}}</td>
                                <td class="p-2">{{$term->getParent?$term->getParent->name:""}}</td>
                                <td class="p-2">{{$term->taxonomy->name}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </main>

@endsection
