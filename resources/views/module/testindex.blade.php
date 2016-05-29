@extends('app')

@section('content')

<h1> Trainingsmodules </h1>
<hr/>

<div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Module</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Aantal vragen</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Download Link</th></tr>
                </thead>
                <tbody>
             	<?php 
setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); ?>
             @foreach ($tests as $test)
                <tr role="row" class="odd">
                  <td class="sorting_1"><a href="{{ action('TestController@edit' , [$test->id]) }}">{{ $test->name }}</a></td>
                  
                  <td>
                <?php $questionArray = $test->questions()->get() ?> 
                <?php echo count($questionArray); ?>
                 </td>
                <td><a href="{{ asset('../storage/trainingsmodules/') }}. {{ $test->modudelink }}  ">Download</a></td>
            
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




@endsection