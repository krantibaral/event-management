<?php


use App\Http\Controllers\Admin\AttendeeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('events', EventController::class);
    Route::resource('attendees', AttendeeController::class);

});