@extends('app')

@section('content')



<h1> Werknemers </h1>

<hr/>

<div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Naam </th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""></th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""></th></tr>
                </thead>
                <tbody>
             	<?php 
setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); ?>
             @foreach ($users as $user)
                <tr role="row" class="odd">
                  <td class="sorting_1"><a href="{{ action('PagesController@werknemersdetail' , [$user->id]) }}">{{ $user->name }}</a></td>
            
                </tr>
             @endforeach
            	</tbody>
       
              
               <div class="pagination"> </div>
              </table>
                     <ul class="pagination pagination-sm no-margin pull-right">
                      @if($users->links())
                      {{ $users->links() }}
                      @endif
                     </ul>
          	</div>

            <!-- /.box-body -->
          </div>


            


@endsection