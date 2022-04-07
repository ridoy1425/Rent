<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AddPropertyController;
use App\Http\Controllers\PropertyListController;
use App\Http\Controllers\PropertyContractController;
use App\Http\Controllers\RentListController;
use App\Http\Controllers\BillCollectionController;

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

Route::get('/login', function () {
    return view('ui.login.login');
});

Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
Route::get('/addProperty',[AddPropertyController::class, 'index'])->name('addProperty');
Route::get('/propertyList',[PropertyListController::class, 'index'])->name('propertyList');
Route::get('/propertyContract',[PropertyContractController::class, 'index'])->name('propertyContract');
Route::get('/rentList',[RentListController::class, 'index'])->name('rentList');
Route::get('/billCollection',[BillCollectionController::class, 'index'])->name('billCollection');
