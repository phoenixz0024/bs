@extends('app')

@section('pageheader')
		<section class="content-header">
            <h1>
                Bonus wijzigen
                <small>Wijzig een bonus</small>
            </h1>
        
        </section>

@endsection

@section('content')
<div class="row">
           <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Bonus wijzigen</h3>
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

                    {!! Form::model($bonus, ['method' => 'PATCH', 'action' => ['BonusController@update' , $bonus->id] , 'class' => 'form-horizontal'])  !!}

				 <div class="form-group"> 
				 	{!! Form::label('name', 'Naam bonus' , ['class' => 'col-sm-2 control-label'])  !!}
				 	<div class="col-sm-10">
				 	{!! Form::text('name', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

				<div class="form-group"> 
				 	{!! Form::label('value', 'Waarde bonus' , ['class' => 'col-sm-2 control-label']) !!}
				 	<div class="col-sm-10">
				 	{!! Form::input('number', 'value', null, ['class' => 'form-control']) !!}
				 </div>
				</div>

				

			

				<div class="box-footer"> 
					<a href="" class="btn btn-danger pull-left deleteBtn"> Verwijder Bonus</a>
				 	{!! Form::submit('Bonus wijzigen', ['class' => 'btn btn-info pull-right'] , ['class' => 'btn btn-info pull-right']) !!}
				</div>
				 {!! Form::close() !!}

				@include('errors.list')
            </div>

          </div>

@endsection

 @section('footer')
 <script type="text/javascript">

$(".deleteBtn" ).click(function() { 
 	swal({   
 		title: "Weet je het zeker?",   
 		text: "De bonus gaat verloren!",   
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
 			 		location.href = "{{ action('BonusController@deleteBonus' , [$bonus->id])}}";
 			 		
 			 		
 			 }else{  
 			    swal("Gestopt", "","error");   
 			   return false;
 			}
 			
 		});
 		return false;
 });
 </script>
 @endsection
  		




