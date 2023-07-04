<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'App\Http\Controllers\HomeController@home')->name('/');
Route::get('login', 'App\Http\Controllers\AuthController@showFormLogin')->name('login');
Route::get('signin', 'App\Http\Controllers\AuthController@showFormLogin')->name('signin');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::get('register', 'App\Http\Controllers\AuthController@showFormRegister')->name('register');
Route::post('register', 'App\Http\Controllers\AuthController@register');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'checkRole:1'], function () {
        // Route Khusus untuk role admin
        $admin = "administrator";
        Route::get($admin, 'App\Http\Controllers\HomeController@index')->name($admin);

        Route::get($admin . '/student', 'App\Http\Controllers\admin\master\StudentController@show')->name($admin . '/student');
        Route::get($admin . '/student/get_list_student', 'App\Http\Controllers\admin\master\StudentController@getlistStudent');

        Route::get($admin . '/student/add', 'App\Http\Controllers\admin\master\StudentController@add')->name($admin . '/student/add');
        Route::get($admin . '/student/add/get_list_gender', 'App\Http\Controllers\general\GeneralController@getlistGender');
        Route::get($admin . '/student/add/get_list_religion', 'App\Http\Controllers\general\GeneralController@getlistReligion');

        Route::get($admin . '/student/addStudent', 'App\Http\Controllers\admin\master\StudentController@addStudent');
        Route::get($admin . '/student/updateStudent', 'App\Http\Controllers\admin\master\StudentController@updateStudent');

        Route::get($admin . '/criteria', 'App\Http\Controllers\admin\CriteriaController@show')->name($admin . '/criteria');
        Route::get($admin . '/criteria/get_list_criteria', 'App\Http\Controllers\admin\CriteriaController@getlist');
        Route::post($admin . '/criteria/addCriteria', 'App\Http\Controllers\admin\CriteriaController@add');
        Route::post($admin . '/criteria/updCriteria', 'App\Http\Controllers\admin\CriteriaController@update');
        Route::post($admin . '/criteria/delCriteria', 'App\Http\Controllers\admin\CriteriaController@delete');

        Route::get($admin . '/alternative', 'App\Http\Controllers\admin\AlternativeController@show')->name($admin . '/alternative');
        Route::get($admin . '/alternative/get_list_alternative', 'App\Http\Controllers\admin\AlternativeController@getlist');
        Route::post($admin . '/alternative/addAlternative', 'App\Http\Controllers\admin\AlternativeController@add');
        Route::post($admin . '/alternative/updAlternative', 'App\Http\Controllers\admin\AlternativeController@update');
        Route::post($admin . '/alternative/delAlternative', 'App\Http\Controllers\admin\AlternativeController@delete');

        Route::get($admin . '/criteria_analyst', 'App\Http\Controllers\analisa\CriteriaAnalystController@show')->name($admin . '/criteria_analyst');
        Route::get($admin . '/criteria_analyst/get_list_criteria', 'App\Http\Controllers\analisa\CriteriaAnalystController@getlist');
        Route::post($admin . '/criteria_analyst/addCriteriaAnalyst', 'App\Http\Controllers\analisa\CriteriaAnalystController@add');
        Route::get($admin . '/criteria_analyst/normalize', 'App\Http\Controllers\analisa\CriteriaAnalystController@doNormalize');
        Route::get($admin . '/criteria_analyst_result', 'App\Http\Controllers\laporan\CriteriaAnalystResultController@show')->name($admin . '/criteria_analyst_result');

        Route::get($admin . '/alternative_analyst', 'App\Http\Controllers\analisa\AlternativeAnalystController@show')->name($admin . '/alternative_analyst');
        Route::get($admin . '/alternative_analyst/get_list_alternative', 'App\Http\Controllers\analisa\AlternativeAnalystController@getlist');
        Route::post($admin . '/alternative_analyst/addAlternativeAnalyst', 'App\Http\Controllers\analisa\AlternativeAnalystController@add');
        Route::get($admin . '/alternative_analyst/normalize', 'App\Http\Controllers\analisa\AlternativeAnalystController@doNormalize');
        Route::get($admin . '/alternative_analyst_result', 'App\Http\Controllers\laporan\AlternativeAnalystResultController@show')->name($admin . '/alternative_analyst_result');
        Route::get($admin . '/alternative_analyst_result/get_list', 'App\Http\Controllers\laporan\AlternativeAnalystResultController@getlist');

        Route::get($admin . '/ranking', 'App\Http\Controllers\laporan\RankingController@show')->name($admin . '/ranking');
    });
    Route::group(['middleware' => 'checkRole:2'], function () {
        // Route Khusus untuk role teacher
        $teacher = "teacher";
        Route::get($teacher, 'App\Http\Controllers\HomeController@index')->name($teacher);
    });
    Route::group(['middleware' => 'checkRole:3'], function () {
        // Route Khusus untuk role student
        $student = "student";
        Route::get($student, 'App\Http\Controllers\HomeController@index')->name($student);
        Route::get($student . '/soal', 'App\Http\Controllers\siswa\SoalController@show')->name($student . '/soal');
        Route::get($student . '/hasil', 'App\Http\Controllers\siswa\HasilController@show')->name($student . '/hasil');
    });

    // Logout
    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
});

/* Clear Cache */
Route::get('clear-all-cache', function () {
    Artisan::call('cache:clear');
    dd("Successfully, you have cleared all cache of application.");
});
