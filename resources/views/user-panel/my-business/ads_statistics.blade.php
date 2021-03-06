@extends('layouts.landingSite')
<style>
    /*.box {*/
        /*min-height: 200px;*/
        /*!*background: #d3d3d38a;*!*/
        /*border-radius:10px ;*/
        /*!*padding: 25px;*!*/
        /*!*margin: 10px 20px;*!*/
        /*text-align:center;*/
    /*}*/
    .col-md-3 {
        -ms-flex: 2 0 25% !important;
        flex: 2 0 25% !important;
        max-width: unset !important;
    }
    .content .far,.content span {
        color:#AC304A;
    }
    .box .content{
        min-height: 200px;
        background: #d3d3d38a;
        border-radius:10px ;
        padding: 25px;
        margin: 10px 0;
        text-align:center;
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
    <div class="dme-container col-12">
        <div class="row px-3">
            <div class="col-md-12 m-auto mt-3 my-4">
                <h2 class="text-muted mt-4">{{\App\Helpers\common::get_ad_attribute($ad,'heading')}}</h2>
                <a href="@if($ad->ad_type == 'job') {{route('jobs.show', $ad->job)}} @else {{url('/', $ad->id)}} @endif" style="float:right;margin-top: -3%;font-weight:600;">Se annonsen</a>
            </div>
        </div>
        <div class="row parent-box col-lg-12 m-auto  col-md-12 col-12 mb-5 px-0">
            <div class="box col-lg-4 col-sm-6 col-12">
                <div class="content">
                    <p class="text-center"><i class="far fa-heart" style="font-size:50px;"></i> <span
                            style="font-size:40px;">{{$count_favorite}}</span></p> har annonsen som favoritt
                </div>
            </div>
            <div class="box col-lg-4  col-sm-6 col-12">
                <div class="content">
                    <p class="text-center"><i class="far fa-envelope" style="font-size:50px;"></i> <span
                            style="font-size:40px;"> {{$ad->email_received_saved_searches->count()}}</span></p>
                    har mottat annonsen på e-post
                </div>
            </div>
            <div class="box col-lg-4  col-sm-12 col-12">
                <div class="content">
                    <p class="text-center"><i class="far fa-comments" style="font-size:50px;"></i> <span
                            style="font-size:40px;">{{$count_thread}}</span></p>
                    har trykket på send melding
                </div>
            </div>
            <div class="mt-5 col-12">
                <form>
                    <h4 style="display:inline;" class="ut-5 total_clicks_count float-left"><span>{{$total_clicks}}</span> klikk på annonsen</h4>
                    <select style="display:inline;width:unset;" class="form-control filter_ad_view float-right">
                        <option value="all_clicks">i hele annonseringsperioden</option>
                        <option value="15_days_clicks">de siste 14 dagene</option>
                    </select>
                </form>

                <p class="d-none all_clicks_count mt-4 float-left col-12 pl-0">{{$total_clicks}} klikk i hele annonseringsperioden</p>

            </div>

        </div>


        <div align="center" class="mt-4 mb-5">
         <canvas id="myChart" width="800" height="600"></canvas>
       </div>
       <div class="boxed mb-5">
       <h1><i class="far fa-user"></i> {{$once_click_users->count() + $two_to_five_time_click_users->count() + $more_than_five_time_click_users->count()}}</h1>
       <h4>personer har klikket på annonsen</h4>
       <table>
        <thead>
            <tr>
                <td>En gang</td>
                <td>&emsp;</td>
                <td class="pull-right">{{$once_click_users->count()}} Personer</td>
            </tr>
              <tr>
                <td>To till fem ganger</td>
                <td>&emsp;</td>
                <td class="pull-right">{{$two_to_five_time_click_users->count()}} Personer</td>
            </tr>
              <tr>
                <td>Mer enn fem ganger</td>
                <td>&emsp;</td>
                <td class="pull-right">{{$more_than_five_time_click_users->count()}} Personer</td>
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
        responsive: true,
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
        $('.all_clicks_count').addClass('d-none');

        if(val == '15_days_clicks'){
            $('.all_clicks_count').removeClass('d-none');
        }
        if(val){
            $.ajax({
                url: "{{url('my-business/my-ads/'.$ad->id.'/statistics')}}",
                data: {'type':val},
                type: "GET",
                success: function (response) {
                    myChart.data.datasets[0].data = 0;
                    $( myChart.data.labels ).each(function( key, index ) {
                        myChart.data.labels[key] = '';
                    });
                    myChart.update();
                    var obj = jQuery.parseJSON(response);
                    var total_clicks = obj['total_clicks'];
                    $('.total_clicks_count span').text(total_clicks);
                    if(val == '15_days_clicks'){

                        console.log(obj['ad_views']);
                        // return false;
                        if(obj['ad_views']){
                            $( obj['ad_views'] ).each(function( key, index ) {
                                myChart.data.datasets[0].data[key] = index['count_view'];
                                var date = new Date(index['date']);
                                var newDate = date.toDateString().split(' ').slice(1).join(' ');
                                myChart.data.labels[key] = newDate;//index['date'];
                                myChart.update();
                            });
                        }
                    }else{
                        if(obj['ad_views']){
                            $( obj['ad_views'] ).each(function( key, index ) {
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
