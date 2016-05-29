@extends('app')

@section('pageheader')
		<section class="content-header">
            <h1>
                Werkdag toevoegen
                <small>Selecteer de personen die deze dag moeten werken</small>
            </h1>
          
        </section>

@endsection

@section('content')

<div class="row">
           <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Werkdag toevoegen</h3>
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

                    {!! Form::open(['url' => 'jobs' , 'class' => 'form-horizontal'] )  !!}

				 <div class="form-group"> 
				 	{!! Form::label('name', 'Naam' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('name', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

				<div class="form-group"> 
				 	{!! Form::label('location', 'Locatie' , ['class' => 'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('location', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

				<div class="form-group"> 

					
				 	{!! Form::label('startDate', 'Datum' , ['class' => 'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 	{!! Form::input('date', 'startDate', date('Y-m-d') , ['class' => 'form-control' ]) !!}
					</div>
				</div>

				<div class="form-group"> 
				 	{!! Form::label('startTime', 'Starttijd' , ['class' => 'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 	{!! Form::input('text', 'startTime', null , ['class' => 'timepicker form-control', 'name' => 'startTime' ]) !!}
				 	
					</div>
				</div>

				<div class="form-group"> 

					
				 	{!! Form::label('salesWaarde', 'Sales waarde' , ['class' => 'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 	{!! Form::input('number', 'saleswaarde', 0, ['class' => 'form-control' ]) !!}
					</div>
				</div>

				<div class="form-group"> 
				 	{!! Form::label('users', 'Werknemers' , ['class' => 'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 	{!! Form::select('users[]', $users, null, ['id' => 'user_list' , 'class' => 'form-control' , 'multiple']) !!}
					</div>
				</div>

				<div class="form-group"> 

					
				 	{!! Form::label('comment', 'Opmerkingen' , ['class' => 'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 	{!! Form::textarea('comment', null, ['class' => 'form-control' ]) !!}
					</div>
				</div>



				<div class="box-footer"> 

				 	{!! Form::submit('Werkdag toevoegen', ['class' => 'btn btn-info pull-right'] , ['class' => 'btn btn-info pull-right']) !!}
				</div>
				 {!! Form::close() !!}

				
            </div>
</div>
           

@endsection

@section('footer')
<script>
  	
  	$('.timepicker').wickedpicker(
  		{
  			twentyFour: true
  		});
  	
  			$('#user_list').select2({
  				placeholder: 'Wie gaan er werken?'
  			});

  			

  </script>



@endsection


