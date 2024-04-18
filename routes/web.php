<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TranslaterController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// if(Auth::check() && Auth::user()->role != 'user')
// {
// Route::get('/dashboard',[PagesController::class,'dashboard']);
// }
// else
// {
// Route::get('/',[PagesController::class,'index']);
// }

Route::get('/', [PagesController::class, 'index']);

Route::get('/dashboard', [PagesController::class, 'dashboard'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

    Route::get('/trips/create', [TripController::class, 'create'])->middleware('auth', 'admin');
    Route::post('/trips/store/', [TripController::class, 'store'])->name('trips.store')->middleware('auth', 'admin');
    Route::get('/trips/createagain/{trip:id}', [TripController::class, 'createagain'])->name('trips.createagain')->middleware('auth', 'admin');
    Route::post('/trips/storeagain/{trip:id}', [TripController::class, 'storeagain'])->name('trips.storeagain')->middleware('auth', 'admin');
    Route::put('/trips/cancel/{trip:id}', [TripController::class, 'cancel'])->name('trips.cancel')->middleware('auth', 'admin');
    Route::get('/trips/alldatatables', [TripController::class, 'gettripsdatatables'])->name('trips.all')->middleware('auth', 'cashier');
    Route::get('/trips/all', [TripController::class, 'alltripsdatatables'])->middleware('auth', 'cashier');
   // Route::get('/books/chart', [BookingController::class, 'ch'])->middleware('auth', 'admin');

   // Route::get('/trips/chart', [BookingController::class, 'mostbookedtrips'])->middleware('auth', 'admin');
   // Route::get('/trips/bookingsperareachart', [BookingController::class, 'bookingsperarea'])->middleware('auth', 'admin');

    Route::put('/payment/confirm/{payment:id}', [BookingController::class, 'confirm'])->name('payment.confirm')->middleware('auth', 'cashier');
    Route::put('/payment/refund/{payment:id}', [BookingController::class, 'refund'])->name('payment.refund')->middleware('auth', 'cashier');

    Route::get('/books/alldatatables', [BookingController::class, 'getbooksdatatables'])->name('books.all')->middleware('auth', 'cashier');
    Route::get('/books/all', [BookingController::class, 'allbooksdatatables'])->middleware('auth', 'cashier');

    Route::get('/books/get/{trip:id}', [BookingController::class, 'tripgetbooksdatatables'])->name('books.trip')->middleware('auth', 'cashier');
    Route::get('/books/{trip:id}', [BookingController::class, 'tripbooksdatatables'])->name('books.trippage')->middleware('auth', 'cashier');

    Route::put('/books/attend/{booking:id}', [BookingController::class, 'attend'])->name('booking.attend')->middleware('auth', 'cashier');


    Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth', 'writer');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth', 'writer');
    Route::get('/posts/edit/{post:slug}', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth', 'writer');
    Route::put('/posts/update/{post:slug}', [PostController::class, 'update'])->middleware('auth', 'writer');
    Route::delete('/posts/delete/{post:slug}', [PostController::class, 'destroy'])->name('posts.delete')->middleware('auth', 'writer');
    Route::get('/posts/alldatatables', [PostController::class, 'getpostsdatatables'])->name('posts.all')->middleware('auth', 'writer');
    Route::get('/posts/all', [PostController::class, 'allpostdatatables'])->middleware('auth', 'writer');


    //Route::get('/triplikes/chart', [TripController::class, 'likeschart'])->middleware('auth', 'admin');

    Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('auth', 'writer');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store')->middleware('auth', 'writer');
    Route::get('/categories/edit/{category:name}', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('auth', 'writer');
    Route::put('/categories/update/{category:name}', [CategoryController::class, 'update'])->middleware('auth', 'writer');
    Route::delete('/categories/delete/{category:name}', [CategoryController::class, 'destroy'])->name('categories.delete')->middleware('auth', 'writer');
    Route::get('/categories/alldatatables', [CategoryController::class, 'getcategoriesdatatables'])->name('categories.all')->middleware('auth', 'writer');
    Route::get('/categories/all', [CategoryController::class, 'allcategoriesdatatables'])->middleware('auth', 'writer');

    Route::get('/suggestions/alldatatables', [SuggestionController::class, 'getsuggestionsdatatables'])->name('suggestions.all')->middleware('auth', 'admin');
    Route::get('/suggestions/all', [SuggestionController::class, 'allsuggestionsdatatables'])->middleware('auth', 'admin');
    Route::get('/suggestions/{suggestion:id}', [SuggestionController::class, 'show'])->name('read.suggestion')->middleware('auth', 'admin');

    Route::get('/translaters/create', [TranslaterController::class, 'create'])->middleware('auth', 'admin');
    Route::post('/translaters/store', [TranslaterController::class, 'store'])->name('translaters.store')->middleware('auth', 'admin');
    Route::get('/translaters/alldatatables', [TranslaterController::class, 'gettranslatersdatatables'])->name('translaters.all')->middleware('auth', 'admin');
    Route::get('/translaters/all', [TranslaterController::class, 'alltranslatersdatatables'])->middleware('auth', 'admin');
    Route::put('/translaters/update/{translater:id}', [TranslaterController::class, 'update'])->name('translaters.update')->middleware('auth', 'admin');
    Route::delete('/translaters/delete/{translater:id}', [TranslaterController::class, 'destroy'])->name('translaters.destroy')->middleware('auth', 'admin');

    Route::get('/albums/create', [AlbumController::class, 'create'])->middleware('auth', 'writer');
    Route::post('/albums/store/', [AlbumController::class, 'store'])->name('albums.store')->middleware('auth', 'writer');
    Route::get('/albums/alldatatables', [AlbumController::class, 'albumsgetbooksdatatables'])->name('albums.all')->middleware('auth', 'writer');
    Route::get('/albums/all', [AlbumController::class, 'albumsdatatables'])->middleware('auth', 'writer');
   

    Route::get('/photos/create', [PhotoController::class, 'create'])->middleware('auth', 'writer');
    Route::post('/photos/store/', [PhotoController::class, 'store'])->name('photos.store')->middleware('auth', 'writer');

    Route::get('/survey/create', [SurveyController::class, 'create'])->middleware('auth', 'admin');
    Route::post('/survey/store/', [SurveyController::class, 'store'])->name('survey.store')->middleware('auth', 'admin');
    Route::get('/survey/{survey:id}', [SurveyController::class, 'surviesdatadatatables'])->name('survey.show')->middleware('auth', 'admin');
    Route::get('/survies/alldatadatatables/{survey:id}', [SurveyController::class, 'getsurviesdatadatatables'])->name('survey.get')->middleware('auth', 'admin');
    Route::post('/survey/{survey:id}', [SurveyController::class, 'close'])->name('survey.close')->middleware('auth', 'admin');
    Route::get('/survies/alldatatables', [SurveyController::class, 'getsurviesdatatables'])->name('survey.all')->middleware('auth', 'admin');
    Route::get('/survies/all', [SurveyController::class, 'allsurviesdatatables'])->middleware('auth', 'admin');
    
    Route::get('/rates/alldatatables', [RateController::class, 'getratesdatatables'])->name('rates.all')->middleware('auth', 'admin');
    Route::get('/rates/all', [RateController::class, 'allratesdatatables'])->middleware('auth', 'admin');
    Route::put('/rates/approve/{rate:id}', [RateController::class, 'update'])->name('rate.approve')->middleware('auth', 'admin');

    Route::get('/users/alldatatables', [UserController::class, 'getusersdatatables'])->name('users.all')->middleware('auth', 'admin');
    Route::get('/users/all', [UserController::class, 'allusersdatatables'])->middleware('auth', 'admin');

    Route::get('/users/edit/{user:id}', [UserController::class, 'edit'])->name('users.edit')->middleware('auth', 'admin');
    Route::put('/users/update/{user:id}', [UserController::class, 'update'])->middleware('auth', 'admin');
    Route::delete('/users/delete/{user:id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth', 'admin');

    Route::get('/charts', [ChartController::class, 'charts'])->middleware('auth', 'admin');

    Route::get('/book/userdatatables', [BookingController::class, 'usergetbooksdatatables'])->name('books.user')->middleware('auth');
    Route::get('/book/user', [BookingController::class, 'userbooksdatatables'])->middleware('auth');

    Route::get('/coupons/user', [UserController::class, 'couponsget'])->name('coupons.user')->middleware('auth');
    Route::get('/coupons', [UserController::class, 'coupons'])->middleware('auth');

});


Route::get('/about', [PagesController::class, 'about']);

Route::get('/posts', [PostController::class, 'index']);

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post.slug');
Route::get('/post/search', [PostController::class, 'search']);
// Route::put('/posts/{post:slug}',[PostController::class,'update']);
// Route::delete('/posts/{post:slug}',[PostController::class,'destroy']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category:name}', [CategoryController::class, 'show'])->name('caregories.posts');


//Route::get('/categories/{category:name}',[CategoryController::class,'show']);
// Route::delete('/categories/{category:name}',[CategoryController::class,'destroy']);

Route::get('/suggestions/create', [SuggestionController::class, 'create'])->middleware('auth','suggestion');
Route::post('/suggestions/store', [SuggestionController::class, 'store'])->name('suggestion.store')->middleware('auth','suggestion');

Route::post('/postcomments/{post:id}', [CommentController::class, 'poststore'])->middleware('auth');
Route::post('/albumcomments/{album:id}', [CommentController::class, 'albumstore'])->middleware('auth');
Route::post('/tripcomments/{trip:id}', [CommentController::class, 'tripstore'])->middleware('auth');

Route::post('/like/{post:id}', [LikeController::class, 'likestore'])->middleware('auth');
Route::post('/dislike/{post:id}', [LikeController::class, 'dislikestore'])->middleware('auth');
Route::post('/likealbum/{album:id}', [LikeController::class, 'likealbumstore'])->middleware('auth');
Route::post('/dislikealbum/{album:id}', [LikeController::class, 'dislikealbumstore'])->middleware('auth');
Route::post('/liketrip/{trip:id}', [LikeController::class, 'triplikestore'])->middleware('auth');
Route::post('/disliketrip/{trip:id}', [LikeController::class, 'tripdislikestore'])->middleware('auth');

Route::get('/album', [AlbumController::class, 'index']);
Route::get('/album/{album:name}', [AlbumController::class, 'show'])->name('show.album');
Route::get('/albums/search', [AlbumController::class, 'search']);

Route::get('/rates/create', [RateController::class, 'create'])->middleware('auth');
Route::post('/rates/store', [RateController::class, 'store'])->name('rates.store')->middleware('auth','rate');
Route::get('/rates/all', [RateController::class, 'show']);
Route::get('/rates', [RateController::class, 'index']);


Route::get('/trips', [TripController::class, 'index']);
Route::get('/trips/{trip:id}', [TripController::class, 'show']);
Route::get('/trips/show/{trip:type}', [TripController::class, 'showtype']);
Route::get('/trips/showstatus/{trip:status}', [TripController::class, 'showstatus']);
Route::get('/trip/search', [TripController::class, 'search']);

Route::get('/book/{trip:id}', [BookingController::class, 'create'])->middleware('auth', 'trip');
Route::post('/book/{trip:id}/payment', [BookingController::class, 'payment'])->middleware('auth'); //->name('books.payment');
Route::post('/book/payment/mtncash/{payment:id}', [BookingController::class, 'mtncash'])->middleware('auth');
Route::post('/book/payment/syriatelcash/{payment:id}', [BookingController::class, 'syriatelcash'])->middleware('auth');
//Route::post('/book/payment/creditcard/{payment:id}',[BookingController::class,'creditcard'])->middleware('auth');
// Route::get('/book/creditcard/success', [BookingController::class, 'success'])->middleware('auth');
// Route::get('/book/creditcard/cancel', [BookingController::class, 'cancel'])->middleware('auth');

Route::get('/translater', [TranslaterController::class, 'index']);
Route::get('/translater/{translater:id}', [TranslaterController::class, 'show']);
Route::get('/translaters/search', [TranslaterController::class, 'search']);

Route::get('/survies', [SurveyController::class, 'index'])->middleware('auth');
Route::get('/survies/{survey:name}', [SurveyController::class, 'surveyentry'])->middleware('auth');
Route::post('/survies/{survey:name}', [SurveyController::class, 'surveystore'])->middleware('auth');

 Route::get('/change-language',[PagesController::class,'lang'])->name('change.language')->middleware('lang');
//Route::post('/change-language', [AppServiceProvider::class, 'boot'])->name('change.language');

//Route::get('/search', [PagesController::class, 'search'])->name('search');

//Route::get('/social-media-share', [PagesController::class,'ShareWidget']);

//Route::match(['get', 'post'], '/botman-chat', [PagesController::class,'invoke']);


require __DIR__ . '/auth.php';
