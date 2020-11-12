<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome', ['auth_user' => Auth::user()]);
});

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'home'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('get_user', 'HomeController@getCurrentUser');
});

Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'article'], function () {
    Route::get('get_all', 'ArticleController@getAllArticles');
    Route::get('get_paginated_articles', 'ArticleController@getPaginatedArticles');
    Route::post('create_article', 'ArticleController@createArticle');
});

Route::group(['middleware' => 'auth', 'prefix' => 'secret'], function () {
    Route::get('get_all', 'SecretController@getAllSerects');
    Route::get('get_user_unlocked_secrets', 'SecretController@getUserUnlockedSecrets');
    Route::get('get_paginated_secrets', 'SecretController@getPaginatedSecrets');
    Route::post('unlock_secret', 'SecretController@unlockSecret');
    Route::post('create_secret', 'SecretController@createSecret');
});

Route::group(['middleware' => 'auth', 'prefix' => 'payment'], function () {
    Route::get('get_all_pricing', 'PaymentController@getAllPricings');
    Route::post('capture_transaction', 'PaymentController@captureTransaction');
});

Route::group(['middleware' => 'auth', 'prefix' => 'rating'], function () {
    Route::get('get_all', 'RatingController@getAllRelatedRatings');
    Route::post('edit_rating', 'RatingController@editaRating');
    Route::post('rate_article', 'RatingController@rateAnArticle');
    Route::post('rate_secret', 'RatingController@rateAnSecret');
});

Route::group(['middleware' => 'auth', 'prefix'=> 'messages'], function () {
    Route::get('/', 'MessageController@fetchAll');
    Route::post('/', 'MessageController@sendMessage');
    Route::get('get_with_user_id', 'MessageController@fetchAllWithUserId');
    Route::get('get_approved_users', 'MessageController@getApprovedUserList');
});

Route::group(['middleware' => 'auth', 'prefix'=> 'counselling'], function () {
    Route::get('get_categories', 'CounsellingController@getAllCategories');
    Route::get('get_paginated_request', 'CounsellingController@getPaginatedCounsellingRequest');
    Route::post('create_counselling_request', 'CounsellingController@createCounsellingRequest');
    Route::post('accept_request', 'CounsellingController@acceptCasualCounsellingRequest');
    Route::post('approve_request', 'CounsellingController@approveCasualCounsellingRequest');
});

Route::group(['middleware' => 'auth', 'prefix' => 'notification'], function () {
    Route::get('get_all', 'NotificationController@getAllUnreadNotification');
    Route::post('update_notification_status', 'NotificationController@modifyNotificationStatus');
});

Route::get('{any}', function () {
    return view('home');
})->where('any','.*');
