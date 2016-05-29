@extends('app')

@section('pageheader')
		<section class="content-header">
            <h1>
                Trainingsmodule toevoegen
                <small>Maak een module aan</small>
            </h1>
          
        </section>

@endsection

@section('content')

           <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Een Module toevoegen</h3>
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

                    {!! Form::open(['url' => 'tests' , 'class' => 'form-horizontal' , 'files' => true] )  !!}

				 <div class="form-group"> 
				 	{!! Form::label('name', 'Trainingsmodule:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('name', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

					 <div class="form-group"> 
				 	{!! Form::label('modulelink', 'File:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::input('file', 'modulelink', null, ['class' => 'form-control' , 'enctype' => 'multipart/form-data']) !!}
				 </div>
			
			

				</div>

					 <div class="form-group"> 
				 	{!! Form::label('comment', 'Opmerkingen:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::textarea( 'comment' , null, ['class' => 'form-control']) !!}
				 </div>
				</div>

			

			

				<div class="box-footer"> 

				 	{!! Form::submit('Trainingsmodule toevoegen', ['class' => 'btn btn-info pull-right'] , ['class' => 'btn btn-info pull-right']) !!}
				</div>
				 {!! Form::close() !!}

				
            </div>

           

@endsection

@section('footer')

  <script>


  		


  </script>

@endsection


