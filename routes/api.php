<?php

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

//Route::get('test', function () {
//    return response()->json(['data' => [], 'message' => 'test', 'success' => true]);
//});
// auth routes
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'AuthController@register');
    Route::get('user', 'AuthController@getAuthUser');
});
Route::group(['middleware'=>['jwt.auth']],function (){
    Route::post('add-dependant','AuthController@addDependants');
    Route::group(['prefix'=>'hospital'],function(){
        Route::get('/','HospitalController@index');
        Route::post('/{id}/delete','HospitalController@destroy');
        Route::post('/create','HospitalController@store');
        Route::post('/{id}/update','HospitalController@update');
        Route::get('get-branches/{id}','HospitalController@getBranches');
    });
    Route::post('edit/branch/{id}','HospitalController@editBranch');
    Route::post('delete/branch/{id}','HospitalController@deleteBranch');
    Route::post('create/branch','HospitalController@createBranch');
    Route::group(['prefix'=>'county'],function (){
        Route::get('/','CountyController@index');
        Route::post('/create','CountyController@store');
        Route::post('/{id}/delete','CountyController@destroy');
        Route::post('/{id}/update','CountyController@update');
    });
    Route::group(['prefix'=>'insurance'],function (){
        Route::get('/','InsuranceController@getAllInsurances');
        Route::post('/assign-members','InsuranceController@assignInsuranceToUser');
        Route::post('/edit','InsuranceController@editInsurance');
        Route::post('/create','InsuranceController@createInsurance');
    });
    Route::group(['prefix'=>'claim'],function (){
        Route::get('/','ClaimController@fetchAllClaims');
        Route::post('/create','ClaimController@createAClaim');
        Route::post('/verify','ClaimController@verifyClaimOTP');
        Route::post('/reject/approve/{id}','ClaimController@approveRejectClaim');
    });
});

