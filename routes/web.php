<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\ClientController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::post('api/uploadPhoto', 'PhotoUploadController@store')->name('home');

    Route::livewire('users', 'user.users');
    Route::livewire('profile', 'profile.profile')->name('profile');


    Route::group(['layout' => 'layouts.settings', 'section' => 'setting'], function () {
        Route::livewire('settings/profile', 'settings.profile')->name('settings.profile');
        Route::livewire('settings/account', 'settings.account')->name('settings.account');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::redirect('settings', url('settings/profile'));
