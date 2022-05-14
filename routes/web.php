<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AddPropertyController;
use App\Http\Controllers\PropertyListController;
use App\Http\Controllers\PropertyContractController;
use App\Http\Controllers\RentListController;
use App\Http\Controllers\BillCollectionController;
use App\Http\Controllers\CustomAuthController;


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
    Route::get('/addProperty',[AddPropertyController::class, 'index'])->name('addProperty');
    Route::get('/propertyList',[PropertyListController::class, 'index'])->name('propertyList');
    Route::get('/propertyContract',[PropertyContractController::class, 'index'])->name('propertyContract');
    Route::get('/rentList',[RentListController::class, 'index'])->name('rentList');
    Route::get('/rentListEdit/{id}',[RentListController::class, 'rentListEdit'])->name('rentListEdit');
    Route::post('/updateRentList/{id}',[RentListController::class, 'updateRentList']);
    Route::get('/rentListDelete/{id}',[RentListController::class, 'rentListDelete']);
    Route::get('/billCollection',[BillCollectionController::class, 'index'])->name('billCollection');
    Route::post('/propertyStore',[AddPropertyController::class, 'store']);
    Route::get('/propertyEdit/{id}',[PropertyListController::class, 'propertyEdit'])->name('propertyEdit');
    Route::post('/propertyUpdate/{id}',[PropertyListController::class, 'propertyUpdate']);
    Route::get('/propertyDelete/{id}',[PropertyListController::class, 'propertyDelete']);
    Route::get('/propertTypeSearch',[PropertyContractController::class, 'propertTypeSearch']);
    // Route::get('/invoice',[PropertyContractController::class, 'invoice']);
    Route::post('/propertContractStore',[PropertyContractController::class, 'store']);
    Route::post('/billGenerate',[BillCollectionController::class, 'billGenerate']);
    Route::get('/pdfDownload',[BillCollectionController::class, 'pdfDownload']);
    // Route::get('/pdfDownload', function(){
    //     return "hi";
    // });
});  



