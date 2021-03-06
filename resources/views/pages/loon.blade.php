@extends('app')

@section('content')

    <h2>Loon</h2>

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
               
                      foreach($user->jobs()->orderBy('startDate', 'asc')->get() as $job) {

                          $jobyear = $job->startDate->year;
                          $jobmonth = $job->startDate->month;

                          
                          if ($jobmonth == $m && $jobyear == $year) {
                              echo "<li class='days'>";
                               $dag =  $job->startDate->formatLocalized('%d %B');
                              // echo "<a href='action('PagesController@loondetail' , [$job->id])'>"
                              echo "<a href='" .action('PagesController@loondetail' , [$job->id]) . "'>". $dag."</a>";
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
              <h3 class="box-title">Gewerkte Werkdagen</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Naam werkdag</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Locatie</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Datum</th><th>Gemaakte Sales</th><th>Uitgevallen sales</th><th>Bruto verdiensten</th></tr>
                </thead>
                <tbody>
              <?php 
setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl');

$totalsales = 0;
$totalearnings = 0;
$totalnonesales = 0;
foreach($pastJobs as $job){

$totalearnings += $job->pivot->earnings;
$totalsales += $job->pivot->sales;
$totalnonesales += $job->pivot->nonesales;
}
 ?>
             @foreach ($pastJobs as $job)
                <tr role="row" class="odd">
                  <td class="sorting_1"><a href="{{ action('PagesController@loondetail' , [$job->id]) }}">{{ $job->name }}</a></td>
                  <td>{{ $job->location }}</td>
                  <td> {{ $job->startDate->formatLocalized('%A %d %B %Y') }}</td>
                  <td> {{ $job->pivot->sales }} </td>
                  <td> {{ $job->pivot->nonesales }} </td>
                  <td> € {{ $job->pivot->earnings }}  </td>
                </tr>
             @endforeach
              </tbody>
              <tfoot>
                <td> <b>Totaal</b> </td>
                <td> </td>
                <td></td>
                <td> <b>{{ $totalsales }}</b> </td>
                <td> <b>{{ $totalnonesales  }}</b> </td>
                <td> <b>€ {{ $totalearnings}}</b></td>
              </tfoot>
              </table>
              <ul class="pagination pagination-sm no-margin pull-right">
                      @if($pastJobs->links())
                      {{ $pastJobs->links() }}
                      @endif
                     </ul>
            </div>
          
            <!-- /.box-body -->
          </div>
</div>
</div></div>
<br/>
</div>



@stop