@extends('layouts.landingSite')

@section('style')
    <style>
        .checked {
            color: orange;
        }
        .rating-stars span{
            font-size: 18px;
        }
        #buy_ads_table td{
            vertical-align: middle !important;
            text-align: center !important;
        }
        #buy_ads_table th{
            text-align: center !important;
        }
    </style>
@endsection

@section('page_content')
    <main class="cv">
        <div class="dme-container">
            <div class="row">
                <div class="breade-crumb col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('my-business')}}">Min handel</a></li> <!-- ('cv.breadcrumb.sub') -->
                            <li class="breadcrumb-item"><a>Kjøp annonser</a></li> <!-- ('cv.breadcrumb.main') -->
                        </ol>
                    </nav>
                </div>
            </div>

            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
                <table class="table table-hover table-bordered table-striped" id="buy_ads_table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Annonse</th>
                        <th>Bruker</th>
                        <th>Rangeringer</th>
                        <th>Handling</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(Auth::user()->buy_ads->count() > 0)
                            @foreach(Auth::user()->buy_ads as $key=>$buy_ad)
                                @if($buy_ad && $buy_ad->user)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$buy_ad->getTitle()}}</td>
                                        <td>{{$buy_ad->user->username ? $buy_ad->user->username : 'NH-Bruker'}}</td>
                                        <td>
                                            @if($buy_ad->ratings->where('from_user_id',Auth::id())->first())
                                                @for($i=1;$i<=5;$i++)
                                                    <span class="fa fa-star {{$i <= ($buy_ad->ratings->where('from_user_id',Auth::id())->first()->general_ratings/2)  ? 'checked' : ''}}"></span>
                                                @endfor
                                            @else
                                                Avventer
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/'.$buy_ad->id)}}" title="Vis annonse"><i class="fa fa-eye fa-lg"></i></a>
                                            @if(!$buy_ad->ratings->where('from_user_id',Auth::id())->first())
                                                <a href="{{url('my-business/my-ads/'.$buy_ad->id.'/ratings')}}" title="Gi din omtale"><i class="fab fa-telegram-plane"></i></a>
                                            @endif
                                        </td>
                                        {{--<td>--}}
                                            {{--<img class="img-thumbnail img-fluid" src="{{$agent->media ? \App\Helpers\common::getMediaPath($agent->media,'150x150') : asset('/public/images/male-avatar.jpg')}}" alt="logo" width="100">--}}
                                        {{--</td>--}}
                                        {{--<td>{{$agent->created_by_company && $agent->created_by_company->emp_name ? $agent->created_by_company->emp_name.' ('.$agent->created_by_company->company_type.')' : ''}}</td>--}}
                                        {{--<td>{{$agent->position}}</td>--}}
                                        {{--<td>{{$agent->email}}</td>--}}
                                        {{--<td>--}}
                                            {{--<a href="{{route('company-agents.edit',$agent->id)}}"><i class="fa fa-edit"></i></a>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr class="odd"><td valign="top" colspan="9" class="dataTables_empty">Ingen opptak funnet</td></tr>
                        @endif

                        @if(Auth::user()->buy_ads->count() > 0)
                            @foreach(Auth::user()->buy_ads as $key=>$buy_ad)
                                @if($buy_ad && $buy_ad->user)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$buy_ad->getTitle()}}</td>
                                        <td>{{$buy_ad->user->username ? $buy_ad->user->username : 'NH-Bruker'}}</td>
                                        <td>
                                            @if($buy_ad->ratings->where('from_user_id',Auth::id())->first())
                                                @for($i=1;$i<=5;$i++)
                                                    <span class="fa fa-star {{$i <= ($buy_ad->ratings->where('from_user_id',Auth::id())->first()->general_ratings/2)  ? 'checked' : ''}}"></span>
                                                @endfor
                                            @else
                                                Avventer
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/'.$buy_ad->id)}}" title="Vis annonse"><i class="fa fa-eye fa-lg"></i></a>
                                            @if(!$buy_ad->ratings->where('from_user_id',Auth::id())->first())
                                                <a href="{{url('my-business/my-ads/'.$buy_ad->id.'/ratings')}}" title="Gi din omtale"><i class="fab fa-telegram-plane"></i></a>
                                            @endif
                                        </td>
                                        {{--<td>--}}
                                        {{--<img class="img-thumbnail img-fluid" src="{{$agent->media ? \App\Helpers\common::getMediaPath($agent->media,'150x150') : asset('/public/images/male-avatar.jpg')}}" alt="logo" width="100">--}}
                                        {{--</td>--}}
                                        {{--<td>{{$agent->created_by_company && $agent->created_by_company->emp_name ? $agent->created_by_company->emp_name.' ('.$agent->created_by_company->company_type.')' : ''}}</td>--}}
                                        {{--<td>{{$agent->position}}</td>--}}
                                        {{--<td>{{$agent->email}}</td>--}}
                                        {{--<td>--}}
                                        {{--<a href="{{route('company-agents.edit',$agent->id)}}"><i class="fa fa-edit"></i></a>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr class="odd"><td valign="top" colspan="9" class="dataTables_empty">Ingen opptak funnet</td></tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            jquery_data_tables_languages($('#buy_ads_table'));
        } );
    </script>\
@endsection