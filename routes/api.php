<?php

use App\Http\Controllers\Api\CaseStudyController;
use App\Http\Controllers\Api\CompanyProfileController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\FolderController;
use App\Http\Controllers\Api\FooterController;
use App\Http\Controllers\Api\AuthController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

//------------------------------Review Routes--------------------------------------//
Route::group(['prefix'=>'reviews'],function(){
    //show all Reviews
    Route::get('/review',[ReviewController::class,'index']);
    //show a specific review
    Route::get('/review/{review_id}',[ReviewController::class,'show']);
    //insert new review
    Route::post('/review',[ReviewController::class,'store']);
    //update existing review
    Route::post('/review/{review_id}',[ReviewController::class,'update']);
    //remove existing review
    Route::delete('/review/{review_id}',[ReviewController::class,'destroy']);
    //remove all reviews
    Route::get('/destroyall',[ReviewController::class,'destroy_all']);
    });


Route::get('/casestudy' , [CaseStudyController::class , 'index']);
Route::post('/casestudy' , [CaseStudyController::class , 'store']);
Route::get('/casestudy/{id}' , [CaseStudyController::class,'show' ]);
Route::put('casestudy/{id}', [CaseStudyController::class, 'update']);
Route::delete('casestudy/{id}', [CaseStudyController::class, 'destroy']);


Route::get('/companyprofile' , [CompanyProfileController::class , 'index']);
Route::post('/companyprofile' , [CompanyProfileController::class , 'store']);
Route::get('/companyprofile/{id}' , [CompanyProfileController::class,'show' ]);
Route::put('companyprofile/{id}', [CompanyProfileController::class, 'update']);
Route::delete('companyprofile/{id}', [CompanyProfileController::class, 'destroy']);

Route::get('/file' , [FileController::class , 'index']);
Route::post('/file' , [FileController::class , 'store']);
Route::get('/file/{id}' , [FileController::class,'show' ]);
Route::put('file/{id}', [FileController::class, 'update']);
Route::delete('file/{id}', [FileController::class, 'destroy']);

Route::get('/folder' , [FolderController::class , 'index']);
Route::post('/folder' , [FolderController::class , 'store']);
Route::get('/folder/{id}' , [FolderController::class,'show' ]);
Route::put('folder/{id}', [FolderController::class, 'update']);
Route::delete('folder/{id}', [FolderController::class, 'destroy']);

Route::get('/footer' , [FooterController::class , 'index']);
Route::post('/footer' , [FooterController::class , 'store']);
Route::get('/footer/{id}' , [FooterController::class,'show' ]);
Route::put('footer/{id}', [FooterController::class, 'update']);
Route::delete('footer/{id}', [FooterController::class, 'destroy']);
