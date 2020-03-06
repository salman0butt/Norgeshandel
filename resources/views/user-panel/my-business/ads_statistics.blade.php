@extends('layouts.landingSite')
<style>
    .box {
        min-height: 200px;
        background: #d3d3d38a;
        border-radius:10px;
        padding: 25px;
        margin: 10px;
        text-align:center;
    }
    .col-md-3 {
        -ms-flex: 2 0 25% !important;
        flex: 2 0 25% !important;
        max-width: unset !important;
    }
    .content .far,.content span {
        color:#AC304A;
    }
    .boxed {
        background: #ac304a1f;
        border-radius: 10px;
        padding: 30px 20px;
    }
</style>
@section('page_content')
<main>
    @php
        $total_clicks = 0;
        if($ad_views->count() > 0){
            foreach ($ad_views as $ad_view){
                $total_clicks = $total_clicks + $ad_view->count_view;
            }
        }
    @endphp
    <div class="dme-container">
        <div class="row">
            <div class="col-md-10 offset-md-1 mt-3 mb-4">
                <h2 class="text-muted">Brio Barneseng</h2>
                <a href="@if($ad->ad_type == 'job') {{route('jobs.show', $ad->job)}} @else {{url('general/property/description', [$ad->property->id, $ad->ad_type])}} @endif" style="float:right;margin-top: -3%;font-weight:600;">Se annonsen</a>
            </div>
        </div>
        <div class="row parent-box col-md-10 offset-1 mb-5">
            <div class="box col-md-3">
                <div class="content">
                    <p class="text-center"><i class="far fa-heart" style="font-size:50px;"></i> <span
                            style="font-size:40px;">{{$count_favorite}}</span></p> har annonsen som favoritt
                </div>
            </div>
            <div class="box col-md-3">
                <div class="content">
                    <p class="text-center"><i class="far fa-envelope" style="font-size:50px;"></i> <span
                            style="font-size:40px;">120</span></p>
                    har mottat annonsen på e-post
                </div>
            </div>
            <div class="box col-md-3">
                <div class="content">
                    <p class="text-center"><i class="far fa-comments" style="font-size:50px;"></i> <span
                            style="font-size:40px;">{{$count_thread}}</span></p>
                    har trykket på send melding
                </div>
            </div>
            <div class="mt-5">
                <h4 style="display:inline;" class="ut-5">{{$total_clicks}} klikk på annonsen</h4>
                <form action="#" style="display:inline;">
                <select style="display:inline;width:unset;margin-left: 20px;" class="form-control filter_ad_view">
                    <option value="all_clicks">i hele annonseringsperioden</option>
                    <option value="15_days_clicks">de siste 14 dagene</option>
                    </select>
                </form>
            </div>
        </div>

       <div align="center" class="mt-4 mb-5">
         <canvas id="myChart" width="800" height="600"></canvas>
       </div>
       <div class="boxed mb-5">
       <h1><i class="far fa-user"></i> {{$total_clicks}}</h1>
       <h4>personer har klikket på annonsen</h4>
       <table>
        <thead>
            <tr>
                <td>En gang</td>
                <td>&emsp;</td>
                <td class="pull-right">0 Personer</td>
            </tr>
              <tr>
                <td>To till fem ganger</td>
                <td>&emsp;</td>
                <td class="pull-right">0 Personer</td>
            </tr>
              <tr>
                <td>Mer enn fem ganger</td>
                <td>&emsp;</td>
                <td class="pull-right">0 Personer</td>
            </tr>
        </thead>
       </table>
       </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>


    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
            @php
                if($ad_views->count() > 0){
                    foreach ($ad_views as $ad_view){
                        echo '"'.$ad_view->month.' '.$ad_view->year.'"'.', ';
                    }
                }
            @endphp
            //"1,Jan", "2,Jan", "3,Jan", "4,Feb", "5,March"
        ],
        datasets: [{
          maxBarThickness: 100,
          label: 'Ad Views',
          data: [
              @php
                if($ad_views->count() > 0){
                    foreach ($ad_views as $ad_view){
                        echo $ad_view->count_view.',';
                    }
                }
              @endphp

              // 12, 19, 3, 8, 2, 3, 16, 3, 5, 9, 2, 1
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: false,
        scales: {
          xAxes: [{
            ticks: {
              maxRotation: 90,
              minRotation: 80
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });


    $(document).on('change', '.filter_ad_view', function () {
        var val = $(this).val();
        if(val){
            $.ajax({
                url: "{{url('my-business/my-ads/'.$ad->id.'/statistics')}}",
                data: {'type':val},
                type: "GET",
                success: function (response) {
                    // return false;
                    myChart.data.datasets[0].data = 0;
                    $( myChart.data.labels ).each(function( key, index ) {
                        myChart.data.labels[key] = '';
                    });
                    myChart.update();
                    if(val == '15_days_clicks'){
                        var obj = jQuery.parseJSON(response);
                        if(obj){
                            $( obj ).each(function( key, index ) {
                                myChart.data.datasets[0].data[key] = index['count_view'];
                                var date = new Date(index['date']);
                                var newDate = date.toDateString().split(' ').slice(1).join(' ');
                                myChart.data.labels[key] = newDate;//index['date'];
                                myChart.update();
                            });
                        }
                    }else{
                        var obj = jQuery.parseJSON(response);
                        if(obj){
                            $( obj ).each(function( key, index ) {
                                myChart.data.datasets[0].data[key] = index['count_view'];
                                myChart.data.labels[key] = index['month']+' '+index['year'];
                                myChart.update();
                            });
                        }
                    }

                }
            });
        }
    });
</script>
@endsection
