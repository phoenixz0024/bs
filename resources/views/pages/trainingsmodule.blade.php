@extends('app')

@section('content')

    <h2>Traingingsmodules</h2>


<div class="box">
            <div class="box-header">
              <h3 class="box-title">Trainingsmodule</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Test</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Aantal Vragen</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Aantal goed</th><th>Score % </th><th>Download Materiaal</th></tr>
                </thead>
                <tbody>
              <?php 
setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); 

?>
             @foreach ($tests as $test)
              <?php 
                  $testuser = $test->users()->where('user_id' , '=', Auth::user()->id)->where('test_id', '=', $test->id)->first();
                  $testscore = 0;
                  ?>

                <tr role="row" class="odd">
                


                  <td class="sorting_1">
                 <?php  
                $noq = $test->questions()->get();
                 if($testuser ||  count($noq) == 0) {
                  echo $test->name;
                } else {

                 echo "<a  href=". action('PagesController@startTest' , [$test->id]) . ">" .$test->name . "</a>";

                  } ?>
                  </td>
                  <?php $questionArray = $test->questions()->get(); ?>
                  <td><?php echo count($questionArray); 
                  ?></td>
                  <td><?php


                  if($testuser) {
                  $testscore = $testuser->pivot->testscore;
                  echo $testscore . '/' . count($questionArray);
                } else {
                  echo '0';
                }
?>
                   </td>
                  <td><?php  
                  if($testuser) {
                    $pct = $testscore/count($questionArray)*100;
                    echo $pct .'%';
                 }else{
                   echo '0%';
                }
                  ?></td>
                  
                  <td>  </td>
                </tr>
             @endforeach
              </tbody>
                
              </table>
              <ul class="pagination pagination-sm no-margin pull-right">
                      @if($tests->links())
                      {{ $tests->links() }}
                      @endif
                     </ul>
            </div>
            <!-- /.box-body -->
          </div>
</div>
</div></div>
<br/>



@stop