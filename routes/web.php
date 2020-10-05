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
Auth::routes(['register' => false, 'reset' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Livewire
    Route::livewire('users', 'user.users')->name('users');
    Route::livewire('users/{id}', 'profile.profile')->name('users.show');
    Route::livewire('profile', 'profile.profile')->name('profile');

    // Sites
    Route::livewire('sites', 'sites.list-sites')
        ->name('sites.index');

    Route::livewire('sites/create', 'sites-create')
        ->middleware('can:site.create')
        ->name('sites.create');

    Route::livewire('sites/{site}', 'sites.show-site')
        ->name('sites.show');

    // Settings
    Route::group(['layout' => 'layouts.settings', 'section' => 'setting'], function () {
        Route::livewire('settings/profile', 'settings.profile')->name('settings.profile');
        Route::livewire('settings/account', 'settings.account')->name('settings.account');
    });

    // API
    Route::post('api/avatar', 'AvatarController@store')->name('avatar.store');
});

// Redirects
Route::redirect('settings', url('settings/profile'));
