@extends('app')

@section('content')
  <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <h2>Planning</h2>

    <div class="box">
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
    </div>
    <!-- <div id="calendar" class="fc fc-ltr fc-unthemed"></div> -->

    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Aankomende Werkdagen (2 weken)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Naam werkdag</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Locatie</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Datum</th><th>Hoelaat</th></tr>
                </thead>
                <tbody>
             	<?php 
setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); ?>
             @foreach ($futureJobs as $job)
                <tr role="row" class="odd">
                  <td class="sorting_1"><a href="{{ action('JobsController@show' , [$job->id]) }}">{{ $job->name }}</a></td>
                  <td>{{ $job->location }}</td>
                  <td> {{ $job->startDate->formatLocalized('%A %d %B %Y') }}</td>
                  <td> {{ $job->startTime }} </td>
                  
                </tr>
             @endforeach
            	</tbody>
              
              </table>
              <ul class="pagination pagination-sm no-margin pull-right">
                      @if($futureJobs->links())
                      {{ $futureJobs->links() }}
                      @endif
                     </ul>
          	</div>
            <!-- /.box-body -->
          </div>
</div>
</div></div>

   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Gewerkte Werkdagen</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Naam werkdag</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Locatie</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Datum</th><th>Hoelaat</th></tr>
                </thead>
                <tbody>
              <?php 
setlocale(LC_ALL, 'nl_NL'); Carbon::setLocale('nl'); ?>
             @foreach ($pastJobs as $job)
                <tr role="row" class="odd">
                  <td class="sorting_1"><a href="{{ action('JobsController@show' , [$job->id]) }}">{{ $job->name }}</a></td>
                  <td>{{ $job->location }}</td>
                  <td> {{ $job->startDate->formatLocalized('%A %d %B %Y') }}</td>
                  <td> {{ $job->startTime }} </td>
                  
                </tr>
             @endforeach
              </tbody>
              
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







@stop

@section('footer')
 
</script>
@stop