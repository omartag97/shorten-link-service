<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShortLinkController;
use App\Models\ShortLink;
use Illuminate\Support\Facades\Redis;
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

// -------------------------------- Users --------------------------------

// Registration
Route::post('/user/register',          [UserController::class, 'register']);

// login
Route::post('/user/login',             [UserController::class, 'login']);

// ------------------------------------------------------------------------


// -------------------------------- Shorten Links --------------------------------


// -------------------------------- CRUD --------------------------------

// Create
Route::post('/shortlink/create',             [ShortLinkController::class, 'create']);

// Update
Route::patch('/shortlink/update',             [ShortLinkController::class, 'update']);

// Delete
Route::post('/shortlink/delete',             [ShortLinkController::class, 'delete']);

// ------------------------------------------------------------------------


// Listing
Route::get('/shortlink/list',             [ShortLinkController::class, 'list']);

// Dectivate
Route::post('/shortlink/deavtivate',             [ShortLinkController::class, 'deavtivate']);

// sending shorten link as a parameter to function (shortenLink)
Route::get('/{shortenLink}',             [ShortLinkController::class, 'shortenLink']);


// ------------------------------------------------------------------------
