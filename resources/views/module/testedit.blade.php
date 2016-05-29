

@extends('app')

@section('pageheader')
		<section class="content-header">
            <h1>
                Trainingsmodule wijzigen
                <small>Maak een module aan</small>
            </h1>
     
        </section>

@endsection

@section('content')

           <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Een Module wijzigen</h3>
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

                      {!! Form::model($test, ['method' => 'PATCH', 'action' => ['TestController@update' , $test->id] , 'class' => 'form-horizontal'])  !!}

				 <div class="form-group"> 
				 	{!! Form::label('name', 'Trainingsmodule:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('name', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

					 <div class="form-group"> 
				 	{!! Form::label('modulelink', 'File:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::input('file', 'modulelink', null, ['class' => 'form-control']) !!}
				 </div>
		

				</div>

					 <div class="form-group"> 
				 	{!! Form::label('comment', 'Opmerkingen:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::textarea( 'comment' , null, ['class' => 'form-control']) !!}
				 </div>
				</div>

			

			

				<div class="box-footer"> 
				<a href="" class="btn btn-danger pull-left deleteBtn"> Module verwijderen</a>
				 	{!! Form::submit('Trainingsmodule wijzigen', ['class' => 'btn btn-info pull-right'] , ['class' => 'btn btn-info pull-right']) !!}
				</div>
				 {!! Form::close() !!}

		
            </div>

           

@endsection

@section('footer')

<script type="text/javascript">

$(".deleteBtn" ).click(function() { 
 	swal({   
 		title: "Weet je het zeker?",   
 		text: "De module gaat verloren!",   
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
 			 		location.href = "{{ action('TestController@deleteTest' , [$test->id])}}";
 			 		
 			 		
 			 }else{  
 			    swal("Gestopt", "","error");   
 			   
 			}
 			
 		});
 		return false;
 });
 
 </script>

@endsection


