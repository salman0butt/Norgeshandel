@extends('layouts.landingSite')

@section('style')
    <style>
        #user_packages_table td{
            vertical-align: middle !important;
            text-align: center !important;
        }
        #user_packages_table th{
            text-align: center !important;
        }
    </style>
@endsection

@section('page_content')
    <main class="user-package">
        <div class="dme-container">
            <div class="row">
                <div class="breade-crumb col-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('my-business')}}">Min handel</a></li> <!-- ('cv.breadcrumb.sub') -->
                            <li class="breadcrumb-item"><a>Pakker</a></li> <!-- ('cv.breadcrumb.main') -->
                        </ol>
                    </nav>
                </div>
                <div class="breade-crumb col-2 pl-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('price-chart')}}" class="" >Kjøp pakke</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
                <table class="table table-hover table-bordered table-striped" id="user_packages_table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Tittel</th>
                        <th>Totalt Annonser</th>
                        <th>Varighet</th>
                        <th>Tilgjengelige annonser</th>
                        <th>Pakkepris</th>
                        <th>Kjøpt dato</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($user_packages->count() > 0)
                        @foreach($user_packages as $key=>$user_package)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user_package->package ? $user_package->package->title : ''}}</td>
                                <td>{{$user_package->total_ads}}</td>
                                <td>{{$user_package->ad_expiry.' '.$user_package->ad_expiry_unit}}</td>
                                <td>{{$user_package->available_ads}}</td>
                                <td>{{$user_package->total_price.' kr'}}</td>
                                <td>{{$user_package->purchased_date}}</td>
                                <td>
                                    @if($user_package->status)
                                      <span class="badge badge-success">Aktiv</span>
                                    @else
                                        <span class="badge badge-warning">Deaktiver</span>
                                    @endif
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
            jquery_data_tables_languages($('#user_packages_table'));
        } );
    </script>\
@endsection