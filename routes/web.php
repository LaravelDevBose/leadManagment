<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/lead/register', [HomeController::class, 'lead_register'])->name('lead.register');
Route::post('/lead/register', [HomeController::class, 'store_lead_info'])->name('lead.store');
Route::get('/thank-you', [HomeController::class, 'thank_you_page'])->name('thank.you');
Route::post('/contact_us/message/store', [HomeController::class, 'store_contact_us_message'])->name('contact_us.store');
Route::get('/test', [HomeController::class, 'test']);
