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
        padding:30px 20px;
    }
</style>
@section('page_content')
<main>
    <div class="dme-container">
        <div class="row">
            <div class="col-md-10 offset-md-1 mt-3 mb-4">
                <h2 class="text-muted">Brio Barneseng</h2>
                <a href="#" style="float:right;margin-top: -3%;font-weight:600;">Se annonsen</a>
            </div>
        </div>
        <div class="row parent-box col-md-10 offset-1 mb-5">
            <div class="box col-md-3">
                <div class="content">
                    <p class="text-center"><i class="far fa-heart" style="font-size:50px;"></i> <span
                            style="font-size:40px;">11</span></p> Lorem ipsum dolor
                </div>
            </div>
            <div class="box col-md-3">
                <div class="content">
                    <p class="text-center"><i class="far fa-envelope" style="font-size:50px;"></i> <span
                            style="font-size:40px;">120</span></p>
                    Lorem ipsum dolor
                </div>
            </div>
            <div class="box col-md-3">
                <div class="content">
                    <p class="text-center"><i class="far fa-comments" style="font-size:50px;"></i> <span
                            style="font-size:40px;">780</span></p>
                    Lorem ipsum dolor 
                </div>
            </div>
            <div class="mt-5">
                <h4 style="display:inline;" class="ut-5">89 Some Text There</h4> 
                <form action="#" style="display:inline;">
                <select style="display:inline;width:unset;margin-left: 20px;" class="form-control">
                    <option value="">Choose options</option>
                    <option value="">Option 1</option>
                    <option value="">Option 2</option>
                    </select>
                </form>
            </div>
        </div>

       <div align="center" class="mt-4 mb-5">
         <canvas id="myChart" width="800" height="600"></canvas>
       </div>
       <div class="boxed mb-5">
       <h1><i class="far fa-user"></i> 79</h1>
       <h4>Some Text There</h4>
       <table>
        <thead>
            <tr>
                <td>Some Text There</td>
                <td>&emsp;</td>
                <td class="pull-right">100 Personer</td>
            </tr>
              <tr>
                <td>Some Text There</td>
                <td>&emsp;</td>
                <td class="pull-right">100 Personer</td>
            </tr>
              <tr>
                <td>Some Text There</td>
                <td>&emsp;</td>
                <td class="pull-right">100 Personer</td>
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
    labels: ["1,Jan", "2,Jan", "3,Jan", "4,Feb", "5,March", "6,April", "7,July", "8,Agust", "9,Sep", "10,Sep", "11,Oct", "12,Oct"],
    datasets: [{
      label: '# of Views',
      data: [12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1],
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
</script>
@endsection
