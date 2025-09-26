<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Editor\EditorController;
use App\Http\Controllers\Payment\PaymentController;
Route::get('/', function () {
    return view('auth.login');
});

Route::get('home', function () {
    return view('admin.home');
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

Route::controller(AdminController::class) ->middleware('role:admin')->group(function(){
    Route::get('admins','index')->name('admins.index');
    Route::get('admins/show/{id}','show')->name('admins.show');
    Route::get('admins/create','create')->name('admins.create');
    Route::post('admins/store','store')->name('admins.store');
    Route::get('admins/edit/{id}','edit')->name('admins.edit');
    Route::put('admins/{id}','update')->name('admins.update');
    Route::delete('admins/delete/{id}','destroy')->name('admins.delete');

});

Route::controller(EditorController::class) ->middleware('role:admin')->group(function(){
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
    Route::delete('posts/delete/{id}','destroy')->name('posts.delete')->middleware('role:admin');

});


Route::get("change/{lang}", function ($lang) {


    if ($lang == "en") {
        session()->put("lang", "en");
    } else if ($lang == "ar") {
        session()->put("lang", "ar");
    } else {
        session()->put("lang", "en");
    }

    return redirect()->back();
});




Route::controller(PaymentController::class)->middleware('auth')->group(function () {
    Route::get('payment', 'create')->name('payment.create');
    Route::post('payment-intent', 'createStripePaymentIntent')->name('stripe.paymentIntent.create');
    Route::get('payment/confirm', 'confirm')->name('stripe.return');
});

// Webhook لا يحتاج Middleware
Route::post('stripe/webhook', [PaymentController::class, 'handleWebhook'])->name('stripe.webhook');




