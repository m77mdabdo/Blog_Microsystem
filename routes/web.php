<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Editor\EditorController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';


Route::controller(HomeController::class)->group(function(){
    Route::get('/admin/home','index')->name('admin.home');

});

Route::controller(AdminController::class)->group(function(){
    Route::get('admins','index')->name('admins.index');
    Route::get('admins/show/{id}','show')->name('admins.show');
    Route::get('admins/create','create')->name('admins.create');
    Route::post('admins/store','store')->name('admins.store');
    Route::get('admins/edit/{id}','edit')->name('admins.edit');
    Route::put('admins/{id}','update')->name('admins.update');
    Route::delete('admins/delete/{id}','destroy')->name('admins.delete');

});

Route::controller(EditorController::class)->group(function(){
    Route::get('editors','index')->name('editors.index');
    Route::get('editors/show/{id}','show')->name('editors.show');
    Route::get('editors/create','create')->name('editors.create');
    Route::post('editors/store','store')->name('editors.store');
    Route::get('editors/edit/{id}','edit')->name('editors.edit');
    Route::put('editors/{id}','update')->name('editors.update');
    Route::delete('editors/delete/{id}','destroy')->name('editors.delete');

});


Route::controller(PostController::class)->group(function(){
    Route::get('posts','index')->name('posts.index');
    Route::get('posts/show/{id}','show')->name('posts.show');
    Route::get('posts/create','create')->name('posts.create');
    Route::post('posts/store','store')->name('posts.store');
    Route::get('posts/edit/{id}','edit')->name('posts.edit');
    Route::put('posts/{id}','update')->name('posts.update');
    Route::delete('posts/delete/{id}','destroy')->name('posts.delete');

});




