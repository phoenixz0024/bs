@extends('app')

@section('pageheader')
<section class="content-header">
            <h1>
                Werkdag wijzigen
                <small>Wijzig de gegevens van een werkdag</small>
            </h1>
          
        </section>
@endsection

@section('content')


<div class="row">
 <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{!! $job->name !!}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                 @if (count($errors) > 0)
                
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                </div>
              
        @endif

 {!! Form::model($job, ['method' => 'PATCH', 'action' => ['JobsController@update' , $job->id] , 'class' => 'form-horizontal'])  !!}

 <div class="form-group"> 
 	{!! Form::label('name', 'Name:' , ['class' => 'col-sm-2 control-label']) !!}
 	<div class="col-sm-10">
 	{!! Form::text('name', null, ['class' => 'form-control']) !!}
 </div>
</div>

<div class="form-group"> 
 	{!! Form::label('location', 'Locatie:' , ['class' => 'col-sm-2 control-label']) !!}
 	<div class="col-sm-10">
 	{!! Form::text('location', null, ['class' => 'form-control']) !!}
 </div>
</div>

<div class="form-group"> 
 	{!! Form::label('startDate', 'Datum:' , ['class' => 'col-sm-2 control-label']) !!}
 	<div class="col-sm-10">
 	{!! Form::input('date', 'startDate', date('Y-m-d'), ['class' => 'form-control']) !!}
 </div>
</div>

<div class="form-group"> 
          {!! Form::label('startTime', 'Starttijd' , ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
          {!! Form::input('text', 'startTime', null , ['class' => 'form-control timepicker', 'name' => 'startTime' ]) !!}
          
          </div>
        </div>

        <div class="form-group"> 

          
          {!! Form::label('saleswaarde', 'Sales waarde' , ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
          {!! Form::input('number', 'saleswaarde', null, ['class' => 'form-control' ]) !!}
          </div>
        </div>

      <div class="form-group"> 
    {!! Form::label('user_list', 'Werknemers:' , ['class' => 'col-sm-2 control-label']) !!}
<div class="col-sm-10">
    {!! Form::select('user_list[]', $users, null, ['id' => 'user_list' , 'class' => 'form-control' , 'multiple']) !!}
  </div>
    
  </div>

        <div class="form-group"> 

          
          {!! Form::label('comment', 'Opmerkingen' , ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
          {!! Form::textarea('comment', null, ['class' => 'form-control' ]) !!}
          </div>
        </div>


<div class="box-footer"> 

 	{!! Form::submit('Wijzig werkdag', ['class' => 'btn btn-info pull-right']) !!}
	</div>
</div>
</div>
</div>
 {!! Form::close() !!}

</div>


@endsection


@section('footer')

  <script>


  			$('#user_list').select2();

        $('.timepicker').wickedpicker({twentyFour: true});

  </script>

@endsection