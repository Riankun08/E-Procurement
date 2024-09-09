<?php

use Illuminate\Support\Facades\Route;

// WEB
use App\Http\Controllers\Admin\FormDynamicController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CheckerController;
use App\Http\Controllers\Admin\FormulaController;
use App\Http\Controllers\Admin\ElementController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AuthController;

// API
use App\Http\Controllers\API\V1\PasswordResetController;

// Route::get('/csrf-token', function () {
//     return response()->json(['csrf_token' => csrf_token()]);
// });

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('authentications')->controller(AuthController::class)->group(function(){
    // vendor
    Route::get('/login/vendor', function() {
        return view('auth.login-vendor');
    })->name('authentications.login.vendor');
    Route::get('/register/vendor', function() {
        return view('auth.register-vendor');
    })->name('authentications.register.vendor');

    // buyer
    Route::get('/login/buyer', function() {
        return view('auth.login-buyer');
    })->name('authentications.login.buyer');
    
    Route::get('/home', 'home')->name('authentications.home');
    Route::post('/store', 'store')->name('authentications.store');
    Route::get('/logout', 'logout')->name('authentications.logout');
    Route::get('/forgot-password' , 'forgotPassword')->name('authentications.forgot-password');
});

Route::get('/password/reset', function () {
    return view('auth.reset-password');
})->name('password.reset');

Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/' , [DashboardController::class,'index'])->name('dashboard');

    // CHECKER
    Route::prefix('checkers')->controller(CheckerController::class)->group(function(){
        Route::get('/', 'index')->name('checkers.index');
        Route::get('/create', 'create')->name('checkers.create');
        Route::post('/create/store', 'store')->name('checkers.store');
        Route::get('/edit/{id}', 'edit')->name('checkers.edit');
        Route::put('/edit/update/{id}', 'update')->name('checkers.update');
        Route::get('/detail/{id}', 'show')->name('checkers.show');
        Route::delete('/delete/{id}', 'destroy')->name('checkers.destroy');
    });

    // ADMIN
    Route::prefix('admins')->controller(AdminController::class)->group(function(){
        Route::get('/', 'index')->name('admins.index');
        Route::get('/create', 'create')->name('admins.create');
        Route::post('/create/store', 'store')->name('admins.store');
        Route::get('/edit/{id}', 'edit')->name('admins.edit');
        Route::put('/edit/update/{id}', 'update')->name('admins.update');
        Route::get('/detail/{id}', 'show')->name('admins.show');
        Route::delete('/delete/{id}', 'destroy')->name('admins.destroy');
    });

    // CATEGORY
    Route::prefix('categories')->controller(CategoryController::class)->group(function(){
        Route::get('/', 'index')->name('categories.index');
        Route::get('/create', 'create')->name('categories.create');
        Route::post('/create/store', 'store')->name('categories.store');
        Route::get('/edit/{id}', 'edit')->name('categories.edit');
        Route::put('/edit/update/{id}', 'update')->name('categories.update');
        Route::get('/detail/{id}', 'show')->name('categories.show');
        Route::delete('/delete/{id}', 'destroy')->name('categories.destroy');
    });

    // ELEMENT
    Route::prefix('elements')->controller(ElementController::class)->group(function(){
        Route::get('/', 'index')->name('elements.index');
        Route::get('/create', 'create')->name('elements.create');
        Route::post('/create/store', 'store')->name('elements.store');
        Route::get('/edit/{id}', 'edit')->name('elements.edit');
        Route::put('/edit/update/{id}', 'update')->name('elements.update');
        Route::get('/detail/{id}', 'show')->name('elements.show');
        Route::delete('/delete/{id}', 'destroy')->name('elements.destroy');
    });

    // FORMULA
    Route::prefix('formulas')->controller(FormulaController::class)->group(function(){
        Route::get('/', 'index')->name('formulas.index');
        Route::get('/create', 'create')->name('formulas.create');
        Route::post('/create/store', 'store')->name('formulas.store');
        Route::get('/edit/{id}', 'edit')->name('formulas.edit');
        Route::put('/edit/update/{id}', 'update')->name('formulas.update');
        Route::get('/detail/{id}', 'show')->name('formulas.show');
        Route::delete('/delete/{id}', 'destroy')->name('formulas.destroy');
    });

    // FORM
    Route::prefix('forms-dynamies')->controller(FormDynamicController::class)->group(function(){
        Route::get('/', 'index')->name('forms-dynamies.index');
        Route::get('/create', 'create')->name('forms-dynamies.create');
        Route::post('/create/store', 'store')->name('forms-dynamies.store');
        Route::get('/edit/{id}', 'edit')->name('forms-dynamies.edit');
        Route::put('/edit/update/{id}', 'update')->name('forms-dynamies.update');
        Route::get('/detail/{id}', 'show')->name('forms-dynamies.show');
        Route::delete('/delete/{id}', 'destroy')->name('forms-dynamies.destroy');

        // FORM GROUP CHILD
        Route::get('/groups/{form_id}', 'indexGroup')->name('forms-dynamies.group.index');
        Route::get('/groups/create/{form_id}', 'createGroup')->name('forms-dynamies.group.create');
        Route::post('/groups/create/store/{form_id}', 'storeGroup')->name('forms-dynamies.group.store');
        Route::get('/group/edit/{group_id}', 'editGroup')->name('forms-dynamies.group.edit');
        Route::put('/group/edit/update/{group_id}', 'updateGroup')->name('forms-dynamies.group.update');
        Route::get('/group/detail/{group_id}', 'showGroup')->name('forms-dynamies.group.show');
        Route::delete('/group/delete/{group_id}', 'destroyGroup')->name('forms-dynamies.group.destroy');
    });

    // Role
    Route::prefix('roles')->controller(RoleController::class)->group(function(){
        Route::get('/', 'index')->name('roles.index');
        Route::get('/create', 'create')->name('roles.create');
        Route::post('/create/store', 'store')->name('roles.store');
        Route::get('/edit/{id}', 'edit')->name('roles.edit');
        Route::put('/edit/update/{id}', 'update')->name('roles.update');
        Route::get('/detail/{id}', 'show')->name('roles.show');
        Route::delete('/delete/{id}', 'destroy')->name('roles.destroy');
    });

    // Permission
    Route::prefix('permissions')->controller(PermissionController::class)->group(function(){
        Route::get('/', 'index')->name('permissions.index');
        Route::get('/create', 'create')->name('permissions.create');
        Route::post('/create/store', 'store')->name('permissions.store');
        Route::get('/edit/{id}', 'edit')->name('permissions.edit');
        Route::put('/edit/update/{id}', 'update')->name('permissions.update');
        Route::get('/detail/{id}', 'show')->name('permissions.show');
        Route::delete('/delete/{id}', 'destroy')->name('permissions.destroy');
    });

});
