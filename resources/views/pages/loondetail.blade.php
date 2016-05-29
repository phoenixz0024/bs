@extends('app')

@section('content')

    <h2>Werkoverzicht</h2>
<div class="col-md-2">
<?php 
    setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl');


          
$counter = 0;   
$year = 2016;
$currentY = Carbon::now()->year;
$currentM = Carbon::now()->month;

echo "<ul class='listyears'>"; 
  
    for($y = $year ;$y <= $currentY; $y++) {

          echo "<li class='year'><h4>". $year . "</h4></li>";

          echo "<ul class='listmonths'>";
          for($m = 1;$m <= 12; $m++){ 
              $currentMonth = Carbon::createFromDate($year, $m);

              $readable = $currentMonth->formatLocalized('%B');

               
                    echo "<li class='month'>";
                    echo "<a href='" .action('PagesController@monthdetail' , [$m, $year]) . "'>". $readable."</a>";

                   // echo "$readable";
                      echo "<ul class='listdays'>";
               
                      foreach($user->jobs()->orderBy('startDate', 'asc')->get() as $jobuser) {

                          $jobyear = $jobuser->startDate->year;
                          $jobmonth = $jobuser->startDate->month;

                          
                          if ($jobmonth == $m && $jobyear == $year) {
                              echo "<li class='days'>";
                               $dag =  $jobuser->startDate->formatLocalized('%d %B');
                              // echo "<a href='action('PagesController@loondetail' , [$job->id])'>"
                              echo "<a href='" .action('PagesController@loondetail' , [$jobuser->id]) . "'>". $dag."</a>";
                               echo "</li>";
                          }
                      
                      
                      }
                      // endmonthlist
                      echo "</ul>";
                    echo "</li>";

                    if($m == 12){
                      $year++;
                    }
          } 
          echo "</ul>";
     }

echo "</ul>";

?>
</div>




<div class="col-md-10">
<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $job->name }}</h3>
            </div>
    <?php 

setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl');


 ?>
           
                
            <div class="box-body">
               <h4>Locatie: {{ $job->location }}</h4>
               <h4>Datum: {{ $job->startDate->formatLocalized('%A %d %B %Y') }} </h4>
               <h4>Tijdstip: {{ $job->startTime}}</h4>
               <h4>Opmerkingen: {{ $job->comments }}</h4>
               <br/>
               
               <h3>Sales overzicht</h3>

               <h5>Sales: {{ $job->pivot->sales }}</h5>

               @if($bonus)
               <h5>Behaalde bonus: {{ $bonus->name }} </h5>
               @endif
               <h5>Bruto Verdiensten: € {{ $job->pivot->earnings }} </h5>
              
              @if($bonus)
              <hr/>

                <h5 style="color: red;"> Uitgevallen sales: {{ $job->pivot->nonesales}}</h5>
               <h5>Reden van uitval: {{ $job->pivot->comment }}</h5>
               @endif
            </div>
           
              
              
</div>
</div>
            <!-- /.box-body -->




@stop