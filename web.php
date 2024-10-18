<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/admindashboard', function () {
    return view('admin.dashboard');
})->middleware(['admin'])->name('admin.dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::get('/user', [BusController::class, 'index'])->name('home')->middleware("user");

// Search and booking routes
Route::post('/search-buses', [BusController::class, 'search'])->name('bus.search')->middleware("user");
Route::get('/book-seat/{busId}', [BusController::class, 'bookSeat'])->name('bus.book')->middleware("user");
Route::post('/confirm-booking', [BookingController::class, 'confirmBooking'])->name('bus.confirm')->middleware("user");

// User bookings
Route::get('/my-bookings', [BookingController::class, 'userBookings'])->name('user.bookings')->middleware("user");

Route::get('/deleteall', [BookingController::class, 'reverseseat'])->middleware("user");

// Admin routes (for managing buses, routes, etc.)
Route::middleware(['auth', 'admin'])->group(function() {
    Route::resource('admin/buses', BusController::class);
});



Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/create-route', [RouteController::class, 'create'])->name('create-route');
    Route::post('/store-route', [RouteController::class, 'store'])->name('store-route');

    Route::get('/admindash',function(){
        return view("display.admindashboard");
    })->name("adminhome");

    Route::get('/create-route',function(){
     return view("showbus")->name('create-route');
    });

});


require __DIR__.'/auth.php';
