@extends('app')

@section('pageheader')
		<section class="content-header">
            <h1>
                Account
                <small>Wijzig je gegevens</small>
            </h1>
          
        </section>

@endsection

@section('content')

<div class="row">
<div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Instellingen</h3>
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
      {!! Form::model($user, ['method' => 'PATCH', 'action' => ['HomeController@update' , $user->id] , 'class' => 'form-horizontal'])  !!}

			 <div class="form-group"> 
		 			{!! Form::label('name', 'Naam:' , ['class' => 'col-sm-2 control-label']) !!}
		 	 	<div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control' , 'disabled']) !!}
              	</div>
		
			</div>


		 <?php $genderMen = ($user->gender == 'M') ? true : false; ?>
		 <?php $genderVrouw = ($user->gender == 'V') ? true : false; ?>

		<div class="form-group"> 
		 	{!! Form::label('gender', 'Geslacht:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
			Man {!! Form::radio('gender', $genderMen, 'Man') !!}  Vrouw {!! Form::radio('gender', $genderVrouw,  'Vrouw') !!}
			</div>
		</div>

             <div class="form-group"> 
		 	{!! Form::label('email', 'E-mail:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('email', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>


		<div class="form-group"> 
		 	{!! Form::label('street', 'Straat:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('street', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>

		<div class="form-group"> 
		 	{!! Form::label('housenumber', 'Huisnummer:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('housenumber', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>

		<div class="form-group"> 
		 	{!! Form::label('postcode', 'Postcode:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('postcode', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>

		<div class="form-group"> 
		 	{!! Form::label('city', 'Woonplaats:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('city', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>




		<div class="form-group"> 
		 	{!! Form::label('phone', 'Telefoonnummer:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('phone', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>

		<div class="form-group"> 
 	{!! Form::label('birthdate', 'Geboortedatum:' , ['class' => 'col-sm-2 control-label']) !!}
 	<div class="col-sm-10">
 	{!! Form::input('date', 'birthdate', date('Y-m-d'), ['class' => 'form-control']) !!}
 </div>
</div>

	<div class="form-group"> 
		 	{!! Form::label('birthplace', 'Geboorteplaats:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('birthplace', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>

		<div class="form-group"> 
		 	{!! Form::label('birthcountry', 'Geboorteland:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('birthcountry', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>


		 <?php $licenseYes = ($user->license == 'Yes') ? true : false; ?>
		 <?php $licenseNo = ($user->license == 'No') ? true : false; ?>
		<div class="form-group"> 
		 		{!! Form::label('license', 'Rijbewijs:' , ['class' => 'col-sm-2 control-label']) !!} 
		 	<div class="col-sm-10">
		 		 Nee {!! Form::radio('license', $licenseNo, 'Nee') !!} Ja {!! Form::radio('license', $licenseYes, 'Ja') !!} 
			</div>
		</div>  

		<div class="form-group"> 
 			{!! Form::label('licensevalid', 'Geldtig tot:' , ['class' => 'col-sm-2 control-label']) !!}
 			<div class="col-sm-10">
 				{!! Form::input('date', 'licensevalid', date('YY-mm'), ['class' => 'form-control']) !!}
 			</div>
		</div>

		<div class="form-group"> 
		 	{!! Form::label('bankaccount', 'Rekening / IBAN' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('bankaccount', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>

<h4> In geval van nood </h4>
		<div class="form-group"> 
		 	{!! Form::label('helpname', 'Naam:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('helpname', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>

		<div class="form-group"> 
		 	{!! Form::label('helpnumber', 'Tel. Nr:' , ['class' => 'col-sm-2 control-label']) !!}
		 	<div class="col-sm-10">
		 	{!! Form::text('helpnumber', null, ['class' => 'form-control']) !!}
		 	</div>
		</div>

              </div>


              <!-- /.box-body -->
              <div class="box-footer">
                
                {!! Form::submit('Wijzig Account', ['class' => 'btn btn-info pull-right']) !!}
              </div>
              <!-- /.box-footer -->


		 {!! Form::close() !!}


</div>
@endsection





