<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\Master\IdentitasController;
use App\Http\Controllers\Master\NavController;
use App\Http\Controllers\Master\JabatanController;
use App\Http\Controllers\Master\DivisiController;
use App\Http\Controllers\Master\PendidikanController;
use App\Http\Controllers\Master\SekolahController;
use App\Http\Middleware\AuthMiddleware;

Route::redirect('/', '/auth/login');

// Auth Login
Route::get('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/generate-captcha', [AuthController::class, 'generateCaptcha']);
Route::post('/auth/login-action', [AuthController::class, 'loginAction']);
Route::get('/auth/logout-action', [AuthController::class, 'logoutAction']);

// Main Menu
Route::middleware([AuthMiddleware::class])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index']);

  // #################### Master ####################
  // - Start Identitas -
  Route::get('/master/identitas', [IdentitasController::class, 'index']);
  Route::post('/master/identitas/save', [IdentitasController::class, 'save']);
  // - End Identitas -

  // - Start Nav -
  Route::get('/master/nav', [NavController::class, 'index']);
  Route::get('/master/nav/form-modal/{id?}', [NavController::class, 'formModal']);
  Route::post('/master/nav/ajax-datatables', [NavController::class, 'ajaxDatatables']);
  Route::post('/master/nav/save/{id?}', [NavController::class, 'save']);
  Route::post('/master/nav/full-access/{id}', [NavController::class, 'fullAccess']);
  Route::delete('/master/nav/delete/{id}', [NavController::class, 'delete']);
  // - End Nav -

  // - Start Jabatan -
  Route::get('/master/jabatan', [JabatanController::class, 'index']);
  Route::get('/master/jabatan/form-modal/{id?}', [JabatanController::class, 'formModal']);
  Route::post('/master/jabatan/ajax-datatables', [JabatanController::class, 'ajaxDatatables']);
  Route::post('/master/jabatan/save/{id?}', [JabatanController::class, 'save']);
  Route::delete('/master/jabatan/delete/{id}', [JabatanController::class, 'delete']);
  // - End Jabatan -

  // - Start Divisi -
  Route::get('/master/divisi', [DivisiController::class, 'index']);
  Route::get('/master/divisi/form-modal/{id?}', [DivisiController::class, 'formModal']);
  Route::post('/master/divisi/ajax-datatables', [DivisiController::class, 'ajaxDatatables']);
  Route::post('/master/divisi/save/{id?}', [DivisiController::class, 'save']);
  Route::delete('/master/divisi/delete/{id}', [DivisiController::class, 'delete']);
  // - End Divisi -

  // - Start Pendidikan -
  Route::get('/master/pendidikan', [PendidikanController::class, 'index']);
  Route::get('/master/pendidikan/form-modal/{id?}', [PendidikanController::class, 'formModal']);
  Route::post('/master/pendidikan/ajax-datatables', [PendidikanController::class, 'ajaxDatatables']);
  Route::post('/master/pendidikan/save/{id?}', [PendidikanController::class, 'save']);
  Route::delete('/master/pendidikan/delete/{id}', [PendidikanController::class, 'delete']);
  // - End Pendidikan -

    // - Start Sekolah -
    Route::get('/master/sekolah', [SekolahController::class, 'index']);
    Route::get('/master/sekolah/form-modal/{id?}', [SekolahController::class, 'formModal']);
    Route::post('/master/sekolah/ajax-datatables', [SekolahController::class, 'ajaxDatatables']);
    Route::post('/master/sekolah/save/{id?}', [SekolahController::class, 'save']);
    Route::delete('/master/sekolah/delete/{id}', [SekolahController::class, 'delete']);
    // - End Sekolah -
  // #################### Master ####################


});
