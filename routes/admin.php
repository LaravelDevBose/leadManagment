<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\ContactUsMessageController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth:sanctum', 'verified'], 'prefix'=>'admin', 'as'=>'admin.'],function (){
    Route::get('/dashboard', [HomeController::class ,'index'])->name('dashboard');
    Route::get('/lead/index', [LeadController::class ,'index'])->name('lead.index');
    Route::get('/lead/table', [LeadController::class ,'table'])->name('lead.table');
    Route::get('/lead/{lead_id}', [LeadController::class ,'show'])->name('lead.show');

    Route::post('/personal_info/{lead_id}/update',      [LeadController::class, 'updatePersonalInfo'])->name('personal.update');
    Route::post('/vehicle_info/{lead_id}/update',       [LeadController::class, 'updateVehicleInfo'])->name('vehicle.update');
    Route::post('/transaction_info/{lead_id}/update',   [LeadController::class, 'updateTransactionInfo'])->name('transaction.update');
    Route::post('/special_req/{lead_id}/update',        [LeadController::class, 'updateSpecialReqInfo'])->name('special_req.update');

    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);

    Route::get('contact_us/messages', [ContactUsMessageController::class, 'index'])->name('contact_us.message.index');
    Route::delete('contact_us/message/{id}', [ContactUsMessageController::class, 'destroy'])->name('contact_us.message.delete');

    Route::get('/calender', [CalendarController::class, 'index'])->name('calender.index');
    Route::post('/schedule/store', [CalendarController::class, 'store'])->name('schedule.store');
    Route::put('/schedule/{id}/update', [CalendarController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{id}', [CalendarController::class, 'destroy'])->name('schedule.destroy');

    Route::get('/about_us', [SettingController::class, 'about_us_page'])->name('about_us.page');
    Route::post('/about_us/update', [SettingController::class, 'about_us_update'])->name('about_us.update');
    Route::get('/contact_us', [SettingController::class, 'contact_us_page'])->name('contact_us.page');
    Route::post('/contact_us/update', [SettingController::class, 'contact_us_update'])->name('contact_us.update');

    Route::resource('users', AdminController::class);
});
