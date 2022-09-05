<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyListController;
use App\Http\Controllers\PropertyContractController;
use App\Http\Controllers\RentListController;
use App\Http\Controllers\BillCollectionController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UnitController;


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

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::post('/registration',[CustomAuthController::class, 'registration']);
Route::post('/userLogin',[CustomAuthController::class, 'userLogin']);

Route::middleware(['LoginCheck'])->group(function () {
    Route::get('/login', function () {
        return view('ui.login.login');
    });
    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout',[CustomAuthController::class, 'logout']);
    // property--
    Route::get('/addProperty',[PropertyController::class, 'index'])->name('addProperty');
    Route::post('/propertyStore',[PropertyController::class, 'store']);
    Route::get('/propertyList',[PropertyController::class, 'propertyListView'])->name('propertyList');
    Route::get('/propertyEdit/{id}',[PropertyController::class, 'propertyEdit'])->name('propertyEdit');
    Route::post('/propertyUpdate/{id}',[PropertyController::class, 'propertyUpdate']);
    Route::get('/propertyDelete/{id}',[PropertyController::class, 'propertyDelete']);
    // tenant--
    Route::get('/tenantRegister',[TenantController::class, 'tenantRegisterView'])->name('tenantRegisterView');
    Route::post('/tenantStore',[TenantController::class, 'tenantStore']);
    Route::get('/tenantList',[TenantController::class, 'tenantListView'])->name('tenantListView');
    Route::get('/tenantEdit/{id}',[TenantController::class, 'tenantEdit'])->name('tenantEdit');
    Route::post('/tenantUpdate/{id}',[TenantController::class, 'tenantUpdate']);
    Route::get('/tenantDelete/{id}',[TenantController::class, 'tenantDelete']);
    //unit--   
    Route::get('/unitCreate',[UnitController::class, 'unitCreateView'])->name('unitCreateView');
    Route::get('/propertSearch',[UnitController::class, 'propertSearch']);
    Route::post('/createUnit',[UnitController::class, 'createUnit']);
    Route::get('/unitsList',[UnitController::class, 'unitsList'])->name('unitsList');
    Route::get('/unitsDetails/{id}',[UnitController::class, 'unitsDetails'])->name('unitsDetails');
    Route::get('/unitEdit/{id}',[UnitController::class, 'unitEdit'])->name('unitEdit');
    Route::get('/updateUnit/{id}',[UnitController::class, 'updateUnit'])->name('updateUnit');
    //contract--
    Route::get('/propertyContract',[PropertyContractController::class, 'index'])->name('propertyContract');
    Route::get('/autocomplete-search', [PropertyContractController::class, 'autocompleteSearch']);
    Route::get('/unitSearch',[PropertyContractController::class, 'unitSearch']);
    Route::post('/contractStore',[PropertyContractController::class, 'contractStore']);
    Route::get('/contractList',[PropertyContractController::class, 'contractList'])->name('contractList');
    Route::get('/tenantSearch',[PropertyContractController::class, 'tenantSearch'])->name('tenantSearch');
    //payment--
    Route::get('/billCollection',[BillCollectionController::class, 'index'])->name('billCollection');
    Route::post('/payment',[BillCollectionController::class, 'payment']);
    Route::post('/presentUnit',[BillCollectionController::class, 'presentUnit']);
    Route::get('/paymentHistory',[BillCollectionController::class, 'paymentHistory']);


    Route::get('/rentListEdit/{id}',[RentListController::class, 'rentListEdit'])->name('rentListEdit');
    Route::post('/updateRentList/{id}',[RentListController::class, 'updateRentList']);
    Route::get('/rentListDelete/{id}',[RentListController::class, 'rentListDelete']);
    
    
   
    Route::get('/invoice',[PropertyContractController::class, 'invoice']);
    
    Route::post('/billGenerate',[BillCollectionController::class, 'billGenerate']);
    Route::get('/pdfDownload',[BillCollectionController::class, 'pdfDownload']);
    // Route::get('/pdfDownload', function(){
    //     return "hi";
    // });
});  



