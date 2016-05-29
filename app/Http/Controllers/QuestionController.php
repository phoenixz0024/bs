<?php

namespace App\Http\Controllers;

//use Request;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bonus;
use App\Job;
use App\User;
use App\Question;
use App\Test;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use Validator;

class QuestionController extends Controller
{
    
	// get auth for all controller only voor create // except
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(){



   
    	 $questions = Question::paginate('20');

    	return view('module.questionindex', compact('questions'));
    }



    public function create() {

        $tests = Test::lists('name' , 'id');

    	return view('module.questioncreate' , compact('tests'));
    }

    public function store(Request $request) {



        if($_POST) {
            $rules = array(
               'name' => 'required',
               'a' => 'required' ,  
               'b' => 'required' , 
               'c' => 'required' , 
               'd' => 'required' ,
            );

               $messages = [
                'name.required' => 'Je bent vergeten een Vraag in te vullen',
                'a.required' => 'Je bent vergeten een vraag A toe te voegen',
                'b.required' => 'Je bent vergeten een vraag B toe te voegen',
                'c.required' => 'Je bent vergeten een vraag C toe te voegen',
                'd.required' => 'Je bent vergeten een vraag D toe te voegen',

                

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('QuestionController@create' )->withInput($request->all())->withErrors($validator);
            }
            else {
                $question = Question::create($request->all());


                $testIds = $request->input('test_list');

                $question->save();
                $question->tests()->attach($testIds);
        		//$question->save();
                flash('Gelukt' , 'Vraag aangemaakt');
            	return redirect('questions/create');

            }
        }


    }


    public function edit($id)
    {

    	$question = Question::findOrFail($id);
        $tests = Test::lists('name' , 'id');
    	return view('module.questionedit', compact('question' ,'tests'));
    }

    public function update($id, Request $request){

    	$question = Question::findOrFail($id);

        if($_POST) {
            $rules = array(
               'name' => 'required',
               'a' => 'required' ,  
               'b' => 'required' , 
               'c' => 'required' , 
               'd' => 'required' ,
            );

               $messages = [
                'name.required' => 'Je bent vergeten een Vraag in te vullen',
                'a.required' => 'Je bent vergeten een vraag A toe te voegen',
                'b.required' => 'Je bent vergeten een vraag B toe te voegen',
                'c.required' => 'Je bent vergeten een vraag C toe te voegen',
                'd.required' => 'Je bent vergeten een vraag D toe te voegen',

                

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('QuestionController@edit' , [$question->id] )->withInput($request->all())->withErrors($validator);
            }
            else {
                $question->update($request->all());

                $test_list = $request->input('test_list');

                if($test_list) {
                    $question->tests()->sync($test_list);
                }
                else{
                    $question->tests()->detach($question->tests->lists('id')->all());
                }
                flash('Gelukt', 'Vraag aangepast');
        		return redirect('questions');
            }
        }
    }

    public function deleteQuestion($id) 
    {

        $question = Question::findOrFail($id);
        $question->delete();
        flash('Gelukt' , 'Vraag verwijderd');
        return redirect('questions');
    }

    
}	
