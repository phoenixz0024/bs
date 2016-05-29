@extends('app')

@section('pageheader')
		<section class="content-header">
            <h1>
                Vraag wijzigen
                <small>Wijzig een vraag</small>
            </h1>
            
        </section>

@endsection

@section('content')

           <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Vraag wijzigen</h3>
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

                    {!! Form::model($question, ['method' => 'PATCH', 'action' => ['QuestionController@update' , $question->id] , 'class' => 'form-horizontal'])  !!}

					 <div class="form-group"> 
				 	{!! Form::label('name', 'Vraag' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('name', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

					 <div class="form-group"> 
				 	{!! Form::radio('answer', 1, true) !!} {!! Form::label('a', 'A:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('a', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

					 <div class="form-group"> 
				 	{!! Form::radio('answer', 2, false, ['class' => 'field']) !!}{!! Form::label('b', 'B:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('b', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

					 <div class="form-group"> 
				 	{!! Form::radio('answer', 3, false, ['class' => 'field']) !!}{!! Form::label('c', 'C:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('c', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

					 <div class="form-group"> 
				 	{!! Form::radio('answer', 4, false, ['class' => 'field']) !!}{!! Form::label('d', 'D:' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">

				 	{!! Form::text('d', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

				

				      <div class="form-group"> 
    {!! Form::label('test_list', 'Welke vragenlijsten?' , ['class' => 'col-sm-2 control-label']) !!}
<div class="col-sm-10">
    {!! Form::select('test_list[]', $tests, null, ['id' => 'test_list' , 'class' => 'form-control' , 'multiple']) !!}
  </div>
  </div>


			

				<div class="box-footer"> 
				<a href="" class="btn btn-danger pull-left deleteBtn"> Vraag verwijderen</a>
				 	{!! Form::submit('Vraag wijzigen', ['class' => 'btn btn-info pull-right'] , ['class' => 'btn btn-info pull-right']) !!}
				</div>
				 {!! Form::close() !!}

				@include('errors.list')
            </div>

           

@endsection

@section('footer')

  <script>  		
    $('#test_list').select2({});
  </script>

  <script type="text/javascript">

$(".deleteBtn" ).click(function() { 
 	swal({   
 		title: "Weet je het zeker?",   
 		text: "De vraag gaat verloren!",   
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
 			 		location.href = "{{ action('QuestionController@deleteQuestion' , [$question->id])}}";
 			 		
 			 		
 			 }else{  
 			    swal("Gestopt", "","error");   
 			   
 			}
 			
 		});
 		return false;
 });
 
 </script>

@endsection


