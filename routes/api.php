<?php

use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\Api\ModulesController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return json_response(['status' => true, 'code' => 200, 'message' => 'APIs are running', 'data' => '']);
});
Route::post('login', [UsersController::class, 'login']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group(['middleware' => ['auth:sanctum']], function () {
// });
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [UsersController::class, 'logout'])->withoutMiddleware(['license_key_verification']);
    Route::get('/logout-all', [UsersController::class, 'logoutAll']);
    Route::post('/verify-license-key', [UsersController::class, 'verifyLicenseKey'])->withoutMiddleware(['license_key_verification']);
    //Users APIs
    Route::prefix('users')->group(function () {
        Route::get('/{searchStr?}', [UsersController::class, 'getUsers'])->name('users.all');
        Route::post('add', [UsersController::class, 'store'])->name('users.add');
        Route::get('{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('{id}/update', [UsersController::class, 'update'])->name('users.update');
        Route::delete('{id}/delete', [UsersController::class, 'delete'])->name('users.delete');
    });
    // Modules
    Route::prefix('modules')->group(function () {
        Route::get('/{searchStr?}', [ModulesController::class, 'index'])->name('modules.all');
        Route::post('add', [ModulesController::class, 'store'])->name('modules.add');
        Route::get('{id}/edit', [ModulesController::class, 'edit'])->name('modules.edit');
        Route::post('{id}/update', [ModulesController::class, 'update'])->name('modules.update');
        Route::delete('{id}/delete', [ModulesController::class, 'delete'])->name('modules.delete');
    });
    // Company
    Route::prefix('companies')->group(function () {
        Route::get('/{searchStr?}', [CompaniesController::class, 'index'])->name('company.all');
        Route::post('add', [CompaniesController::class, 'store'])->name('company.add');
        Route::get('{id}/edit', [CompaniesController::class, 'edit'])->name('company.edit');
        Route::post('{id}/update', [CompaniesController::class, 'update'])->name('company.update');
        Route::delete('{id}/delete', [CompaniesController::class, 'delete'])->name('company.delete');
    });
});
