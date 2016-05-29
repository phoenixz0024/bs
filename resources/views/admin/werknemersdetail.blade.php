@extends('app')

@section('content')

    <h2>Werknemeroverzicht</h2>

<div class="row">
    <div class="col-md-6">
        <div class="box">
                <div class="box-header">
                  <h2 class="box-title">{{ $user->name }}</h2>
                </div>
        <?php 
    setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); ?>
               
                    
                <div class="box-body">
                   <h5>Email: {{ $user->email }}</h5>
                    <h4>Geslacht: {{ $user->gender }}</h4>
                   <h4>Straat: {{ $user->street }}{{ $user->housenumber}} </h4>
                   <h4>Postcode: {{ $user->postcode }}</h4>
                   <h4>Woonplaats: {{ $user->city }}</h4>
                    
                      <h4>Telefoonnummer: {{ $user->phone }}</h4>
                   <h4>Geboortedatum: {{ $user->birthdate}} </h4>
                     <h4>Geboorteplaats: {{ $user->birthplace }}</h4>
                       <h4>Geboorteland: {{ $user->birthcountry }}</h4>
                   <h4>Rijbewijs: {{ $user->license}}</h4>
                    <h4>Rijbewijs geldig tot: {{ $user->licensevalid }}</h4>
                   <h4>Rekeningnummer: {{ $user->bankaccount }}</h4>
                   <br/>
                   
                   <h3>In geval van nood</h3>

                  
                    <h4>Naam: {{ $user->helpname }}</h4>
                      <h4>Noodnummer: {{ $user->helpnumber }}</h4>
              
               <hr/>
                <a href="" class="btn btn-danger pull-left deleteBtn"> Account verwijderen</a>
                  </div>
                  
        </div>


    </div>

    <div class="col-md-6">
        <div class="box">
                <div class="box-header">
                  <h2 class="box-title">Testscores:</h2>
                </div>
        <?php 
    setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); ?>
               
                    
                <div class="box-body">

                @foreach ($user->tests()->get() as $test)
                  <?php  $noq = $test->questions()->get();?> 
                  <h4> Test: {{ $test->name }} </h4>
                  <h4> Score: {{ $test->pivot->testscore }} / <?php echo count($noq); ?></h4>
                  <h4> Percentage: <?php echo $test->pivot->testscore / count($noq) * 100 ?>%</h4>
                  <hr/>
                @endforeach
               </div>
               
                  
                  
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
        <div class="box">
                <div class="box-header">
                  <h2 class="box-title">Overzicht</h2>
                </div>
<div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Naam werkdag</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Locatie</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Datum</th><th>Gemaakte Sales</th><th>Uitgevallen sales</th><th>Bruto verdiensten</th></tr>
                </thead>
                <tbody>
              <?php 
setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); 
$jobs = $user->jobs()->orderBy('startDate', 'asc')->paginate('10');
$totalsales = 0;
$totalearnings = 0;
$totalnonesales = 0;
foreach($jobs as $job){

$totalearnings += $job->pivot->earnings;
$totalsales += $job->pivot->sales;
$totalnonesales += $job->pivot->nonesales;
}
?>

             @foreach ($jobs as $job)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{ $job->name }}</a></td>
                  <td>{{ $job->location }}</td>
                  <td> {{ $job->startDate->formatLocalized('%A %d %B %Y') }}</td>
                  <td> {{ $job->pivot->sales }} </td>
                  <td> {{ $job->pivot->nonesales }} </td>
                  <td> € {{ $job->pivot->earnings }}  </td>
                </tr>
             @endforeach

              </tbody>
                 
              </table>
              <ul class="pagination pagination-sm no-margin pull-right">
                      @if($jobs->links())
                      {{ $jobs->links() }}
                      @endif
                     </ul>
            </div>
        </div>
        </div>
</div>
            <!-- /.box-body -->



@endsection

@section('footer')

  <script type="text/javascript">

$(".deleteBtn" ).click(function() { 
  swal({   
    title: "Weet je het zeker?",   
    text: "De gebruiker gaat verloren!",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Ja, verwijder",   
    cancelButtonText: "Nee, liever niet",   
    closeOnConfirm: false,   
    closeOnCancel: true 
  },
    function(isConfirm){  
       if (isConfirm) {     
          location.href = "{{ action('HomeController@deleteUser' , [$user->id])}}";
          
          
       }else{  
          swal("Gestopt", "","error");   
         
      }
      
    });
    return false;
 });
 
 </script>

@endsection