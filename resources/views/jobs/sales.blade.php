@extends('app')

@section('pageheader')
		<section class="content-header">
            <h1>
                Werkdag invoeren
                <small>Geef aan hoeveel sales er zijn gemaakt</small>
            </h1>
           
        </section>

@endsection

@section('content')

             <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Aantal Sales</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">

                   <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-12"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-6"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>

                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Naam </th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Aantal Sales</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Bonus</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Uitgevallen sales</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Opmerking</th></tr>
                </thead>
                <tbody>
       
          
                 
               
          
           

               
                    {!! Form::open( ['route' => ['jobs.sales.update', $job->id] , 'method' => 'POST'] )  !!}


               @foreach ($job->users as $user)
               		<!-- {!! Form::label('name', '$user->name') !!}
               		{!!  Form::text('name', null, ['class' => 'form-control']) !!}

               		{!! Form::label('sales', 'Aantal sales:') !!} -->
           <!--     		<div class="form-group">

               			 <label class="col-sm-3 control-label"> -->
                          <tr role="row" class="odd">
                     <td>{{ $user->name }}</td>

                     <td>
               				{!!  Form::input('number' , 'sales[]', $user->pivot->sales , null, ['class' => 'form-inline']) !!}
               			</td>
                 
                        <td>
                      
                            {!! Form::select('bonus_id_list[]', $bonusses , $user->pivot->bonus_id , [ 'class' => 'form-control' ]) !!}

                         


                       </td>
                    <td>    
                      {!!  Form::input('number' , 'nonesales[]', $user->pivot->nonesales , null, ['class' => 'form-inline']) !!}
                    </td>
                       <td>
                       {{ $salecomment = $user->pivot->comment  }}
                         {!! Form::input('textarea' , 'comments[]', $salecomment , ['class' => 'form-control' ,'size' => '60x2']) !!}
                       
                       
                       </td>
               			{!! Form::hidden('users[]' , $user->id) !!}
               		</div>
               		

                   </tr>

               @endforeach

			            </tbody>
              
              </table>
            </div>

           </div>

				<div class="box-footer"> 

				 	{!! Form::submit('Sales aantallen toevoegen', ['class' => 'btn btn-info pull-right']) !!}
				</div>
				 {!! Form::close() !!}

				@include('errors.list')
      </div>

 

           

@endsection

<!-- @section('footer')

  <script>


  			$('#user_list').select2({
  				placeholder: 'Wie gaan er werken?'
  			});

  </script>

@endsection -->