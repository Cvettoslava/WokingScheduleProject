<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::post('/contact-us', [App\Http\Controllers\HomeController::class,'saveContact']);
Route::get('/contactUs', [App\Http\Controllers\HomeController::class,'getContact'])->name ('contact');
Route::get('/contacts', [App\Http\Controllers\AdminController::class,'showContacts'])->name ('admin.showContacts');
Route::get('/contactDetails/{contact}', [App\Http\Controllers\AdminController::class,'viewContactDetails'])->name ('admin.contactDetails');

Route::get('/', [App\Http\Controllers\HomeController::class,'welcome'])->name ('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class,'welcome'])->name ('home');

Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/services/{service_id}', [App\Http\Controllers\HomeController::class, 'pickSpecialist'])->name('pickSpecialist');
Route::get('/nail_services', [App\Http\Controllers\HomeController::class,'nailServices'])->name ('nailServices');
Route::get('/hair_services', [App\Http\Controllers\HomeController::class,'hairServices'])->name ('hairServices');
Route::get('/skin_services', [App\Http\Controllers\HomeController::class,'skinServices'])->name ('skinServices');

Route::get('/admin/services', [App\Http\Controllers\HomeController::class, 'index'])->middleware(App\Http\Middleware\AdminMiddleware::class)->name('admin.services');

Route::get('/admin',[App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/admin/showSpecialists',[App\Http\Controllers\AdminController::class, 'showSpecialists'])->name('specialist.showSpecialists');
Route::get('/admin/createSpecialist',[App\Http\Controllers\AdminController::class, 'createSpecialist'])->name('specialist.createSpecialist');
Route::get('/admin/editSpecialist/{specialist}',[App\Http\Controllers\AdminController::class, 'editSpecialist'])->name('specialist.editSpecialist');
Route::get('/admin/updateSpecialist/{specialist}',[App\Http\Controllers\AdminController::class, 'updateSpecialist'])->name('specialist.updateSpecialist');
Route::get('/admin/storeSpecialist',[App\Http\Controllers\AdminController::class, 'storeSpecialist'])->name('specialist.storeSpecialist');
Route::get('/admin/deleteSpecialist/{specialist}',[App\Http\Controllers\AdminController::class, 'deleteSpecialist'])->name('specialist.deleteSpecialist');
Route::get('/admin/destroySpecialist/{specialist}',[App\Http\Controllers\AdminController::class, 'destroySpecialist'])->name('specialist.destroySpecialist');

Route::get('/admin/createService',[App\Http\Controllers\AdminController::class, 'createService'])->name('service.createService');
Route::get('/admin/editService/{service}',[App\Http\Controllers\AdminController::class, 'editService'])->name('service.editService');
Route::get('/admin/updateService/{service}',[App\Http\Controllers\AdminController::class, 'updateService'])->name('service.updateService');
Route::get('/admin/storeService',[App\Http\Controllers\AdminController::class, 'storeService'])->name('service.storeService');
Route::get('/admin/deleteService/{service}',[App\Http\Controllers\AdminController::class, 'deleteService'])->name('service.deleteService');
Route::get('/admin/destroyService/{service}',[App\Http\Controllers\AdminController::class, 'destroyService'])->name('service.destroyService');
Route::get('/admin/session/confirm/{id}', [App\Http\Controllers\AdminController::class, 'confirmSession'])->name('admin.confirmSession');
Route::get('/admin/session/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteSession'])->name('admin.deleteSession');
Route::resource('/admin/schedule', App\Http\Controllers\AdminScheduleController::class);
Route::get('/admin/schedule/{schedule}/delete', [App\Http\Controllers\AdminScheduleController::class, 'delete'])->name('schedule.delete');

Route::get('/schedule/{specialist_id}/{service_id}', [App\Http\Controllers\ScheduleController::class, 'getSchedule'])->name('getSchedule');
Route::post('/schedule', [App\Http\Controllers\ScheduleController::class, 'book'])->middleware('auth')->name('book');