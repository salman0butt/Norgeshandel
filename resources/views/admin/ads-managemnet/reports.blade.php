@extends('layouts/admin')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>

@section('main_title')Banners Reports @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Reports</a>
@endsection
@section('page_content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                   @include('common.partials.flash-messages') 
                </div>
            </div>
        </div>
<div class="row">
    <div class="col-md-6">
         <canvas id="views" width="800" height="500"></canvas>
         <div class="col-md-12">
          <div class="card card-hover">
              <div class="box bg-success text-center">
                  <h1 class="font-light text-white"><i class="mdi mdi-eye"></i></h1>
                  <h6 class="text-white">Total views: {{ $total_views }}</h6>
              </div>
          </div>
      </div>
    </div>
        <div class="col-md-6">
         <canvas id="line-chart" width="800" height="500"></canvas>
               <div class="col-md-12">
          <div class="card card-hover">
              <div class="box bg-primary text-center">
                  <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                  <h6 class="text-white">Total clicks: {{ $total_clicks }}</h6>
              </div>
          </div>
      </div>
    </div>
</div>

</div>

@php
$year = date('Y', strtotime(now()));
$month = date('M', strtotime(now()));
$date_month = date('m', strtotime(now()));

$number = cal_days_in_month(CAL_GREGORIAN, $date_month, $year); 

@endphp

<script>
new Chart(document.getElementById("views"), {
  type: 'line',
  data: {
    labels: {!! json_encode($view_date) !!},
    datasets: [{ 
        data: {!! json_encode($view_count) !!},
        label: "Views",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Banners Views Monthly Reports'
    }
  }
});

</script>
<script>
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: {!! json_encode($click_date) !!},
    datasets: [{ 
        data: {!! json_encode($click_count) !!},
        label: "Clicks",
        borderColor: "#8e5ea2",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Banners Clicks Monthly Reports'
    }
  }
});

</script>
@endsection
