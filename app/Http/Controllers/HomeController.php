<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input, Validator, Redirect, Hash, Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {


        $user = Auth::user();
        $name = $user['name'];

        $jobs = $user->jobs()->where('user_id' , '=' , $user->id)->get();
   
        $datasales = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $dataearnings = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $datanonesales = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $werkdagen = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $counter = 0;
        $totalsales = 0;
        $totalnonesales = 0;

        $tests = $user->tests()->where('user_id' , '=' , $user->id)->get();
        $year = Carbon::now()->year;
      

        foreach($jobs as $job){
            $totalsales += $job->pivot->sales;
            $totalnonesales += $job->pivot->nonesales;
            $jobmonth = $job->startDate->month;
            $jobyear = $job->startDate->year;
          
            for($m = 1; $m < 12; $m++){

                

                 if($jobmonth == $m && $year == $jobyear) {

                        if($job->startDate->day < Carbon::now()->day){
                        $werkdagen[$m-1] += 1;
                          $datasales[$m-1] += $job->pivot->sales;
                          $dataearnings[$m-1] += $job->pivot->earnings;
                        $datanonesales[$m-1] += $job->pivot->nonesales;
                    }
                           
                 }

            }   
               
                $counter++;
        }
      
        $datasales = array_values($datasales);
        $datanonesales = array_values($datanonesales);
        $dataearnings  = array_values($dataearnings);
        $werkdagen = array_values($werkdagen);
        $salenonesales = array($totalsales,$totalnonesales);
        


     
            return view('/home', compact('jobs','user' ,'name', 'datasales' ,'dataearnings' ,'datanonesales','salenonesales', 'werkdagen'));
                   //->with('testscore', $jobs->pivlists('startDate'))
                   // ->with('totals', $jobs->lists('sales'));


        //return view('/home', compact('user' ,'name'));
    }


    public function register(Request $request) {
        


        if($_POST) {
            $rules = array(
                'password' => 'required|confirmed',
                'email'     =>  'required|email|unique:users',
                'name'  =>  'required'
            );

            //dd($request->all());
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return Redirect::route('register_user')->withInput($request->except(['password']))->withErrors($validator);
            }
            else {
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
                $user->save();
                
                flash('Gelukt!', 'Werknemer toegevoegd');
                return redirect('register');
        
            }
          }
        if (Auth::user()->hasRole('admin')) {
            return view('admin.register');
        } 
        else {
            return;
        }

    }


    public function show()
    {

            $user = Auth::user();

            return view('person.account' , compact('user'));

    }


     public function update(Requests\UpdateAccountRequest $request){


        if($_POST) {
            $rules = array(
                
                
               
               'postcode' => 'required',
               'street' => 'required',
               'housenumber' => 'required',
               'city' => 'required',
               'phone' => 'required',
               'birthdate' => 'required',
               'birthplace' => 'required',
                'birthcountry' => 'required',
               'bankaccount' => 'required'
            );

               $messages = [
                'postcode.required' => 'Je bent vergeten je postcode in te vullen',
                'street.required' => 'Je bent vergeten je straatnaam in te vullen',
                'housenumber.required' => 'Je bent vergeten je huisnummer in te vullen',
                'city.required' => 'Je bent vergeten je woonplaats in te vullen',
                'phone.required' => 'Je bent vergeten je telefoonnummer in te vullen',
                'birthdate.required' => 'Je bent vergeten je geboortedatum in te vullen',
                'birthplace.required' => 'Je bent vergeten je geboorteplaats in te vullen',
                'birthcountry.required' => 'Je bent vergeten je geboorteland in te vullen',
                'bankaccount.required' => 'Je bent vergeten je rekeningnummer in te vullen',

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('HomeController@update')->withInput($request->all())->withErrors($validator);
            }
            else {
                $user = Auth::user();
                //dd($user);
                $user->update($request->all());
                $user->save();
                

                flash('Gelukt!', 'Gegevens aangepast');
                return redirect('/');
            }
        }
        
        
    }

     public function deleteUser($id) 
    {

        $user = User::findOrFail($id);
        $user->delete();
        flash('Gelukt' , 'Gebruiker verwijderd');
        return redirect('werknemers');
    }
}
