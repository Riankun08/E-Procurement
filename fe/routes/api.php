<?php

// System
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\TesterController;
use App\Http\Controllers\API\V1\AdminAndCheckerController;
use App\Http\Controllers\API\V1\ApplicantController;
use App\Http\Controllers\API\V1\LoginController;
use App\Http\Controllers\API\V1\VerificationController;
use App\Http\Controllers\API\V1\ForgotPasswordController;
use App\Http\Controllers\API\V1\ResetPasswordController;


// Fallback System
Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Resource not found, (CARI APA? #DIMDEVS)',
        'code' => 404,
    ], 404);
});

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


Route::prefix('v1')->group(function() {
    Route::prefix('/tester')->controller(TesterController::class)->group(function() {
        Route::get('/' , 'index')->name('tester.index');
        Route::post('/create' , 'create')->name('tester.create');
        Route::post('/admin/register', [AdminAndCheckerController::class, 'registerAdmin']);
        Route::post('/checker/register', [AdminAndCheckerController::class, 'registerChecker']);
        Route::post('/applicant/register', [ApplicantController::class, 'register']);

    });

    Route::prefix('/authentications')->controller(AuthController::class)->group(function() {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/verify-otp', [VerificationController::class, 'verifyOtp']);
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
        Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);
        route::post('/resend-otp', [ApplicantController::class, 'resendOtp']);
    });

    // Example
    // Route::prefix('/categories')->controller(CategoryController::class)->group(function() {
    //     Route::get('/' , 'index')->name('api.categories.index');
    //     Route::post('/create' , 'create')->name('api.categories.create');
    //     Route::post('/update/{id}', 'update')->name('api.categories.update');
    //     Route::get('/show/{id}', 'show')->name('api.categories.show');
    //     Route::delete('/destroy/{id}', 'destroy')->name('api.categories.destroy');
    // });
});
