<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use App\Question;

use Carbon\Carbon;
use Auth;
use Validator;
use Storage;
use Input;
use \File;

class TestController extends Controller
{
    //
    	// get auth for all controller only voor create // except
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(){



   
    	 $tests = Test::paginate(20);
    	
    	

    	return view('module.testindex', compact('tests'));
    }



    public function create() {

      
    	return view('module.testcreate');
    }

    public function store(Request $request) {
    	

        if($_POST) {
            $rules = array(
               'name' => 'required',
               'modulelink' => 'required'  
            );

               $messages = [
                'name.required' => 'Je bent vergeten een projectnaam in te vullen',
                'modulelink.required' => 'Je bent vergeten een module toe te voegen'
                

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('TestController@create')->withInput($request->all())->withErrors($validator);
            }
            else {

             //    $destinationPath = "../storage/trainingsmodules";
            	// $file = ;
            	// $file->move($destinationPath, $file);
                $test = Test::create($request->all());


                if(Input::has('modulelink')) {
                    $file = File::make(Input::file('modulelink'));  
                    $name_file = Input::file('modulelink')->getClientOriginalName();                      
                    $file_name = preg_replace('/[^A-Za-z0-9_.-]/','', $name_file);
                       
                    $path = storage_path().'/app/tests/'.$test->id;
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }               
                    $file->save($path.$file_name);

                    // $file->resize(null, 180, function ($constraint) {
                    //     $constraint->aspectRatio();
                    //     $constraint->upsize();
                    // });                         
                    $file->save($path.'test-'.$file_name);
                }

                 // Storage::put(
                 //     'tests/'.$test->id,
                 //    file_get_contents($request->file('modulelink'))
                 // );

             
        		$test->save();
                flash('Gelukt' , 'Test aangemaakt');
            	return redirect('tests/create');

                }
            }


    }


    public function edit($id)
    {

    	$test = Test::findOrFail($id);

    	return view('module.testedit', compact('test' ,'questions'));
    }

    public function update($id, Request $request){
    $test = Test::findOrFail($id);

        if($_POST) {
            $rules = array(
               'name' => 'required',
               'modulelink' => 'required'   
               
               
            );

               $messages = [
                'name.required' => 'Je bent vergeten een projectnaam in te vullen',
                'modulelink.required' => 'Je bent vergeten een module toe te voegen'
                

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('TestController@edit' ,[$test->id])->withInput($request->all())->withErrors($validator);
            }
            else {
            	

                $test->update($request->all());
                flash('Gelukt' , 'Test gewijzigd');
        		return redirect('tests');
            }
        }
    }

    public function deleteTest($id) 
    {

        $test = Test::findOrFail($id);
        $test->delete();
        flash('Gelukt' , 'Test verwijderd');
        return redirect('tests');
    }
}
