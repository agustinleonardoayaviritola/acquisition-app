<?php

use Illuminate\Support\Facades\Route;





use App\Http\Livewire\User\UserCreate;
use App\Http\Livewire\User\UserUpdate;
use App\Http\Livewire\User\UserDashboard;

use App\Http\Livewire\Dashboard\Dashboard;
//////
use App\Http\Livewire\Setting\UpdateSetting;



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
    return redirect()->route('login');
});
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    /*     Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); */

    Route::get('/dashboard', Dashboard::class, function () {
        return view('livewire.dashboard.dashboard');
    })->name('dashboard');

    ///superadmin
    Route::get('setting-update/{slug}', UpdateSetting::class)->name('setting.update')->middleware('auth', 'role:superadmin|admin');
    //Admin User
    Route::get('user', UserDashboard::class)->name('user.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('user-create', UserCreate::class)->name('user.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('user-update/{slug}', UserUpdate::class)->name('user.update')->middleware('auth', 'role:superadmin|admin');
});
