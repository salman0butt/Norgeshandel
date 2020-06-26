@extends('layouts/admin')
@php
    if(!isset($package)){
        $package = new \App\Package();
    }
@endphp
@section('main_title'){{$package->title ? 'Update' : 'Add'}} Package @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Packages</a>
@endsection

@section('page_content')
    <div class="col-md-12">
        @include('common.partials.flash-messages')
    </div>

    <form action="@if($package && $package->title) {{ route('admin.packages.update',$package->id) }} @else {{ route('admin.packages.store') }} @endif" method="POST">
        @csrf @if($package->title) @method('PUT') @endif
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title" class="text-right control-label">Title:</label>
                        <input type="text" class="form-control" id="title" value="{{ old('title',$package->title) }}" name="title"
                               placeholder="Title" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="key" class="text-right control-label">Type:</label>
                        <select class="form-control" id="key" name="key" style="width: 100%;" aria-hidden="true" {{$package && $package->key ? 'disabled' : 'required'}}>
                            <option value="">Select</option>
                            <option value="eiendom" {{$package && $package->key== 'eiendom' ? 'selected' : ''}}>Eiendom</option>
                            <option value="jobb" {{$package && $package->key== 'jobb' ? 'selected' : ''}}>Jobb</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_of_ads" class="text-right control-label">No of Ads:</label>
                        <input type="number" min="1" step="1" onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}" class="form-control" id="no_of_ads" value="{{ old('no_of_ads',$package->no_of_ads) }}" name="no_of_ads"
                               placeholder="Total Ads" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="total_price" class="text-right control-label">Total Price:</label>
                        <input type="number" min="1" step="1" onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}" class="form-control" id="total_price" value="{{ old('total_price',$package->total_price) }}" name="total_price"
                               placeholder="Total Price" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="worth_values" class="text-right control-label">Total Worth Values:</label>
                        <input type="text" min="1" step="1" onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}" class="form-control" id="worth_values" value="{{ old('worth_values',$package->worth_values) }}" name="worth_values"
                               placeholder="Worth Values" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ad_expiry" class="text-right control-label">Ad Expiry:</label>
                        <input type="number" min="1" step="1" onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}" class="form-control" id="ad_expiry" value="{{ old('ad_expiry',$package->ad_expiry) }}" name="ad_expiry"
                               placeholder="Expiration of per ad" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ad_expiry_unit" class="text-right control-label">Ad Expiry In:</label>
                        <select class="form-control" id="ad_expiry_unit" name="ad_expiry_unit"
                                style="width: 100%;" aria-hidden="true" required>
                            <option value="">Select</option>
                            <option value="day" {{$package && $package->ad_expiry_unit== 'day' ? 'selected' : ''}}>Day</option>
                            <option value="month" {{$package && $package->ad_expiry_unit== 'month' ? 'selected' : ''}}>Month</option>
                            <option value="year" {{$package && $package->ad_expiry_unit== 'year' ? 'selected' : ''}}>Year</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr>
        </div>

        <!--            end col-md-9-->
        <div class="col-md-12">
            @if($package && $package->title)
                <p class="text-center"><span class="badge badge-secondary">This new changes will not be applicable on existing subscriber of this package, it will be applicable on new subscriber of this package. Thanks!</span></p>
            @endif
            <button type="submit" class="btn btn-primary btn-block">{{$package->title ? 'Update' : 'Create'}} Package</button>
        </div>

        <!--            end row-->
    </form>
@endsection