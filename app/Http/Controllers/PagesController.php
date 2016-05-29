<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use MaddHatter\LaravelFullcalendar\Event;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Test;
use App\Answer;
use App\Bonus;
use App\Question;
use URL;
use DB;
use Session;

class PagesController extends Controller
{
    
  public function __construct()
  {
    $this->middleware('auth');
  }

    public function loonpagina(){

    	$user = Auth::user();

    	$futureJobs = $user->jobs()->FutureJobs()->paginate('15');

    	$pastJobs = $user->jobs()->pastJobs()->paginate('15');


  		
    	return view('pages.loon' , compact('futureJobs' ,'user' ,'pastJobs'));
    }

    public function monthdetail($month, $year)
    {

      $user = Auth::user();

      $jobs = $user->jobs()->whereYear('startDate' , '=' , $year)->whereMonth('startDate' , '=' , $month)->orderBy('startDate','asc')->paginate('15');

      return view('pages.maanddetail', compact('user' ,'jobs'));

    }

    public function planningpagina(){

    	$user = Auth::user();

    	$futureJobs = $user->jobs()->thisMonth()->paginate('10');

    	$pastJobs = $user->jobs()->pastJobs()->paginate('10');

  	$events = [];

    $jobs = $user->jobs()->paginate('10');



    foreach($jobs as $job) {


$string = URL::to('jobs/'.$job->id);

    $events[] = \Calendar::event(
        $job->startTime . '  -  ' . $job->name, //event title
        true, //full day event?
        $job->startDate, //start time (you can also use Carbon instead of DateTime)
        $job->startDate, //end time (you can also use Carbon instead of DateTime)
        $job->id, //optionally, you can specify an event ID
         [
              'url' => $string
        //any other full-calendar supported parameters
         ]
    );

}

//$eloquentEvent = EventModel::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

$calendar = \Calendar::addEvents($events) //add an array with addEvents
    ->setOptions([ //set fullcalendar options

        'lang' => 'nl',
        'firstDay' => 1,
        'header' => [
        'left' => '',
        'center' => 'title',
       
        ]
    
    ]); 
    	return view('pages.planning' , compact('futureJobs' ,'user' ,'pastJobs','calendar'));

    }

     public function loondetail($id){

     	  $user = Auth::user();

     	  $job = $user->jobs()->where('id' , $id)->first();


        $bonusId = $job->pivot->bonus_id;
        
             $bonus = Bonus::find($bonusId);
        

    	//$job = Job::findOrFail($id);
    	// $futureJobs = $user->jobs()->FutureJobs()->get();

    	// $pastJobs = $user->jobs()->pastJobs()->get();

  		
    	return view('pages.loondetail' , compact('job' , 'bonus' ,'user'));

    }

    public function werknemerspagina() {



      //$users = User::orderBy('name' , 'asc')->get();
      $users = DB::table('users')->paginate(20);
      return view('admin.werknemers' , compact('users'));
    }

    public function werknemersdetail($id) {

      $user = User::findOrFail($id);


      return view('admin.werknemersdetail' , compact('user'));
    }

    public function search(Request $request)
    {
    // Gets the query string from our form submission 
       $query = $request->input('searchfield');

       $search = true;
    // Returns an array of articles that have the query string located somewhere within 
    // our articles titles. Paginates them so we can break up lots of search results.
       $users = User::where('name', 'LIKE', '%' . $query . '%')->paginate(20);
        
      
  // returns a view and passes the view the list of articles and the original query.
    return view('admin.werknemers' , compact('users' ,'query' , 'search'));
  }

  public function trainingsmodules(){

    $tests = Test::paginate(20);



    return view('pages.trainingsmodule' , compact('tests'));

  }

  public function startTest($id){

      $test = Test::findOrFail($id);


      $questions = $test->questions()->where('test_id' , '=' , $id)->get();
      $question = $questions[0];
     Session::set('index', '0');
      // $user = Auth::user();
      // foreach($questions as $question){
      //       $user->questions()->attach($question->id,  array( 'questionmade' => 0 ,'test_id' => $test->id));
            
      // }

      return view('pages.starttest' , compact('question' ,'test'));
  }

public function nextQuestion($id, $question_id){

      $test = Test::findOrFail($id);

      $question = Question::findOrFail($question_id);

      return view('pages.starttest' , compact('question' ,'test'));
  }

  public function processTest($id) 
  {
    $user = Auth::user();
    $test = Test::findOrFail($id);



    $questions = $test->questions()->get();
    $noq = count($questions);

    $i = 0;
    foreach ($questions as $question) {
        $userquestions = $user->questions()->where('question_id' , '=' , $question->id)->where('user_id' , '=' , $user->id)->where('test_id' , '=' , $test->id)->get();
        foreach ($userquestions as $userquestion) {
        
            if($userquestion->pivot->correct == 1){
               $i++;
            }
        }   
    }

    $user->tests()->attach($test->id,  array('testscore' => $i , 'user_id' => $user->id ));

  
    //  $questions = DB::table('question_user')->where('correct' , '=', 1)->count();
    //$questionsusers = $questions->users()->where('user_id' , '=' , Auth::user()->id)->where('correct' , '=', '1')->get();

    //$nocq = count($questionsusers);
    // dd($questions);

    // $user->questions()->attach($question_id,  array('testscore' => 1 , 'questionmade' => 1 , 'answer' => $theanswer) );


    return redirect('trainingsmodules');
  }

  public function processQuestion($test_id, $question_id, Request $request) {
    
      $user = Auth::user();
      $test = Test::findOrFail($test_id);
      $question = Question::findOrFail($question_id);

  
      $theanswer = $request->input('userAnswer');
 
      if ($theanswer == $question->answer) {
           // $answer->questions()->attach($question_id,  array('correct' => 1 , 'questionmade' => 1));
          $user->questions()->attach($question_id,  array('correct' => 1 , 'questionmade' => 1 , 'answer' => $theanswer ,'test_id' => $test->id));
     }
    else {
           // $answer->questions()->attach($question_id,  array('correct' => 0 , 'questionmade' => 1));
           $user->questions()->attach($question_id,  array('correct' => 0 , 'questionmade' => 1 , 'answer' => $theanswer ,'test_id' => $test->id));
     }
    
      $index = Session::get('index');
      
       //dd($index+1);
        $questions = $test->questions()->where('test_id' , '=' , $test_id)->get();
        $questioncount = count($questions);
       
      
        //dd($questioncount);
      

        
        if($index == ($questioncount- 1)){
            $this->processTest($test_id);
            flash('Test is gemaakt!' , 'Zie gelijk je score bij trainingsmodules');
             return redirect('trainingsmodules');
             Session::forget('index');
        }
        else{
           $question = $questions[$index+1];
             $id = $question->id;
            Session::set('index', $index+1);
        return redirect()->action('PagesController@nextQuestion', ['test_id' => $test->id , 'question_id' => $id ]);

        }

            
                
               

         
  
      
  }
}
