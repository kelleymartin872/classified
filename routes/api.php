<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ApiCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('category', [ApiCategoryController::class, 'getCategory'])->name('api.category.view');
Route::get('subcategory', [ApiCategoryController::class, 'getSubcategory'])->name('api.category.view');
Route::get('childcategory', [ApiCategoryController::class, 'getChildcategory'])->name('api.category.view');

Route::get('country', [AddressController::class, 'getCountry'])->name('api.country.view');
Route::get('state', [AddressController::class, 'getState'])->name('api.state.view');
Route::get('city', [AddressController::class, 'getCity'])->name('api.city.view');
