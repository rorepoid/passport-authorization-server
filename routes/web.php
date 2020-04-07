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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('api/uploadPhoto', 'PhotoUploadController@store')->name('home');
Route::redirect('settings', 'profile');

Route::livewire('users', 'user.users');
Route::livewire('profile', 'profile.profile')->name('profile');

Route::livewire('settings/profile', 'settings.profile')
    ->layout('layouts.settings')
    ->section('setting')
    ->name('settings.profile');
Route::livewire('settings/account', 'settings.account')->name('settings.account');
