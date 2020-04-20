@extends('layouts.landingSite')

@section('page_content')
    <style type="text/css" id="cv_style">
        a.edit-btn {
            font-size: 15px;
            border: 1px solid;
            padding: 2px 14px;
            font-weight: 400;
        }

        .table-main {
            padding: 25px 20px 72px;
            background-color: rgba(176, 64, 88, 0.07);
            margin-top: 50px;
            border-radius: 4px;
        }

        .row-border {
            border-bottom: 1px solid #ccc;
        }

        tbody th, tbody tr {
            border-top: 1px solid #dfe4e8;
            vertical-align: top;
            font-weight: 400;
        }

        .row.row-border {
            padding-bottom: 30px;
        }
    </style>
    <main class="cv">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{url('my-business')}}">Min handel</a></li> <!-- ('cv.breadcrumb.sub') -->
                        <li class="breadcrumb-item"><a href="#">list CV</a></li> <!-- ('cv.breadcrumb.main') -->
                    </ol>
                </nav>
            </div>
            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
                  <table class="table table-hover table-bordered table-striped" id="cv_list">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Tittel</th>
                            <th>Industri</th>
                            <th>Navn</th>
                            <th>E-post</th>
                            <th>Sist oppdatert</th>
                            <th>Utløper</th>
                            <th>Handling</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($cvs->count() > 0)
                            @foreach($cvs as $key=>$cv)
                                <tr>
                                    <td>{{$cv->id}}</td>
                                    <td>
                                        {{$cv->personal && $cv->personal->title ? $cv->personal->title : ''}}
                                    </td>
                                    @php
                                        $cv_industries = array();
                                            if($cv->personal->industries){
                                                $cv_industries = json_decode($cv->personal->industries);
                                            }
                                    @endphp
                                    <td>
                                        @if(count($cv_industries))
                                            <ul class="pl-4">
                                                @foreach($cv_industries as $cv_industry)
                                                    <li>{{$cv_industry}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                        @if($cv->visibility == 'anonymous')
                                            Anonym
                                        @else
                                            {{$cv->personal && ($cv->personal->first_name || $cv->personal->last_name) ? $cv->personal->first_name.' '.$cv->personal->last_name : ''}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($cv->visibility == 'anonymous')
                                            Anonym
                                        @else
                                            {{$cv->personal && $cv->personal->email ? $cv->personal->email : ''}}
                                        @endif
                                    </td>
                                    <td>{{$cv->updated_at ? date('d-m-Y', strtotime($cv->updated_at)) : ''}}</td>
                                    <td>{{$cv->expiry ? date('d-m-Y',strtotime($cv->expiry)) : ''}}</td>
                                    <td>
                                        <a href="#" class="mr-1"><i class="far fa-heart"></i></a>
                                        @if($cv->visibility == 'anonymous')
                                            <a href="#" class="mr-1"><i class="fas fa-share"></i></a>
                                        @else
                                            <a href="{{ url('my-business/cv/view_pdf_cv', $cv->id)}}" target="_blank" class="mr-1"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('my-business/cv/download_pdf', $cv->id)}}"  target="_blank"><i class="fas fa-arrow-circle-down"></i></a>
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
<script>
$(document).ready( function () {
    $('#cv_list').DataTable({
        "order": [[ 0, "desc" ]]
    });
} );    
</script>

@endsection