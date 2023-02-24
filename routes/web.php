<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivateProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get("/settings", [PrivateProfileController::class, 'index']);
    Route::put("/settings/social-links", [PrivateProfileController::class, 'social']);
    Route::post("/profile/update", [PrivateProfileController::class, 'store']);

    Route::get("/users", [UserController::class, 'index'])->name('users');
    Route::put("/user/password/update", [UserController::class, 'resetPassword']);
    
    Route::get("/new-blog", [BlogController::class, 'create'])->name("new-blog");
    Route::get("/blogs/edit/{slug}", [BlogController::class, 'edit']);
    Route::put("/blogs/edit", [BlogController::class, 'editStore'])->name('blogs.edit');
    Route::get("/blogs/manage/{slug}", [BlogController::class, 'manage']);
    Route::get("/blogs/stats/{slug}", [BlogController::class, 'stats']);
});
Route::middleware(['auth', 'verified', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::get('/users', [IndexController::class, 'users'])->name('users.index');
    Route::get('/tags', [IndexController::class, 'tags'])->name('tags.index');
});

Route::get("/blogs", [BlogController::class, 'index'])->name('blogs');
Route::get("/blogs/{slug}", [BlogController::class, 'show']);
Route::get("/blogs/tagged/{slug}", [BlogController::class, "tagSearch"]);
Route::get("/tags", [TagController::class, 'index'])->name('tags');
Route::get("users/{username}", [PublicProfileController::class, 'index']);
Route::get("/search", [SearchController::class, 'index'])->name('search');

require __DIR__ . '/auth.php';
