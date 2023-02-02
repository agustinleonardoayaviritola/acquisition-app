<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\User\UserCreate;
use App\Http\Livewire\User\UserUpdate;
use App\Http\Livewire\User\UserDashboard;

use App\Http\Livewire\Unit\UnitCreate;
use App\Http\Livewire\Unit\UnitUpdate;
use App\Http\Livewire\Unit\UnitDashboard;

use App\Http\Livewire\SupplierCategory\SupplierCategoryCreate;
use App\Http\Livewire\SupplierCategory\SupplierCategoryUpdate;
use App\Http\Livewire\SupplierCategory\SupplierCategoryDashboard;

use App\Http\Livewire\Supplier\SupplierCreate;
use App\Http\Livewire\Supplier\SupplierUpdate;
use App\Http\Livewire\Supplier\SupplierDashboard;

use App\Http\Livewire\RequestingUnit\RequestingUnitCreate;
use App\Http\Livewire\RequestingUnit\RequestingUnitUpdate;
use App\Http\Livewire\RequestingUnit\RequestingUnitDashboard;

use App\Http\Livewire\OrderType\OrderTypeCreate;
use App\Http\Livewire\OrderType\OrderTypeUpdate;
use App\Http\Livewire\OrderType\OrderTypeDashboard;

use App\Http\Livewire\Order\OrderCreate;
use App\Http\Livewire\Order\OrderUpdate;
use App\Http\Livewire\Order\OrderDashboard;
use App\Http\Livewire\Order\OrderPrint;

use App\Http\Livewire\OrderDetail\OrderDetailCreate;
use App\Http\Livewire\OrderDetail\OrderDetailUpdate;
use App\Http\Livewire\OrderDetail\OrderDetailDashboard;

use App\Http\Livewire\OrderCode\OrderCodeCreate;
use App\Http\Livewire\OrderCode\OrderCodeUpdate;
use App\Http\Livewire\OrderCode\OrderCodeDashboard;


use App\Http\Livewire\Dashboard\Dashboard;
//////
use App\Http\Livewire\Setting\UpdateSetting;
use App\Models\SupplierCategory;

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

    ///superrole:admin
    Route::get('setting-update/{slug}', UpdateSetting::class)->name('setting.update')->middleware('auth', 'role:superadmin');
    //Admin User
    Route::get('user', UserDashboard::class)->name('user.dashboard')->middleware('auth', 'role:superadmin');
    Route::get('user-create', UserCreate::class)->name('user.create')->middleware('auth', 'role:superadmin');
    Route::get('user-update/{slug}', UserUpdate::class)->name('user.update')->middleware('auth', 'role:superadmin');

    Route::get('unit', UnitDashboard::class)->name('unit.dashboard')->middleware('auth', 'role:admin|superadmin');
    Route::get('unit-create', UnitCreate::class)->name('unit.create')->middleware('auth', 'role:admin|superadmin');
    Route::get('unit-update/{slug}', UnitUpdate::class)->name('unit.update')->middleware('auth', 'role:admin|superadmin');

    Route::get('supplier-category', SupplierCategoryDashboard::class)->name('supplier-category.dashboard')->middleware('auth', 'role:admin|superadmin');
    Route::get('supplier-category-create', SupplierCategoryCreate::class)->name('supplier-category.create')->middleware('auth', 'role:admin|superadmin');
    Route::get('supplier-category-update/{slug}', SupplierCategoryUpdate::class)->name('supplier-category.update')->middleware('auth', 'role:admin|superadmin');

    Route::get('supplier', SupplierDashboard::class)->name('supplier.dashboard')->middleware('auth', 'role:admin|superadmin');
    Route::get('supplier-create', SupplierCreate::class)->name('supplier.create')->middleware('auth', 'role:admin|superadmin');
    Route::get('supplier-update/{slug}', SupplierUpdate::class)->name('supplier.update')->middleware('auth', 'role:admin|superadmin');

    Route::get('requesting-unit', RequestingUnitDashboard::class)->name('requesting-unit.dashboard')->middleware('auth', 'role:admin|superadmin');
    Route::get('requesting-unit-create', RequestingUnitCreate::class)->name('requesting-unit.create')->middleware('auth', 'role:admin|superadmin');
    Route::get('requesting-unit-update/{slug}', RequestingUnitUpdate::class)->name('requesting-unit.update')->middleware('auth', 'role:admin|superadmin');

    Route::get('order-type', OrderTypeDashboard::class)->name('order-type.dashboard')->middleware('auth', 'role:admin|superadmin');
    Route::get('ordert-ype-create', OrderTypeCreate::class)->name('order-type.create')->middleware('auth', 'role:admin|superadmin');
    Route::get('order-type-update/{slug}', OrderTypeUpdate::class)->name('order-type.update')->middleware('auth', 'role:admin|superadmin');

    Route::get('order', OrderDashboard::class)->name('order.dashboard')->middleware('auth', 'role:admin|superadmin|lector');
    Route::get('order-create', OrderCreate::class)->name('order.create')->middleware('auth', 'role:admin|superadmin');
    Route::get('order-update/{slug}', OrderUpdate::class)->name('order.update')->middleware('auth', 'role:admin|superadmin');
    Route::get('order-detail-print/{slug}', OrderPrint::class)->name('order-detail.print')->middleware('auth', 'role:admin|superadmin|lector');


    Route::get('order-detail/{slug}', OrderDetailDashboard::class)->name('order-detail.dashboard')->middleware('auth', 'role:admin|superadmin');
    Route::get('order-detail-create/{slug}', OrderDetailCreate::class)->name('order-detail.create')->middleware('auth', 'role:admin|superadmin');
    Route::get('order-detail-update/{slug}', OrderDetailUpdate::class)->name('order-detail.update')->middleware('auth', 'role:admin|superadmin');
    Route::get('order-detail-update/{slug}', OrderDetailUpdate::class)->name('order-detail.update')->middleware('auth', 'role:admin|superadmin');


    Route::get('order-code', OrderCodeDashboard::class)->name('order-code.dashboard')->middleware('auth', 'role:superadmin|superadmin');
    Route::get('order-code-create', OrderCodeCreate::class)->name('order-code.create')->middleware('auth', 'role:superadmin|superadmin');
    Route::get('order-code-update/{slug}', OrderCodeUpdate::class)->name('order-code.update')->middleware('auth', 'role:superadmin|superadmin');

});
