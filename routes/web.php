<?php

use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/popular-hotel', [HomeController::class, 'seeAll'])->name('popularhotel');
Route::get('/popular-hotel/{slug}', [HomeController::class, 'show'])->name('popularhotel.show');


Route::get('/find-hotel', [BoardingHouseController::class, 'find'])->name('find-hotel');
Route::get('/find-results', [BoardingHouseController::class, 'findResults'])->name('find-hotel.results');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/city/{slug}', [CityController::class, 'show'])->name('city.show');
Route::get('/hotel/{slug}', [BoardingHouseController::class, 'show'])->name('hotel.show');
Route::get('/hotel/{slug}/rooms', [BoardingHouseController::class, 'rooms'])->name('hotel.rooms');

Route::get('/hotel/booking/{slug}/information', [BookingController::class, 'information'])->name('booking.information');
Route::post('/hotel/booking/{slug}/information/save', [BookingController::class, 'saveInformation'])->name('booking.information.save');
Route::get('/hotel/booking/{slug}/', [BookingController::class, 'booking'])->name('booking');

Route::get('/hotel/booking/{slug}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/hotel/booking/{slug}/payment', [BookingController::class, 'payment'])->name('booking.payment');

Route::get('/check-booking', [BookingController::class, 'check'])->name('check-booking');
Route::get('/check-success', [BookingController::class, 'success'])->name('booking.success');
Route::post('/check-booking', [BookingController::class, 'show'])->name('check-booking.show');
