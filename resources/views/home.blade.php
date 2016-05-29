@extends('app')


@section('pageheader')
		<section class="content-header">
            <h1>
                Dashboard
                <small>Je persoonlijke statistieken</small>
            </h1>
           
        </section>

@endsection

@section('content')
                
                <?php $jobsArray = $user->jobs()->pastJobs()->get() ?>
              <?php $jobscoming = $user->jobs()->thisMonth()->get() ?>
              <?php $jobearnings = $user->jobs()->earningsthismonth()->sum('earnings');

              


              ?>

               @if ($user->hasRole('admin'))
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Bericht!</h4>
                U bent ingelogd als admin
              </div>
              @endif

    <?php 
$earnings = $user->jobs()->where('user_id' , '=' , $user->id)->sum('earnings');
$max = $user->jobs()->where('user_id' , '=' , $user->id)->max('earnings');
$sales = $user->jobs()->where('user_id' , '=' , $user->id)->max('sales');
$userjob = $user->jobs()->where('user_id' , '=' , $user->id)->where('nonesales' ,'>' , '0')->where('startDate', '<', Carbon::now()->weekOfYear)->first();



?>
@if($userjob)
 <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-exclamation"></i> Er zijn uitgevallen sales!</h4>
                {{ $userjob->pivot->nonesales }} sales zijn er uitgevallen <br/>
                Reden: {{ $userjob->pivot->comment}}
    </div>
@endif
<div class="row">

   <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it -->
            <span class="info-box-icon bg-green"><i class="fa fa-circle-o-notch"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Deze Maand verdient</span>
              <span class="info-box-number"><?php echo '€ '.$jobearnings; ?></span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">

          
         <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="fa fa-money"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">totaal Verdiend</span>
            <span class="info-box-number"><?php echo '€ '. $earnings   ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
    </div>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
                   <div class="info-box">
      <!-- Apply any bg-* class to to the icon to color it -->
          <span class="info-box-icon bg-yellow"><i class="fa fa-rocket"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Meeste sales op 1 dag</span>
            <span class="info-box-number"><?php echo  $sales . ' Sales' ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-purple"><i class="fa fa-line-chart"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Meest verdient op 1 dag</span>
                      <span class="info-box-number"><?php echo '€ '. $max ?></span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
    </div>

</div>

   
    

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it -->
            <span class="info-box-icon bg-red"><i class="fa fa-star-half-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Aankomende werkdagen (2 weken)</span>
              <span class="info-box-number"><?php echo count($jobscoming); ?></span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
    </div>
       <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it -->
            <span class="info-box-icon bg-orange"><i class="fa fa-star"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Gewerkte Werkdagen</span>
              <span class="info-box-number"><?php echo count($jobsArray); ?></span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
    </div>
</div>

<div class="row">
    <div class="col-md-6">
      <div class="box">
      <div class="box-header">
        {{ Carbon::now()->year }}
      </div>
       <canvas id="myChartEarnings" width="200" height="100"></canvas>
      </div>
    </div>

    <div class="col-md-6">
      <div class="box">
      <div class="box-header">
        {{ Carbon::now()->year }}
      </div>
       <canvas id="myChartWorkingDays" width="200" height="100"></canvas>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          {{ Carbon::now()->year }}
        </div>
       <canvas id="myChartSales" width="200" height="100"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box">
      <div class="box-header">
        {{ Carbon::now()->year }}
      </div>
       <canvas id="myChartSaleNoneSales" width="200" height="100"></canvas>
      </div>
    </div>

  
</div>

 @endsection



             
               
@section('footer')

<script src="dist/js/chart.js"></script>
<script>
var ctx = document.getElementById("myChartSales");
var myChartSales = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Januari", "Februari" ,"Maart" ,"April" ,"Mei","Juni","Juli","Augustus","September","Oktober","November","December"],
        datasets: [{
            label: '# Sales',
            data: {{ json_encode($datasales) }},
             backgroundColor : "#00a65a",
                strokeColor : "#A37079",
                pointColor : "#BC808B",
                showTooltips: true,
                responsive: false
        },{
           label: '# Uitgevallen sales',
            data: {{ json_encode($datanonesales) }},
             backgroundColor : "#dd4b39"
            
        }

        ]
      
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById("myChartEarnings");
var myChartEarnings = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Januari", "Februari" ,"Maart" ,"April" ,"Mei","Juni","Juli","Augustus","September","Oktober","November","December"],
        datasets: [{
            label: '€ verdient per maand',
            data: {{ json_encode($dataearnings) }},
             backgroundColor : "#00a65a",
                strokeColor : "#00a65a",
                pointColor : "#00a65a",
                showTooltips: true,
                responsive: false
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById("myChartSaleNoneSales");

var data = {
    labels: [
        "Sales",
        "Uitgevallen sales"
    ],
    datasets: [
        {
            data: {{ json_encode($salenonesales) }},
            backgroundColor: [
                "#00a65a",
                "#dd4b39"
            ],
            hoverBackgroundColor: [
                "#00c65a",
                "#dd5b39"
            ]
        }]
};

var myChartSaleNoneSales = new Chart(ctx, {
    type: 'doughnut',
    data: data,
      animation:{
        animateScale:true
    }
});
</script>
<script>
var ctx = document.getElementById("myChartWorkingDays");
var myChartSales = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Januari", "Februari" ,"Maart" ,"April" ,"Mei","Juni","Juli","Augustus","September","Oktober","November","December"],
        datasets: [{
            label: 'Dagen gewerkt',
            data: {{ json_encode($werkdagen) }},
             backgroundColor : "#00a65a",
                strokeColor : "#A37079",
                pointColor : "#BC808B",
                showTooltips: true,
                responsive: false
        }]
      
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>




@endsection
