@extends('app')

@section('content')

<h1> Vragen </h1>
<hr/>

<div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Vraag</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""></th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""></th></tr>
                </thead>
                <tbody>
             	<?php 
setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); ?>
             @foreach ($questions as $question)
                <tr role="row" class="odd">
                  <td class="sorting_1"><a href="{{ action('QuestionController@edit' , [$question->id]) }}">{{ $question->name }}</a></td>
                </tr>
             @endforeach
            	</tbody>
              
              </table>
              <ul class="pagination pagination-sm no-margin pull-right">
                      @if($questions->links())
                      {{ $questions->links() }}
                      @endif
                     </ul>
          	</div>
            <!-- /.box-body -->
          </div>




@endsection