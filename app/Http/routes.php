<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {

// });

Route::group(array('before' => 'auth'), function(){
        return view('auth.login');
});

Route::controllers([

   'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
// Route::get('jobs', 'JobsController@index');


// 	Route::get('jobs/create' , 'JobsController@create');
// 	Route::get('jobs/{id}' , 'JobsController@show');
// 	Route::get('jobs/{id}/edit', 'JobsController@edit');

// Route::post('jobs', 'JobsController@store');




Route::group(['middleware' => 'web' , 'before' => 'auth'], function () {



    	Route::resource('jobs', 'JobsController');
        Route::resource('bonus' , 'BonusController');
        Route::resource('questions' , 'QuestionController');
        Route::resource('tests' , 'TestController');

        Route::get('trainingsmodules' , 'PagesController@trainingsmodules');
        Route::get('starttest/{id}', 'PagesController@startTest');
        Route::get('starttest/{test_id}/{question_id}' , ['uses' => 'PagesController@nextQuestion']);
        Route::post('starttest/{test_id}/{question_id}', ['uses' => 'PagesController@processQuestion']);
        //Route::get('jobs/{$id}', [ 'uses' => 'JobsController@show']);
        Route::get('tests/delete/{id}', ['uses' => 'TestController@deleteTest']);
        Route::get('questions/delete/{id}', ['uses' => 'QuestionController@deleteQuestion']);
        Route::get('bonus/delete/{id}', ['uses' => 'BonusController@deleteBonus']);
        Route::get('jobs/delete/{id}', ['uses' => 'JobsController@deleteJob']);
        Route::get('jobs/sales/{id}', ['uses' => 'JobsController@sales']);
        Route::post('jobs/sales/{id}', ['as' => 'jobs.sales.update' , 'uses' => 'JobsController@updateSales']);

        Route::auth();

        Route::get('/', 'HomeController@index');

        Route::get('loon' , 'PagesController@loonpagina');
        Route::get('loondetail/{id}' , 'PagesController@loondetail');
        Route::get('loonmaanddetail/{month}/{year}' , 'PagesController@monthdetail');
        Route::get('planning' , 'PagesController@planningpagina');
        Route::get('werknemers' , 'PagesController@werknemerspagina');
        Route::get('werknemers/{id}' ,  'PagesController@werknemersdetail');
        Route::post('search' ,  'PagesController@search');
        Route::get('users/delete/{id}', ['uses' => 'HomeController@deleteUser']);
       

         Route::get('account', array('as' => 'update_user', 'uses' => 'HomeController@show'));
        Route::patch('account', array('as' => 'update_user', 'uses' => 'HomeController@update'));

    Route::group(['middleware' => 'manager'], function(){ 
             Route::get('register', array('as' => 'register_user', 'uses' => 'HomeController@register'));
            Route::post('register', array('as' => 'register_user', 'uses' => 'HomeController@register'));
    });
});


// Download Route
Route::get('download/{filename}', function($filename)
{
    // Check if file exists in app/storage/file folder
    $file_path = storage_path() .'../storage/trainingsmodules'. $filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
})
->where('filename', '[A-Za-z0-9\-\_\.]+');
