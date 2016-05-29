var elixir = require('laravel-elixir');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
    .scripts([
        'libs/wickedpicker.js',
    		'libs/fullcalendar.js',
    		'libs/sweetalert-dev.js'
    		
    	], './public/js/libs.js')
    
    .styles([
            'libs/customcss.css',
    		'libs/fullcalendar.css',
    		'libs/sweetalert.css',
    		'libs/wickedpicker.css'
    	], './public/css/libs.css');
});
