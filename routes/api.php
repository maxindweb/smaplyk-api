<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\http\Controllers\PostCategoryController;


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

//post route
Route::get('/post/published', [PostController::class, 'scopePublished']);
Route::get('/post/{slug}', [PostController::class, 'show']);
Route::post('/post/published/', [PostController::class, 'publieshedArticle']);
Route::post('/post/{slug}/archive', [PostController::class, 'archive']);
Route::delete('/post/{slug}', [PostController::class, 'destroy']);

//post category controller
Route::get('/category', [PostCategoryController::class, 'index']);
Route::post('/category', [PostCategoryController::class, 'store']);
Route::get('/category/published/{id}', [PostCategoryController::class, 'showScopedPublished']);
Route::get('/category/{post}', [PostCategoryController::class, 'showAll']);

//user api
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{users}', [UserController::class, 'show']);
Route::post('/users/{users}', [UserController::class, 'update']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/post', [PostController::class, 'store']);
    Route::get('/post/{slug}', [PostController::class, 'show']);
    Route::get('/post', [PostController::class, 'index']);
});

Route::group(['prefix' => 'auth'], function(){
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login'])->name('login');
});