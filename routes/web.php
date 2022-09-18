<?php

use App\Http\Controllers\Admin\AdminlistingController;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\SendMessageController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\User\AdvertisementController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\FraudController;
use App\Http\Controllers\SaveAdController;

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
// dropdown menu
Route::get('/', [MenuController::class, 'menu'])->name('menu');

// frontend route
Route::get('/product/{categorySlug}/{subcategorySlug}', [FrontendController::class, 'findBasedOnSubcategory'])->name('subcategory.show');
Route::get('/product/{categorySlug}/{subcategorySlug}/{childCategorySlug}', [FrontendController::class, 'findBasedOnChildcategory'])->name('childcategory.show');
Route::get('/product/{categorySlug}', [FrontendController::class, 'findBasedOnCategory'])->name('category.show');
Route::get('/products/{id}/{slug}', [FrontendController::class, 'show'])->name('product.view');
// Route::post('/start-conversation', [SendMessageController::class, 'startConversation'])->name('message.send');

// send message
Route::post('/send/message', [SendMessageController::class, 'store'])->name('message.send')->middleware('user');;
Route::get('/messages', [SendMessageController::class, 'index'])->name('messages')->middleware('user');;
Route::get('/users', [SendMessageController::class, 'chatWithThisUser'])->middleware('user');;
Route::get('/message/user/{id}', [SendMessageController::class, 'showMessages'])->middleware('user');;
Route::post('/start-conversation', [SendMessageController::class, 'startConversation'])->middleware('user');;

//Save ad
Route::post('/ad/save', [SaveAdController::class, 'saveAd']);
Route::post('/ad/remove',[SaveAdController::class, 'removeAd'])->name('ad.remove');
Route::get('/saved-ads',[SaveAdController::class, 'getMyads'])->name('saved.ad');
Route::get('/ad-pending', [AdvertisementController::class, 'pendingAds'])->name('pending.ad');
// reportads
Route::post('/report-this-ad', [FraudController::class, 'store'])->name('report.ad');



//login with facebook
Route::get('auth/facebook', [SocialLoginController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialLoginController::class, 'loginWithFacebook']);

Route::group(['prefix' => 'auth','middleware'=>'admin'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('category/view', [CategoryController::class, 'index'])->name('category.view');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/create', [CategoryController::class, 'store'])->name('category.save');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    
    // sub category
    Route::get('subcategory/view', [SubcategoryController::class, 'index'])->name('subcategory.view');
    Route::get('subcategory/create', [SubcategoryController::class, 'create'])->name('subcategory.create');
    Route::post('subcategory/create', [SubcategoryController::class, 'store'])->name('subcategory.save');
    Route::get('subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('subcategory/edit/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete');

    // Child category
    Route::get('childcategory/view', [ChildcategoryController::class, 'index'])->name('childcategory.view');
    Route::get('childcategory/create', [ChildcategoryController::class, 'create'])->name('childcategory.create');
    Route::post('childcategory/create', [ChildcategoryController::class, 'store'])->name('childcategory.save');
    Route::get('childcategory/edit/{id}', [ChildcategoryController::class, 'edit'])->name('childcategory.edit');
    Route::post('childcategory/edit/{id}', [ChildcategoryController::class, 'update'])->name('childcategory.update');
    Route::delete('childcategory/delete/{id}', [ChildcategoryController::class, 'destroy'])->name('childcategory.delete');
    
    //adminlisting
    Route::get('/allads',[AdminlistingController::class, 'index'])->name('all.ads');
    
    //user ads
    Route::get('/ads/{userId}/view', [AdvertisementController::class, 'viewUserAds'])->name('show.user.ads');
    Route::delete('/ads/{id}/delete', [AdvertisementController::class, 'destroy'])->name('ads.destroy');


    //listing reported ad
    Route::get('/reported-ads', [FraudController::class, 'index'])->name('all.reported.ads');

});


Route::group(['as' => 'user.','prefix' => 'user','namespace' => 'User', 'middleware' => ['auth','user']], function(){
    Route::get('dashboard', [AdvertisementController::class, 'index'])->name('dashboard');
    Route::get('ads/view', [AdvertisementController::class, 'index'])->name('ads.view');
    Route::get('ads/create', [AdvertisementController::class, 'create'])->name('ads.create');
    Route::post('ads/create', [AdvertisementController::class, 'store'])->name('ads.save');
    Route::get('ads/edit/{id}', [AdvertisementController::class, 'edit'])->name('ads.edit');
    Route::post('ads/edit/{id}', [AdvertisementController::class, 'update'])->name('ads.update');
    Route::post('ads/delete/{id}', [AdvertisementController::class, 'destroy'])->name('ads.delete');
    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/password', [ProfileController::class, 'passwordSave'])->name('password.update');

   
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

