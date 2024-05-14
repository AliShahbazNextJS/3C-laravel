<?php
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
    
});
