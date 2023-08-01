<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\SearchRecordController;
use App\Http\Middleware\ApiTokenCheck;
use App\Models\SearchRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("v1")->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource("contact", ContactController::class);
        Route::get("contact-trash", [ContactController::class, "trash"]);
        Route::delete("force-delete/{id}", [ContactController::class, "forceDelete"]);
        Route::delete("force-delete-all", [ContactController::class, "forceDeleteAll"]);
        Route::post("restore/{id}", [ContactController::class, "restore"]);
        Route::post("restore-all", [ContactController::class, "restoreAll"]);
        Route::apiResource("search-records", SearchRecordController::class)->only(["index", "destroy"]);
        Route::apiResource("favourites", FavouriteController::class)->only(["index", "store", "destroy"]);
        Route::post("logout", [ApiAuthController::class, "logout"]);
        Route::post("logout-all", [ApiAuthController::class, "logoutAll"]);
        Route::get("devices", [ApiAuthController::class, "devices"]);
    });

    Route::post("register", [ApiAuthController::class, "register"]);
    Route::post("login", [ApiAuthController::class, "login"]);
});
