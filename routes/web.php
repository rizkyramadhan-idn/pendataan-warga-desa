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
    return view('welcome');
});

Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin')->name("admin.login.post");
Route::get('admin/logout', 'Auth\AdminAuthController@postLogout')->name("admin.logout");

Auth::routes([
    'reset' => false,
    'verify' => false,
]);

// Route untuk user

Route::group(["middleware" => "auth"], function() {
    Route::get('/home', 'HomeController@index')->name('user.home');
    Route::get('/user/profile/{user}', 'HomeController@userProfile')->name('user.profile');
    Route::get('/user/profile/edit/{user}', 'HomeController@editUserProfile')->name('user.profile.edit');
    Route::put('/user/profile/update/{user}', 'HomeController@updateUserProfile')->name('user.profile.update');

    Route::resource("reports", "ReportController", ["as" => "user"])->except(["show", "edit", "update", "destroy"]);
});

// Route untuk admin

Route::group(["prefix" => "admin", "middleware" => "auth:admin"], function() {
    Route::get("/home", function() {
        return view("admin.index");
    })->name("admin.home");

    Route::resource("jobs", "JobController", ["as" => "admin"])->except(["show"]);
    Route::resource("provinces", "ProvinceController", ["as" => "admin"])->except(["show"]);
    Route::resource("cities", "CityController", ["as" => "admin"])->except(["show"]);
    Route::resource("users", "UserController", ["as" => "admin"])->except(["show", "create", "store", "edit", "update"]);
    Route::resource("reports", "UserReportController", ["as" => "admin"])->except(["create", "store", "edit", "update", "destroy"]);
});