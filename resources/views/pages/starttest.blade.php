@extends('app')

@section('content')

    <h2>Test</h2>


<div class="box">
            <div class="box-header">
              <h2 class="box-title">{{ $test->name }}</h2>
       
        
            <h4> Opmerkingen bij de test: {{ $test->comment }} </h4>
                </div>
             
            <div class="box-body">

               {!! Form::open(['method' => 'POST', 'action' => ['PagesController@processQuestion' , $test->id , $question->id] , 'class' => 'form-horizontal'])  !!}
                


                <h3> Vraag: {{ $question->name }} </h3>
                <h5> A: {{ $question->a }} </h5>
                <h5> B: {{ $question->b }} </h5>
                <h5> C: {{ $question->c }} </h5>
                <h5> D: {{ $question->d }} </h5>

                <br/> 
                A: {!! Form::radio('userAnswer', 1, true ) !!}
                B: {!! Form::radio('userAnswer', 2, false) !!}
                C: {!! Form::radio('userAnswer', 3, false) !!}
                D: {!! Form::radio('userAnswer', 4, false ) !!}
                <hr>
              
          {!! Form::submit('Antwoorden', ['class' => 'btn btn-info pull-right'] , ['class' => 'btn btn-info pull-right']) !!}
        </div>
         {!! Form::close() !!}
            </div>
           
              
              
</div>
            <!-- /.box-body -->




@stop