@extends('layouts.admin')
@section('main_title')
    Properties
@endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Dashboard</a> /
    <a href="#" class="">Properties</a>
@endsection
@section('page_content')
    @include('common.partials.flash-messages')
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-12 pl-0">
                <div class="table-responsive">
                    <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 pl-0">
                        <div style="position: relative; right: -20px;">
                            @if(Request()->get('trashed'))
                                <a href="{{url('admin/property/realestate')}}">
                                    page moved to the realestates
                                </a>
                            @else
                                <a href="{{url('admin/property/realestate?trashed=properties')}}">
                                    page moved to the trash
                                </a>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="zero_config"
                                                   class="table table-striped table-bordered dataTable bg-white"
                                                   role="grid" aria-describedby="zero_config_info">
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc_disabled sorting_desc_disabled sorting_asc"
                                                        tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1"
                                                        aria-sort="ascending"
                                                        aria-label=": activate to sort column descending"
                                                        style="width: 24px;">
                                                        <label class="customcheckbox m-b-20">
                                                            <input type="checkbox" id="mainCheckbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Title: activate to sort column ascending"
                                                        style="width: 123px;">Title
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Category: activate to sort column ascending"
                                                        style="width: 193px;">Type
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 92px;">Price
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Deadline: activate to sort column ascending"
                                                        style="width: 56px;">User
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Status: activate to sort column ascending"
                                                        style="width: 78px;">Status
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Views: activate to sort column ascending"
                                                        style="width: 78px;">Views
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if($ads)
                                                    @foreach($ads as $ad)
                                                        <?php
                                                            if(Request()->get('trashed')){
                                                                $property = $ad->property()->withTrashed()->first();
                                                            }else{
                                                                $property = $ad->property;
                                                            }
                                                        ?>
                                                        <tr role="row" class="odd">
                                                            <th class="sorting_1">
                                                                <label class="customcheckbox">
                                                                    <input type="checkbox" class="listCheckbox">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </th>
                                                            <td class="sorting_1">
                                                                @if(Request()->get('trashed'))
                                                                    {{$ad->getTitle('yes') ? Str::limit($ad->getTitle('yes'),40) : ''}}
                                                                @else
                                                                    {{$ad->getTitle() ? Str::limit($ad->getTitle(),40) : ''}}
                                                                @endif
                                                                <br>
                                                                @if(Request()->get('trashed'))
                                                                    <a href="{{url('admin/property/realestate/restore/'.$ad->id)}}" class="btn-link-danger" onclick="return confirm('Er du sikker på å gjenopprette denne jobben')">Restore</a>
                                                                @else
                                                                        <a href="{{url('/', $ad->id)}}" class="mr-2">View</a>
                                                                        <a href="@if($ad->ad_type == 'property_for_rent') {{ url('new/property/rent/ad/'.$property->id.'/edit')}}
                                                                        @elseif($ad->ad_type == 'property_for_sale') {{ url('new/property/sale/ad/'.$property->id.'/edit')}}
                                                                        @elseif($ad->ad_type == 'property_business_for_sale') {{ url('add/business/for/sale/'.$property->id.'/edit')}}
                                                                        @elseif($ad->ad_type == 'property_holiday_home_for_sale') {{ url('holiday/home/for/sale/'.$property->id.'/edit')}}
                                                                        @elseif($ad->ad_type == 'property_flat_wishes_rented') {{ url('new/flat/wishes/rented/'.$property->id.'/edit')}}
                                                                        @elseif($ad->ad_type == 'property_commercial_plots') {{ url('commercial/plots/'.$property->id.'/edit')}}
                                                                        @elseif($ad->ad_type == 'property_commercial_for_sale') {{ url('add/new/commercial/property/for/sale/'.$property->id.'/edit')}}
                                                                        @elseif($ad->ad_type == 'property_commercial_for_rent') {{ url('add/new/commercial/property/for/rent/'.$property->id.'/edit')}}
                                                                        @endif" class="mr-2">Edit</a>
                                                                        <form action="{{route('admin.delete-property', $property->ad)}}" method="POST" onsubmit="javascript:return confirm('Er du sikker på å slette denne egenskapen?')">
                                                                            {{csrf_field()}}
                                                                            {{method_field('DELETE')}}
                                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                                        </form>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($ad->ad_type)
                                                                    @php
                                                                        $ad_type = array();
                                                                        $ad_type = explode('_',$ad->ad_type);
                                                                        foreach ($ad_type as $ad_type_obj){
                                                                            echo $ad_type_obj.' ';
                                                                        }
                                                                    @endphp
                                                                @endif
                                                            </td>
                                                            <td>{{\App\Helpers\common::get_ad_attribute($ad,'price')}}</td>
                                                            <td>{{$ad->user->username}}</td>
                                                            <td>{{$ad->status}} @if($ad->status=='pending') <a href="{{route('jobs.status_change', [$ad, $approve])}}">approve</a>@endif</td>
                                                            <td>{{count($ad->views)}}</td>
                                                        </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th rowspan="1" colspan="1">
                                                            <!--                                                <label class="customcheckbox m-b-20">-->
                                                            <!--                                                    <input type="checkbox" id="mainCheckbox">-->
                                                            <!--                                                    <span class="checkmark"></span>-->
                                                            <!--                                                </label>-->
                                                        </th>
                                                        <th rowspan="1" colspan="1">Title</th>
                                                        <th rowspan="1" colspan="1">Type</th>
                                                        <th rowspan="1" colspan="1">Price</th>
                                                        <th rowspan="1" colspan="1">User</th>
                                                        <th rowspan="1" colspan="1">Status</th>
                                                        <th rowspan="1" colspan="1">Views</th>
                                                        {{--<th rowspan="1" colspan="1">Views</th>--}}
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
