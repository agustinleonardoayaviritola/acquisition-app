<?php
use Illuminate\Support\Facades\Route;




use App\Http\Livewire\Country\CountryDashboard;
use App\Http\Livewire\Country\CountryUpdate;
use App\Http\Livewire\Country\CountryCreate;

use App\Http\Livewire\User\UserCreate;
use App\Http\Livewire\User\UserUpdate;
use App\Http\Livewire\User\UserDashboard;

use App\Http\Livewire\Gender\GenderCreate;
use App\Http\Livewire\Gender\GenderUpdate;
use App\Http\Livewire\Gender\GenderDashboard;

use App\Http\Livewire\Province\ProvinceCreate;
use App\Http\Livewire\Province\ProvinceUpdate;
use App\Http\Livewire\Province\ProvinceDashboard;


use App\Http\Livewire\Department\DepartmentCreate;
use App\Http\Livewire\Department\DepartmentUpdate;
use App\Http\Livewire\Department\DepartmentDashboard;

use App\Http\Livewire\Profession\ProfessionCreate;
use App\Http\Livewire\Profession\ProfessionUpdate;
use App\Http\Livewire\Profession\ProfessionDashboard;

use App\Http\Livewire\Beneficiary\BeneficiaryCreate;
use App\Http\Livewire\Beneficiary\BeneficiaryUpdate;
use App\Http\Livewire\Beneficiary\BeneficiaryDashboard;
use App\Http\Livewire\Beneficiary\BeneficiaryPrint;
use App\Http\Livewire\Beneficiary\BeneficiaryUpdateState;

use App\Http\Livewire\Municipality\MunicipalityCreate;
use App\Http\Livewire\Municipality\MunicipalityUpdate;
use App\Http\Livewire\Municipality\MunicipalityDashboard;



use App\Http\Livewire\DeliveryPoint\DeliveryPointCreate;
use App\Http\Livewire\DeliveryPoint\DeliveryPointUpdate;
use App\Http\Livewire\DeliveryPoint\DeliveryPointDashboard;

use App\Http\Livewire\DeliveryBasket\DeliveryBasketCreate;
use App\Http\Livewire\DeliveryBasket\DeliveryBasketUpdate;
use App\Http\Livewire\DeliveryBasket\DeliveryBasketDashboard;

use App\Http\Livewire\BeneficiaryState\BeneficiaryStateCreate;
use App\Http\Livewire\BeneficiaryState\BeneficiaryStateUpdate;
use App\Http\Livewire\BeneficiaryState\BeneficiaryStateDashboard;

use App\Http\Livewire\IdentityDocumentType\IdentityDocumentTypeCreate;
use App\Http\Livewire\IdentityDocumentType\IdentityDocumentTypeUpdate;
use App\Http\Livewire\IdentityDocumentType\IdentityDocumentTypeDashboard;

use App\Http\Livewire\BeneficiaryStateDetail\BeneficiaryStateDetailCreate;
use App\Http\Livewire\BeneficiaryStateDetail\BeneficiaryStateDetailUpdate;
use App\Http\Livewire\BeneficiaryStateDetail\BeneficiaryStateDetailDashboard;

use App\Http\Livewire\NeighborhoodCommunity\NeighborhoodCommunityDashboard;
use App\Http\Livewire\NeighborhoodCommunity\NeighborhoodCommunityCreate;
use App\Http\Livewire\NeighborhoodCommunity\NeighborhoodCommunityUpdate;

use App\Http\Livewire\CantonDistrict\CantonDistrictUpdate;
use App\Http\Livewire\CantonDistrict\CantonDistrictCreate;
use App\Http\Livewire\CantonDistrict\CantonDistrictDashboard;

use App\Http\Livewire\Product\ProductCreate;
use App\Http\Livewire\Product\ProductUpdate;
use App\Http\Livewire\Product\ProductDashboard;

use App\Http\Livewire\Basket\BasketCreate;
use App\Http\Livewire\Basket\BasketUpdate;
use App\Http\Livewire\Basket\BasketDashboard;
use App\Http\Livewire\Basket\BasketAddProduct;
use App\Http\Livewire\Basket\BasketAddProductUpdate;

use App\Http\Livewire\Subgovernment\SubgovernmentCreate;
use App\Http\Livewire\Subgovernment\SubgovernmentUpdate;
use App\Http\Livewire\Subgovernment\SubgovernmentDashboard;

use App\Http\Livewire\Delivery\DeliveryCreate;
use App\Http\Livewire\Delivery\DeliveryDashboard;
use App\Http\Livewire\Delivery\DeliveryUpdate;


use App\Http\Livewire\MunicipalityBasket\MunicipalityBasketCreate;
use App\Http\Livewire\MunicipalityBasket\MunicipalityBasketDashboard;
use App\Http\Livewire\MunicipalityBasket\MunicipalityBasketUpdate;

use App\Http\Livewire\DeliveryBasketDetail\DeliveryBasketDetailAdminDashboard;

///report
use App\Http\Livewire\Report\ReportByUser;
use App\Http\Livewire\Report\ReportSubgovernmentByUser;




///SUB GOBERNACIONES
use App\Http\Livewire\ProductSubgovernment\ProductSubgovernmentCreate;
use App\Http\Livewire\ProductSubgovernment\ProductSubgovernmentDashboard;
use App\Http\Livewire\ProductSubgovernment\ProductSubgovernmentUpdate;

use App\Http\Livewire\BasketSubgobernment\BasketSubgobernmentCreate;
use App\Http\Livewire\BasketSubgobernment\BasketSubgobernmentDashboard;
use App\Http\Livewire\BasketSubgobernment\BasketSubgobernmentUpdate;
use App\Http\Livewire\BasketSubgobernment\BasketSubgobernmentAddProduct;
use App\Http\Livewire\BasketSubgobernment\BasketSubgobernmentAddProductUpdate;

use App\Http\Livewire\DeliveryPointSubgobernment\DeliveryPointSubgobernmentCreate;
use App\Http\Livewire\DeliveryPointSubgobernment\DeliveryPointSubgobernmentDashboard;
use App\Http\Livewire\DeliveryPointSubgobernment\DeliveryPointSubgobernmentUpdate;


use App\Http\Livewire\BeneficiarySubgobernment\BeneficiarySubgobernmentCreate;
use App\Http\Livewire\BeneficiarySubgobernment\BeneficiarySubgobernmentDashboard;
use App\Http\Livewire\BeneficiarySubgobernment\BeneficiarySubgobernmentUpdate;
use App\Http\Livewire\BeneficiarySubgobernment\BeneficiarySubgobernmentUpdateState;
use App\Http\Livewire\BeneficiarySubgobernment\BeneficiarySubgobernmentPrint;
use App\Http\Livewire\BeneficiarySubgobernment\BeneficiarySubgobernmentHistory;

use App\Http\Livewire\DeliverySubgobernment\DeliverySubgobernmentCreate;
use App\Http\Livewire\DeliverySubgobernment\DeliverySubgobernmentDashboard;
use App\Http\Livewire\DeliverySubgobernment\DeliverySubgobernmentUpdate;

use App\Http\Livewire\DeliveryBasketSubgobernment\DeliveryBasketSubgobernmentCreate;
use App\Http\Livewire\DeliveryBasketSubgobernment\DeliveryBasketSubgobernmentDashboard;
use App\Http\Livewire\DeliveryBasketSubgobernment\DeliveryBasketSubgobernmentUpdate;
use App\Http\Livewire\DeliveryBasketSubgobernment\DeliveryBasketSubgobernmentPrintDetail;

use App\Http\Livewire\DeliveryBasketDetailSubgobernment\DeliveryBasketDetailDashboard;

use App\Http\Livewire\Dashboard\Dashboard;
//////
use App\Http\Livewire\Setting\UpdateSetting;

///report
use App\Http\Livewire\ReportSubgovernment\ReportByUserSubgovernment;


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

    Route::get('/dashboard', Dashboard::class, function(){
        return view('livewire.dashboard.dashboard');
    })->name('dashboard');

    ///superadmin
    Route::get('setting-update/{slug}', UpdateSetting::class)->name('setting.update')->middleware('auth', 'role:superadmin|admin');
    //Admin User
    Route::get('user', UserDashboard::class)->name('user.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('user-create', UserCreate::class)->name('user.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('user-update/{slug}', UserUpdate::class)->name('user.update')->middleware('auth', 'role:superadmin|admin');

    //Admin IdentityDocumentType
    Route::get('indentity-document-type', IdentityDocumentTypeDashboard::class)->name('identity-document-type.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('indentity-document-type-create', IdentityDocumentTypeCreate::class)->name('identity-document-type.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('indentity-document-type-update/{slug}', IdentityDocumentTypeUpdate::class)->name('identity-document-type.update')->middleware('auth', 'role:superadmin|admin');


    //Admin DeliveryPoint
    Route::get('delivery-point-dashboard', DeliveryPointDashboard::class)->name('delivery-point.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('delivery-point-create', DeliveryPointCreate::class)->name('delivery-point.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('delivery-point-update/{slug}', DeliveryPointUpdate::class)->name('delivery-point.update')->middleware('auth', 'role:superadmin|admin');
    
    //Admin Profession
    Route::get('profession', ProfessionDashboard::class)->name('profession.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('profession-create', ProfessionCreate::class)->name('profession.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('profession-update/{slug}', ProfessionUpdate::class)->name('profession.update')->middleware('auth', 'role:superadmin|admin');

    //Admin Gender
    Route::get('gender', GenderDashboard::class)->name('gender.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('gender-create', GenderCreate::class)->name('gender.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('gender-update/{slug}', GenderUpdate::class)->name('gender.update')->middleware('auth', 'role:superadmin|admin');

    
    //Admin delivery basket
    Route::get('delivery-basket', DeliveryBasketDashboard::class)->name('delivery-basket.dashboard')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('delivery-basket-create', DeliveryBasketCreate::class)->name('delivery-basket.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('delivery-basket-update/{slug}', DeliveryBasketUpdate::class)->name('delivery-basket.update')->middleware('auth', 'role:superadmin|admin');
    

    //Admin Countrie
    Route::get('country', CountryDashboard::class)->name('country.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('country-create', CountryCreate::class)->name('country.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('country-update/{slug}', CountryUpdate::class)->name('country.update')->middleware('auth', 'role:superadmin|admin');

    //Admin Departamento
    Route::get('department', DepartmentDashboard::class)->name('department.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('department-create', DepartmentCreate::class)->name('department.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('department-update/{slug}', DepartmentUpdate::class)->name('department.update')->middleware('auth', 'role:superadmin|admin');

    
    //Admin Estado Beneficiario
    Route::get('beneficiary-state', BeneficiaryStateDashboard::class)->name('beneficiary-state.dashboard')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('beneficiary-state-create', BeneficiaryStateCreate::class)->name('beneficiary-state.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('beneficiary-state-update/{slug}', BeneficiaryStateUpdate::class)->name('beneficiary-state.update')->middleware('auth', 'role:superadmin|admin');

    //Admin Province
    Route::get('province', ProvinceDashboard::class)->name('province.dashboard')->middleware('auth')->middleware('auth', 'role:superadmin|admin');
    Route::get('province-create', ProvinceCreate::class)->name('province.create')->middleware('auth')->middleware('auth', 'role:superadmin|admin');
    Route::get('province-update/{slug}', ProvinceUpdate::class)->name('province.update')->middleware('auth')->middleware('auth', 'role:superadmin|admin');

    //Admin Municipality
    Route::get('municipality', MunicipalityDashboard::class)->name('municipality.dashboard')->middleware('auth')->middleware('auth', 'role:superadmin|admin');
    Route::get('municipality-create', MunicipalityCreate::class)->name('municipality.create')->middleware('auth')->middleware('auth', 'role:superadmin|admin');
    Route::get('municipality-update/{slug}', MunicipalityUpdate::class)->name('municipality.update')->middleware('auth')->middleware('auth', 'role:superadmin|admin');

    //Admin Beneficiary State Detail
    Route::get('beneficiary-state-detail', BeneficiaryStateDetailDashboard::class)->name('beneficiary-state-detail.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('beneficiary-state-detail-create/{slug}', BeneficiaryStateDetailCreate::class)->name('beneficiary-state-detail.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('beneficiary-state-detail-update/{slug}', BeneficiaryStateDetailUpdate::class)->name('beneficiary-state-detail.update')->middleware('auth', 'role:superadmin|admin');

    //Beneficiary
    Route::get('beneficiary', BeneficiaryDashboard::class)->name('beneficiary.dashboard')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('beneficiary-create', BeneficiaryCreate::class)->name('beneficiary.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('beneficiary-update/{slug}', BeneficiaryUpdate::class)->name('beneficiary.update')->middleware('auth', 'role:superadmin|admin');
    Route::get('beneficiary-print/{slug}', BeneficiaryPrint::class)->name('beneficiary.print')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('beneficiary-update-state/{slug}', BeneficiaryUpdateState::class)->name('beneficiary.update.state')->middleware('auth', 'role:superadmin|admin');


    //Admin Barrios o comunidad
    Route::get('neighborhood-community', NeighborhoodCommunityDashboard::class)->name('neighborhood-community.dashboard')->middleware('auth', 'role:superadmin|admin');
    Route::get('neighborhood-community-create/{slug}', NeighborhoodCommunityCreate::class)->name('neighborhood-community.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('neighborhood-community-update/{slug}', NeighborhoodCommunityUpdate::class)->name('neighborhood-community.update')->middleware('auth', 'role:superadmin|admin');

     //Admin District o canton
     Route::get('canton-district', CantonDistrictDashboard::class)->name('canton-district.dashboard')->middleware('auth', 'role:superadmin|admin');
     Route::get('canton-district-create', CantonDistrictCreate::class)->name('canton-district.create')->middleware('auth', 'role:superadmin|admin');
     Route::get('canton-district-update/{slug}', CantonDistrictUpdate::class)->name('canton-district.update')->middleware('auth', 'role:superadmin|admin');

    //product
    Route::get('product', ProductDashboard::class)->name('product.dashboard')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('product-create', ProductCreate::class)->name('product.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('product-update/{slug}', ProductUpdate::class)->name('product.update')->middleware('auth', 'role:superadmin|admin');

    //basket
    Route::get('basket', BasketDashboard::class)->name('basket.dashboard')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('basket-create', BasketCreate::class)->name('basket.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('basket-update/{slug}', BasketUpdate::class)->name('basket.update')->middleware('auth', 'role:superadmin|admin');
    Route::get('basket-add-product/{slug}', BasketAddProduct::class)->name('basketadd.product')->middleware('auth', 'role:superadmin|admin');
    Route::get('basket-add-product-update/{slug}', BasketAddProductUpdate::class)->name('basketadd.product.update')->middleware('auth', 'role:superadmin|admin');

    //Subgovernment
    Route::get('subgovernment', SubgovernmentDashboard::class)->name('subgovernment.dashboard')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('subgovernment-create', SubgovernmentCreate::class)->name('subgovernment.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('subgovernment-update/{slug}', SubgovernmentUpdate::class)->name('subgovernment.update')->middleware('auth', 'role:superadmin|admin');

    //basket-municipality
    Route::get('municipality-basket', MunicipalityBasketDashboard::class)->name('municipality-basket.dashboard')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('municipality-basket-create', MunicipalityBasketCreate::class)->name('municipality-basket.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('municipality-basket-update/{slug}', MunicipalityBasketUpdate::class)->name('municipality-basket.update')->middleware('auth', 'role:superadmin|admin');

    //delivery
    Route::get('delivery', DeliveryDashboard::class)->name('delivery.dashboard')->middleware('auth', 'role:superadmin|admin|user');
    Route::get('delivery-create', DeliveryCreate::class)->name('delivery.create')->middleware('auth', 'role:superadmin|admin');
    Route::get('delivery-update/{slug}', DeliveryUpdate::class)->name('delivery.update')->middleware('auth', 'role:superadmin|admin');

    //delivery basket detail
    Route::get('delivery-basket-detail', DeliveryBasketDetailAdminDashboard::class)->name('delivery-basket-detail.dashboard')->middleware('auth', 'role:superadmin|admin');
    // report 
    Route::get('report-user', ReportByUser::class)->name('report.user')->middleware('auth', 'role:superadmin|admin');
    Route::get('report-subgovernment-user', ReportSubgovernmentByUser::class)->name('report.subgobernment-user')->middleware('auth', 'role:superadmin|admin');



    ///SUBGOBERNACIONES
    //product
    Route::get('product-subgovernment', ProductSubgovernmentDashboard::class)->name('product-subgovernment.dashboard')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('product-subgovernment-create', ProductSubgovernmentCreate::class)->name('product-subgovernment.create')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('product-subgovernment-update/{slug}', ProductSubgovernmentUpdate::class)->name('product-subgovernment.update')->middleware('auth', 'role:subgobernacionadmin');

   //basket-subgobernment
    Route::get('basket-subgobernment', BasketSubgobernmentDashboard::class)->name('basket-subgobernment.dashboard')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('basket-subgobernment-create', BasketSubgobernmentCreate::class)->name('basket-subgobernment.create')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('basket-subgobernment-update/{slug}', BasketSubgobernmentUpdate::class)->name('basket-subgobernment.update')->middleware('auth', 'role:subgobernacionadmin');
    
    Route::get('basket-subgobernment-add-product/{slug}', BasketSubgobernmentAddProduct::class)->name('basketsubgobernmentadd.product')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('basket-subgobernment-add-product-update/{slug}', BasketSubgobernmentAddProductUpdate::class)->name('basketsubgobernmentadd.product.update')->middleware('auth', 'role:subgobernacionadmin');

    //Admin DeliveryPoint
    Route::get('delivery-point-subgobernment-dashboard', DeliveryPointSubgobernmentDashboard::class)->name('delivery-point-subgobernment.dashboard')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('delivery-point-subgobernment-create', DeliveryPointSubgobernmentCreate::class)->name('delivery-point-subgobernment.create')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('delivery-point-subgobernment-update/{slug}', DeliveryPointSubgobernmentUpdate::class)->name('delivery-point-subgobernment.update')->middleware('auth', 'role:subgobernacionadmin');
    
    //Beneficiary
    Route::get('beneficiary-subgobernment-dashboard', BeneficiarySubgobernmentDashboard::class)->name('beneficiary-subgobernment.dashboard')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
    Route::get('beneficiary-subgobernment-create', BeneficiarySubgobernmentCreate::class)->name('beneficiary-subgobernment.create')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
    Route::get('beneficiary-subgobernment-update/{slug}', BeneficiarySubgobernmentUpdate::class)->name('beneficiary-subgobernment.update')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
    Route::get('beneficiary-subgobernment-update-state/{slug}', BeneficiarySubgobernmentUpdateState::class)->name('beneficiary-subgobernment.update.state')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
    Route::get('beneficiary-subgobernment-print/{slug}', BeneficiarySubgobernmentPrint::class)->name('beneficiary-subgobernment.print')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
    Route::get('beneficiary-subgobernment-history/{slug}', BeneficiarySubgobernmentHistory::class)->name('beneficiary-subgobernment.update.history')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');

   
    //delivery
    Route::get('delivery-subgobernment', DeliverySubgobernmentDashboard::class)->name('delivery-subgobernment.dashboard')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('delivery-subgobernment-create', DeliverySubgobernmentCreate::class)->name('delivery-subgobernment.create')->middleware('auth', 'role:subgobernacionadmin');
    Route::get('delivery-subgobernment-update/{slug}', DeliverySubgobernmentUpdate::class)->name('delivery-subgobernment.update')->middleware('auth', 'role:subgobernacionadmin');

    //delivery basket
    Route::get('delivery-basket-subgobernment', DeliveryBasketSubgobernmentDashboard::class)->name('delivery-basket-subgobernment.dashboard')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
    Route::get('delivery-basket-subgobernment-create/{slug}', DeliveryBasketSubgobernmentCreate::class)->name('delivery-basket-subgobernment.create')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
    Route::get('delivery-basket-subgobernment-update/{slug}', DeliveryBasketSubgobernmentUpdate::class)->name('delivery-basket-subgobernment.update')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
    Route::get('delivery-basket-subgoberment-print-detail/{slug}', DeliveryBasketSubgobernmentPrintDetail::class)->name('delivery-basket-subgobernment.print')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');

    //delivery basket detail
    Route::get('delivery-basket-subgobernment-detail', DeliveryBasketDetailDashboard::class)->name('delivery-basket-subgobernment-detail.dashboard')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');

    // report 
    Route::get('report-user-subgobernment', ReportByUserSubgovernment::class)->name('report-user.subgobernment')->middleware('auth', 'role:subgobernacionadmin|subgobernacionuser');
});
