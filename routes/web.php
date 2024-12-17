<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniqueCodeController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegistrationController::class, 'create'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/cms', [UniqueCodeController::class, 'index']); // Tampilkan CMS
Route::post('/cms/category', [UniqueCodeController::class, 'storeCategory']);
Route::post('/cms/unique-code', [UniqueCodeController::class, 'storeUniqueCode']); // Simpan kode unik
