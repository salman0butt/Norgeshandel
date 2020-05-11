@extends('layouts.landingSite')

@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        a{
            color: #ac304a;
        }
        .custom-control-input:checked~.custom-control-label::before{
            border-color: #ac304a;
            background-color: #ac304a;
        }
    </style>
@endsection

@section('page_content')
    <style type="text/css">
        #agents_table td{
            vertical-align: middle !important;
            text-align: center !important;
        }
        #agents_table th{
            text-align: center !important;
        }
    </style>
    <main class="cv">
        <div class="dme-container">
            <div class="row">
                <div class="breade-crumb col-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('my-business')}}">Min handel</a></li> <!-- ('cv.breadcrumb.sub') -->
                            <li class="breadcrumb-item"><a href="{{url('my-business/profile')}}">Endre profil</a></li> <!-- ('cv.breadcrumb.main') -->
                            <li class="breadcrumb-item"><a>Bedriftsagenter</a></li> <!-- ('cv.breadcrumb.main') -->
                        </ol>
                    </nav>
                </div>
                <div class="breade-crumb col-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('my-business/company-agents/create')}}">Legg til eiendomsmegler</a></li> <!-- ('cv.breadcrumb.main') -->
                        </ol>
                    </nav>
                </div>
            </div>

            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
                <table class="table table-hover table-bordered table-striped" id="agents_table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Velg bilde</th>
                        <th>Stilling</th>
                        <th>E-post</th>
                        <th>Status</th>
                        <th>Handling</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(Auth::user()->property_companies->first() && Auth::user()->property_companies->first()->agents->count() > 0)
                            @foreach(Auth::user()->property_companies->first()->agents as $agent)
                            <tr>
                                <td>{{$agent->id}}</td>
                                <td>
                                    <img class="img-thumbnail img-fluid" src="{{$agent->media ? \App\Helpers\common::getMediaPath($agent->media,'150x150') : asset('/public/images/male-avatar.jpg')}}" alt="logo" width="100">
                                </td>
                                <td>{{$agent->position}}</td>
                                <td>{{$agent->email}}</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" data-ajaxurl="{{url('change-status')}}" data-class="{{\App\User::class}}" data-column="account_status" class="custom-control-input status" id="agent_{{$agent->id}}" {{$agent->account_status == 1 ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="agent_{{$agent->id}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('company-agents.edit',$agent->id)}}"><i class="fa fa-edit"></i></a>
                                    {{--<form class="d-inline" action="{{route('company-agents.destroy',$agent->id)}}"--}}
                                          {{--method="POST"--}}
                                          {{--onsubmit="jarascript:return confirm('Vil du slette denne agenten? Du kan ikke gjenopprette det igjen.')">--}}
                                        {{--{{method_field('DELETE')}}--}}
                                        {{--{{csrf_field()}}--}}
                                        {{--<button type="submit" class="link">--}}
                                            {{--<i class="fa fa-trash"></i>--}}
                                        {{--</button>--}}
                                    {{--</form>--}}

                                </td>
                            </tr>
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
            jquery_data_tables_languages($('#agents_table'));
        } );
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection