@extends('app')

@section('content')

<div class="box">
  <div class="box-header">
              <h2 class="box-title">Project: {{ $job->name }}</h2>
            </div>
    

           
             
            <div class="box-body">

		<h4> Waar:  {{ $job->location }} </h4>
	<?php 
setlocale(LC_ALL, 'nl_NL');
Carbon::setLocale('nl'); ?>
<h4>
 Wanneer: {{ $job->startDate->formatLocalized('%A %d %B %Y') }}</h4>

 <h4> Hoelaat: <u>{{ $job->startTime }}</u> </h4>



<br/>
 <h4> Wie werkt er op deze dag? </h4>


 @unless ($job->users->isEmpty())
	 <ul>
	 	@foreach ($job->users as $user) 

	 		<li> {{ $user->name }} </li>
	 	@endforeach
	 </ul>
 @endunless
<br/>	
<h5> Opmerkingen: {{ $job->comment }} </h5>
<br/>
<hr>
@if (Auth::user()->hasRole('admin'))
<a href="" class="btn btn-danger pull-right deleteBtn"> Verwijder Werkdag</a><a href="{{ url('jobs/sales' , [$job->id]) }}" class="btn btn-success pull-right"> Sales Invoeren</a><a href="{{ action('JobsController@edit' , [$job->id]) }}" class="btn btn-info pull-right"> Wijzig werkdag </a>
@endif
</div>
 </div>



 @endsection

 @section('footer')
 <script type="text/javascript">

$(".deleteBtn" ).click(function() { 
 	swal({   
 		title: "Weet je het zeker?",   
 		text: "De werkdag gaat verloren!",   
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
 			 		location.href = "{{ action('JobsController@deleteJob' , [$job->id])}}";
 			 		
 			 		
 			 }else{  
 			    swal("Gestopt", "","error");   
 			   
 			}
 			
 		});
 		return false;
 });
 </script>
 @endsection