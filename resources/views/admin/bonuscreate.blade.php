@extends('app')

@section('pageheader')
		<section class="content-header">
            <h1>
                Bonus toevoegen
                <small>Maak een bonus aan</small>
            </h1>
           
        </section>

@endsection

@section('content')

<div class="row">
           <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Bonus toevoegen</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">

                    {!! Form::open(['url' => 'bonus' , 'class' => 'form-horizontal'] )  !!}

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

				 	{!! Form::submit('Bonus toevoegen', ['class' => 'btn btn-info pull-right'] , ['class' => 'btn btn-info pull-right']) !!}
				</div>
				 {!! Form::close() !!}

				@include('errors.list')
            </div>

           
</div>
@endsection

@section('footer')

  <script>


  		


  </script>

@endsection


