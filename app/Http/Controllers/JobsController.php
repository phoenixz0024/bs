<?php

namespace App\Http\Controllers;

//use Request;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Job;
use App\User;
use App\Bonus;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use Input, Validator, Redirect, Hash, Session;

class JobsController extends Controller
{
    
	// get auth for all controller only voor create // except
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(){

    	//$jobs = Job::->get();

    	// laatste toegevoegd
    	// scopes
    	// $
    	 $jobs = Job::latest('startDate')->paginate('20');

    	return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {

    	$job = Job::findOrFail($id);

    	return view('jobs.show', compact('job'));

    }

    public function create() {

        $users = User::lists('name' ,'id');


       
    	return view('jobs.create', compact('users'));
    }

    public function store(Request $request) {


         if($_POST) {
            $rules = array(
               'name' => 'required',
               'location' => 'required',
               'startDate' => 'required',
               'startTime' => 'required',
            );

               $messages = [
                'name.required' => 'Je bent vergeten een projectnaam in te vullen',
                'location.required' => 'Je bent vergeten een locatie in te vullen',
                'startDate.required' => 'Je bent vergeten een datum in te vullen',
                'startTime.required' => 'Je bent vergeten een starttijd in te vullen',

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('JobsController@create')->withInput($request->all())->withErrors($validator);
            }
            else {
    
                    $job = Job::create($request->all());
                	// // werkt nog niet
                	// $input['endDate'] = Carbon::now();
                	// save job

                     $userIds = $request->input('users');

                     $job->users()->attach($userIds);
                    flash('Gelukt' , 'Werkdag toegevoegd');
                	return redirect()->action('JobsController@create');
                }
            }
                	// $job = new Job;
                	// $job = $input['name'];
                	// $job = $input['location']

    }


    public function edit($id)
    {

    	$job = Job::findOrFail($id);
        $users = User::lists('name' ,'id');

    	return view('jobs.edit', compact('job' , 'users'));
    }

    public function update($id, Requests\CreateJobRequest $request){


    	$job = Job::findOrFail($id);

        if($_POST) {
            $rules = array(
               'name' => 'required',
               'location' => 'required',
               'startDate' => 'required',
               'startTime' => 'required',
            );

               $messages = [
                'name.required' => 'Je bent vergeten een projectnaam in te vullen',
                'location.required' => 'Je bent vergeten een locatie in te vullen',
                'startDate.required' => 'Je bent vergeten een datum in te vullen',
                'startTime.required' => 'Je bent vergeten een starttijd in te vullen',

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('JobsController@edit', [$job->id])->withInput($request->all())->withErrors($validator);
            }
            else {

                $job->update($request->all());

                $userIds = $request->input('user_list');

                if($userIds) {
                    $job->users()->sync($userIds);
                }
                else{
                    $job->users()->detach($job->users->lists('id')->all());
                }

                flash('Gelukt' , 'Werkdag gewijzigd');
            	return redirect()->action('JobsController@show', [$job->id]);
            }
        }
    }

    public function deleteJob($id) 
    {

        $job = Job::findOrFail($id);
        $job->delete();
        flash('Gelukt' , 'Werkdag verwijderd');
        return redirect('jobs');
    }

    public function sales($id)
    {

        

        $job = Job::findOrFail($id);
        $users = User::lists('name' , 'id');
        $bonusses = Bonus::lists('name' ,'id');
;       
        //$sales = $job->pivot->price;


        return view('jobs.sales', compact('job' , 'users' ,'bonusses')); 
    }

    public function updateSales($id, Request $request)
    {
        $job = Job::findOrFail($id);

        // returt array met users
        $userIds = $request->input('users');
        $sales = $request->input('sales');
        $bonusses = $request->input('bonus_id_list');
        $comments = $request->input('comments');
        $nonesales = $request->input('nonesales');
        $saleEarnings;
        foreach ($comments as $key => $value){
            $commentsArray[$key] = ['comment' => $value];
        }

        foreach ($nonesales as $key => $value){
            $nonesalesArray[$key] = ['nonesales' => $value];
            if($value > 0) {
               
                Session::put('flash_message' , 'no sales');
            }
        }

        foreach ($sales as $key => $value) { 
            $salesArray[$key] = ['sales' => $value];
            // $salesEarnings[$key] = ['earnings' => ($value * $job->saleswaarde)];
        }   
        foreach ($bonusses as $key => $value) { 
            $bonusArray[$key] = ['bonus_id' => $value];
        }   
        foreach ($bonusses as $key => $value) {

            $baseWage = 30;
            $bonus = Bonus::findOrFail($value);
            $bonusAmount = $bonus->value;
            $salesAmount = $sales[$key] * $job->saleswaarde;

            $earningsArray[$key] = ['earnings' => ($bonusAmount + $baseWage + $salesAmount)];
        }

        // $earningsArrayValues = array_values($earningsArray);
        

       
        

        //     $sums = array();
        // foreach (array_keys($earningsArray + $salesEarnings) as $key) {
        //     $sums[$key] = (isset($earningsArray[$key]) ? $earningsArray[$key] : 0) + (isset($salesEarnings[$key]) ? $salesEarnings[$key] : 0);
        // }
    

     

        $syncData = array_combine($userIds, $nonesalesArray);
        $job->users()->sync($syncData);
        $syncData  = array_combine($userIds, $commentsArray);
       
        $job->users()->sync($syncData);
         
        $syncData  = array_combine($userIds, $salesArray);
       
        $job->users()->sync($syncData);

        $syncData  = array_combine($userIds, $bonusArray);
       
        $job->users()->sync($syncData);

        $syncData  = array_combine($userIds, $earningsArray);
       
        $job->users()->sync($syncData);
        
        flash('Gelukt' , 'Sales zijn ingevoerd');

        


       
        
        return redirect()->action('JobsController@show', [$job->id]);
    }
}	
