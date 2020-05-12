<!DOCTYPE html>
<html>
<head>
    <style>
        #views {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #views td, #views th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #views tr:nth-child(even){background-color: #f2f2f2;}

        #views tr:hover {background-color: #ddd;}

        #views th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #4CAF50;
            color: white;
        }
        .total td{
            background-color: black;
            color: white;
            font-weight: bold;

        }
        table td{
            text-align: center !important;
        }
        table th{
            text-align: center !important;
        }
    </style>
</head>
<body>
<h1>{{$banner && $banner->title ? $banner->title : ''}}</h1>
<hr>
<h2>Banner Views</h2>
<table id="views">
    <tr>
        <th>Key</th>
        <th>Date</th>
        <th>Views</th>
    </tr>
    @if($banner_views->count() > 0)
        @php $total_views = 0; @endphp
        @foreach($banner_views as $key=>$banner_view)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{date('d-m-Y',strtotime($banner_view->date))}}</td>
                <td>{{$banner_view->count_view}}</td>
            </tr>
            @php $total_views = $total_views + $banner_view->count_view; @endphp
        @endforeach
        <tr class="total">
            <td></td>
            <td>Total</td>
            <td>{{$total_views}}</td>
        </tr>
    @else
        <tr><td colspan="3">No record found</td></tr>
    @endif
</table>


<h2>Banner Clicks</h2>
<table id="views">
    <tr>
        <th>Key</th>
        <th>Date</th>
        <th>Clicks</th>
    </tr>
    @if($banner_clicks->count() > 0)
        @php $total_clicks = 0; @endphp
        @foreach($banner_clicks as $key=>$banner_click)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{date('d-m-Y',strtotime($banner_click->date))}}</td>
                <td>{{$banner_click->count_view}}</td>
            </tr>
            @php $total_clicks = $total_clicks + $banner_click->count_view; @endphp
        @endforeach
        <tr class="total">
            <td></td>
            <td>Total</td>
            <td>{{$total_clicks}}</td>
        </tr>
    @else
        <tr><td colspan="3">No record found</td></tr>
    @endif
</table>

</body>
</html>
