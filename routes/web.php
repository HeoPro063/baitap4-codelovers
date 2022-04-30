<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\User\AuthUserController;

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
// user
Route::get('/', function () {
    return view('user.home');
})->name('user.home');

Route::get('/active-user/{id}/{token}', [AuthUserController::class, 'active'])->name('active.user');
Route::get('/auth-user-active', function() {
    return view('user.auth-user-active');
})->name('auth-user-active');
Route::post('/user.post.auth-active', [AuthUserController::class, 'reAuthActive'])->name('user.post.auth-active');


Route::group(['prefix' => 'user'], function() {
    Route::get('/register', function () {
        return view('user.register');
    })->name('user.register');
    
    
    Route::get('/login', function () {
        return view('user.login');
    })->name('user.login');


    Route::post('post.regiser', [AuthUserController::class, 'register'])->name('user.post.regiser');
    Route::post('post.login', [AuthUserController::class, 'login'])->name('user.post.login');
    Route::group(['middleware' => 'auth-user'], function() {
        Route::get('/logout', [AuthUserController::class, 'logout'])->name('user.logout');
        Route::get('/mypage', [AuthUserController::class, 'mypage'])->name('user.mypage');
        Route::get('/user/mypage.edit', [AuthUserController::class, 'mypageEdit'])->name('user.mypage.edit');
        Route::post('/mypage/post/edit', [AuthUserController::class, 'postMypageEdit'])->name('user.post.mypageEdit');
        Route::get('/change.password', [AuthUserController::class, 'changePassword'])->name('user.change.password');
        Route::post('/post/change/password', [AuthUserController::class, 'postChangePassword'])->name('user.post.change.password');
        
    });

});




// admin

Route::get('/admin', function () {
    return view('admin.auth.login');
})->name('admin.login');

// Route::get('/admin/register', function () {
//     return view('admin.auth.register');
// })->name('admin.register');



Route::post('/admin-post-login', [AuthController::class, 'login'])->name('admin.post.login');
Route::post('/admin-post-register', [AuthController::class, 'register'])->name('admin.post.register');

Route::group(['middleware' => 'auth-admin', 'prefix' => 'admin'], function() {

    Route::group(['prefix' => 'home'], function() {
        Route::get('/index.html',  [HomeController::class, 'index'])->name('admin.home.index');
        Route::get('/disable/{id}', [UserController::class, 'disable'])->name('admin.home.disable');
        Route::get('/active/{id}', [UserController::class, 'active'])->name('admin.home.active');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('admin.home.delete');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

