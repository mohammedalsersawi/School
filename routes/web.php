<?php

use App\Http\Controllers\Classrooms\ClassroomController as ClassroomsClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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
Auth::routes();
Route::group(['middleware'=>['guest']] , function(){
    Route::get('/', function ()
    {
        return view('auth.login');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
    ],
    function () {

        // Route::get('/', function ()
        // {
        //     return view('dashboard');
        // });

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


        Route::resource('Grades', GradeController::class);
        Route::resource('Classrooms', ClassroomsClassroomController::class);
        Route::post('delete_all', [ClassroomsClassroomController::class , 'delete_all'])->name('delete_all');
        Route::post('Filter_Classes', [ClassroomsClassroomController::class , 'Filter_Classes'])->name('Filter_Classes');


        Route::resource('Sections', SectionController::class);
        Route::get('/classes/{id}', [SectionController::class , 'getclasses'])->name('getclasses');


        Route::view('add_parent' , 'livewire.show_Form')->name('add_parent');

        Route::resource('Teachers', TeacherController::class);

    });











// Route::get('/', function () {
//     return view('dashboard');
// });


