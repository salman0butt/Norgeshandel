@extends('layouts/admin')



@section('breadcrumb')
        <a href="#" class="text-muted">Home</a> /
        <a href="#" class="">Dashboard</a>
@endsection

@section('page_content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row hide">
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                        <h6 class="text-white">Dashboard</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                        <h6 class="text-white">Charts</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                        <h6 class="text-white">Widgets</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                        <h6 class="text-white">Tables</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-arrow-all"></i></h1>
                        <h6 class="text-white">Full Width</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Site Analysis</h4>
                                <h5 class="card-subtitle">Overview of Latest Month</h5>
                            </div>
                        </div>
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-9">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart" style="padding: 0px; position: relative;">
                                        <canvas class="flot-base" width="759" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 759.25px; height: 300px;">

                                        </canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                                            <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 23px; text-align: center;">
                                                    0
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 83px; text-align: center;">
                                                    1
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 144px; text-align: center;">
                                                    2
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 204px; text-align: center;">
                                                    3
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 265px; text-align: center;">
                                                    4
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 325px; text-align: center;">
                                                    5
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 385px; text-align: center;">
                                                    6
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 446px; text-align: center;">
                                                    7
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 506px; text-align: center;">
                                                    8
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 567px; text-align: center;">
                                                    9
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 624px; text-align: center;">
                                                    10
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; max-width: 58px; top: 283px; left: 685px; text-align: center;">
                                                    11
                                                </div>
                                            </div>
                                            <div class="flot-y-axis flot-y1-axis yAxis y1Axis"
                                                 style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; top: 247px; left: 0px; text-align: right;">
                                                    -1.0
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; top: 191px; left: 0px; text-align: right;">
                                                    -0.5
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; top: 135px; left: 4px; text-align: right;">
                                                    0.0
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; top: 79px; left: 4px; text-align: right;">
                                                    0.5
                                                </div>
                                                <div class="flot-tick-label tickLabel"
                                                     style="position: absolute; top: 23px; left: 4px; text-align: right;">
                                                    1.0
                                                </div>
                                            </div>
                                        </div>
                                        <canvas class="flot-overlay" width="759" height="300"
                                                style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 759.25px; height: 300px;"></canvas>
                                        <div class="legend">
                                            <div style="position: absolute; width: 74px; height: 38px; top: 14px; right: 13px; background-color: rgb(255, 255, 255); opacity: 0.85;"></div>
                                            <table style="position:absolute;top:14px;right:13px;;font-size:smaller;color:#AFAFAF">
                                                <tbody>
                                                <tr>
                                                    <td class="legendColorBox">
                                                        <div style="border:1px solid #ccc;padding:1px">
                                                            <div style="width:4px;height:0;border:5px solid rgb(238,121,81);overflow:hidden"></div>
                                                        </div>
                                                    </td>
                                                    <td class="legendLabel">Realestate</td>
                                                </tr>
                                                <tr>
                                                    <td class="legendColorBox">
                                                        <div style="border:1px solid #ccc;padding:1px">
                                                            <div style="width:4px;height:0;border:5px solid rgb(79,185,240);overflow:hidden"></div>
                                                        </div>
                                                    </td>
                                                    <td class="legendLabel">Jobs</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <!--                                                <i class="fa fa-user m-b-5 font-16"></i>-->
                                            <h5 class="m-b-0 m-t-5">{{\App\User::count()}}</h5>
                                            <small class="font-light">Total Users</small>
                                        </div>
                                    </div>
                                    <div class="col-12 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <!--                                                <i class="fa fa-plus m-b-5 font-16"></i>-->
                                            <h5 class="m-b-0 m-t-5">120</h5>
                                            <small class="font-light">New Users</small>
                                        </div>
                                    </div>
                                    <div class="col-12 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <!--                                                <i class="fa fa-cart-plus m-b-5 font-16"></i>-->
                                            <h5 class="m-b-0 m-t-5">{{\App\Models\Ad::where('ad_type','job')->withTrashed()->count()}}</h5>
                                            <small class="font-light">Total Jobs</small>
                                        </div>
                                    </div>
                                    <div class="col-12 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <!--                                                <i class="fa fa-tag m-b-5 font-16"></i>-->
                                            <h5 class="m-b-0 m-t-5">{{\App\Models\Ad::where('ad_type','<>','job')->withTrashed()->count()}}</h5>
                                            <small class="font-light">Total Realestate</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- column -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Latest Ads</h4>
                    </div>
                    <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="b9ffb84b-6a73-af60-1275-ae168d98020e">
                        <!-- Comment Row -->
                        @if($ads->count() > 0)
                            @foreach($ads as $key=>$ad)
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <?php
                                        $media = '';
                                        if($ad->company_gallery->first()){
                                            $media = \App\Helpers\common::getMediaPath($ad->company_gallery->first());
                                        }else{
                                            $media = asset('public/images/placeholder.png');
                                        }
                                    ?>
                                    <div class="p-2"><img src="{{$media}}" alt="user" width="80" height="70" class=""></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{$ad->user->username}}</h6>
                                        <span class="m-b-15 d-block">
                                            <span class="font-weight-bold">
                                                @if($ad->ad_type == 'job')
                                                    {{$ad->job->name}}
                                                @else
                                                    {{$ad->getTitle() ? Str::limit($ad->getTitle(),30) : ''}}
                                                @endif
                                            </span>
                                            {{--Lorem Ipsum is simply dummy text of the printing and type setting industry. --}}
                                        </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right">{{$ad->updated_at->format('M d, Y')}}</span>
                                            <button type="button" class="btn btn-success btn-sm">Publish</button>
                                            @if($ad->ad_type == 'job')
                                                <a href="{{route('jobs.edit',$ad->job->id)}}" type="button" class="btn btn-cyan btn-sm">Edit</a>
                                                <form class="d-inline" action="{{route('admin.jobs.destroy', $ad->job)}}" method="POST"  onsubmit="jarascript:return confirm('Er du sikker på å slette denne jobben?')">
                                                    {{ csrf_field() }} {{method_field('DELETE')}}
                                                    <a class="btn btn-danger btn-sm" href="#">Delete</a>
                                                </form>

                                            @else
                                                <a href="@if($ad->ad_type == 'property_for_rent') {{ url('new/property/rent/ad/'.$ad->property->id.'/edit')}}
                                                @elseif($ad->ad_type == 'property_for_sale') {{ url('new/property/sale/ad/'.$ad->property->id.'/edit')}}
                                                @elseif($ad->ad_type == 'property_business_for_sale') {{ url('add/business/for/sale/'.$ad->property->id.'/edit')}}
                                                @elseif($ad->ad_type == 'property_holiday_home_for_sale') {{ url('holiday/home/for/sale/'.$ad->property->id.'/edit')}}
                                                @elseif($ad->ad_type == 'property_flat_wishes_rented') {{ url('new/flat/wishes/rented/'.$ad->property->id.'/edit')}}
                                                @elseif($ad->ad_type == 'property_commercial_plots') {{ url('commercial/plots/'.$ad->property->id.'/edit')}}
                                                @elseif($ad->ad_type == 'property_commercial_for_sale') {{ url('add/new/commercial/property/for/sale/'.$ad->property->id.'/edit')}}
                                                @elseif($ad->ad_type == 'property_commercial_for_rent') {{ url('add/new/commercial/property/for/rent/'.$ad->property->id.'/edit')}}
                                                @endif" class="btn btn-cyan btn-sm">Edit</a>
                                                <form class="d-inline" action="{{route('admin.delete-property', $ad)}}" method="POST" onsubmit="javascript:return confirm('Er du sikker på å slette denne egenskapen?')">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            @endif
                                            {{--<button type="button" >Delete</button>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <!-- Comment Row
                        <div class="d-flex flex-row comment-row">
                            <div class="p-2"><img src="assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text active w-100">
                                <h6 class="font-medium">Michael Jorden</h6>
                                <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                                <div class="comment-footer">
                                    <span class="text-muted float-right">May 10, 2019</span>
                                    <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                                    <button type="button" class="btn btn-success btn-sm">Publish</button>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                        -->
                        <!-- Comment Row
                        <div class="d-flex flex-row comment-row">
                            <div class="p-2"><img src="assets/images/users/5.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">Johnathan Doeting</h6>
                                <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                                <div class="comment-footer">
                                    <span class="text-muted float-right">August 1, 2019</span>
                                    <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                                    <button type="button" class="btn btn-success btn-sm">Publish</button>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                </div>
            </div>
            <!-- column -->

            <div class="col-lg-6">
                <!-- toggle part -->
                <div id="accordian-4">
                    <div class="card">
                        <a class="card-header link" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-1" aria-expanded="true" aria-controls="Toggle-1">
                            <i class="seticon fa fa-arrow-right" aria-hidden="true"></i>
                            <span>Personal Note 1</span>
                        </a>
                        <div id="Toggle-1" class="collapse show multi-collapse">
                            <div class="card-body widget-content">
                                Lorem ipsum dolor sit amet, ut minim explicari honestatis pro, per ne saperet tractatos. Ut mei esse prima constituto. No has rebum possit perfecto. At sed eleifend moderatius
                                <a href="#" class="float-right"><span class="fa fa-pencil"></span></a>
                            </div>
                        </div>
                        <a class="card-header link border-top" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-2" aria-expanded="true" aria-controls="Toggle-2">
                            <i class="seticon fa fa-arrow-right" aria-hidden="true"></i>
                            <span>Personal Note 2</span>
                        </a>
                        <div id="Toggle-2" class="collapse show" style="">
                            <div class="card-body widget-content">
                                Lorem ipsum dolor sit amet, ut minim explicari honestatis pro, per ne saperet tractatos. Ut mei esse prima constituto. No has rebum possit perfecto. At sed eleifend moderatius
                                <a href="#" class="float-right"><span class="fa fa-pencil"></span></a>
                            </div>
                        </div>
                        <a class="card-header collapsed link border-top" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-3" aria-expanded="true" aria-controls="Toggle-3">
                            <i class="seticon fa fa-arrow-right" aria-hidden="true"></i>
                            <span>Personal Note 3</span>
                        </a>
                        <div id="Toggle-3" class="collapse show">
                            <div class="card-body widget-content">
                                Lorem ipsum dolor sit amet, ut minim explicari honestatis pro, per ne saperet tractatos. Ut mei esse prima constituto. No has rebum possit perfecto. At sed eleifend moderatius
                                <a href="#" class="float-right"><span class="fa fa-pencil"></span></a>
                            </div>
                        </div>
                        <button class="btn btn-light"><span class="fa fa-plus"></span>&nbsp;Add new</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
    </div>
@endsection