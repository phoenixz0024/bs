<?php

namespace App\Http\Controllers;

//use Request;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bonus;
use App\Job;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use Validator;

class BonusController extends Controller
{
    
	// get auth for all controller only voor create // except
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(){

   
    	 $bonusses = Bonus::paginate('20');

    	return view('admin.bonusindex', compact('bonusses'));
    }



    public function create() {

      
    	return view('admin.bonuscreate');
    }

    public function store(Request $request) {

         if($_POST) {
            $rules = array(
               'name' => 'required',
               'value' => 'required'   
               
               
            );

               $messages = [
                'name.required' => 'Je bent vergeten een projectnaam vergeten in te vullen',
                'value.required' => 'Je bent de waarde van de bonus vergeten'
                

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('BonusController@create')->withInput($request->all())->withErrors($validator);
            }
            else {
                $bonus = Bonus::create($request->all());

        		$bonus->save();
                flash('Gelukt' , 'Bonus toegevoegd');
            	return redirect('bonus/create');
         }   
        }

    }


    public function edit($id)
    {

    	$bonus = Bonus::findOrFail($id);
      
    	return view('admin.bonusedit', compact('bonus'));
    }

    public function update($id, Request $request){

    	$bonus = Bonus::findOrFail($id);

         if($_POST) {
            $rules = array(
               'name' => 'required',
               'value' => 'required'   
               
               
            );

               $messages = [
                'name.required' => 'Je bent vergeten een projectnaam vergeten in te vullen',
                'value.required' => 'Je bent de waarde van de bonus vergeten'
                

            ];
             $validator = Validator::make($request->all(), $rules, $messages);
              if($validator->fails()) {
                   // $messages = $validator->errors();
             

                return redirect()->action('BonusController@edit' , [$bonus->id])->withInput($request->all())->withErrors($validator);
            }
            else {

                $bonus->update($request->all());
                flash('Gelukt' , 'Bonus aangepast');
        		return redirect('bonus');
            }
        }
    }

    public function deleteBonus($id) 
    {

        $bonus = Bonus::findOrFail($id);
        $bonus->delete();
        flash('Gelukt' , 'Bonus verwijderd');
        return redirect('bonus');
    }

    
}	
