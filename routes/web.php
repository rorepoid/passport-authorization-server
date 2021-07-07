<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\Profile\Profile;
use App\Http\Livewire\Settings\Account;
use App\Http\Livewire\Settings\Profile as SettingsProfile;
use App\Http\Livewire\Sites\ListSites;
use App\Http\Livewire\Sites\ShowSite;
use App\Http\Livewire\SitesCreate;
use App\Http\Livewire\User\Users;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Livewire
    Route::get('users', Users::class)->name('users');
    Route::get('users/{id}', Profile::class)->name('users.show');
    Route::get('profile', Profile::class)->name('profile');

    // Sites
    Route::get('sites', ListSites::class)
        ->name('sites.index');

    Route::get('sites/create', SitesCreate::class)
        ->middleware('can:site.create')
        ->name('sites.create');

    Route::get('sites/{site}', ShowSite::class)
        ->name('sites.show');

    // Settings
    Route::group(['section' => 'setting'], function () {
        Route::get('settings/profile', SettingsProfile::class)->name('settings.profile');
        Route::get('settings/account', Account::class)->name('settings.account');
    });

    // API
    Route::post('api/avatar', 'AvatarController@store')->name('avatar.store');
});

// Redirects
Route::redirect('settings', url('settings/profile'));
