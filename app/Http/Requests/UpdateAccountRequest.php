<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UpdateAccountRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //$userId = \Route::input('id');

        return Auth::user()->exists();
        //return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            // 'location' => 'required',
            // 'startDate' => 'required|date'
            // laravel.com/docs/validation
        ];
    }
}
