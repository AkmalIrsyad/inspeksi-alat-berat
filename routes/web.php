<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\InspeksiController;
use App\Http\Controllers\InspektorArtikelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SupervisorInspeksiController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;



Route::get('/',[HomeController::class,'index'])->name('home')->middleware('auth');
Route::get('register',[RegisterController::class,'index'])->name('register');
Route::post('register',[RegisterController::class,'store'])->name('register.store');
Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'proses'])->name('login.proses');
Route::get('login/keluar',[LoginController::class,'keluar'])->name('login.keluar');

// Route::middleware(['auth', 'role:inspector'])->group(function () {
//     Route::get('/inspector', [InspectorController::class, 'index'])->name('inspektor.index');
// });

Route::prefix('inspector')->middleware(['auth', RoleMiddleware::class . ':inspector'])->group(function () {
    Route::get('/dashboard', [InspectorController::class, 'index'])->name('inspektor.index');
    Route::get('/inspeksi',function(){
        return view('inspektor.inspeksi.index');
    })->name('inspeksi');

    Route::get('/inspeksi/create',function(){
        return view('inspektor.inspeksi.create');
    })->name('inspeksi.create');

    Route::get('/inspeksi/{id}', [InspeksiController::class, 'show'])->name('inspeksi.detail');
    Route::get('/inspeksi/{id}/export-pdf',[InspeksiController::class,'exportPdf'])->name('inspector.inspeksi.exportPdf');
    Route::get('/profile/edit', function(){
        return view('inspektor.profile.edit');
    })->name('inspektor.profile.edit');

    Route::get('/artikels', [InspektorArtikelController::class, 'index'])->name('inspektor.artikel.index');
    Route::get('/artikels/{id}', [InspektorArtikelController::class, 'show'])->name('inspektor.artikel.show');

    Route::get('/panduan', function () {
    return view('inspektor.panduan');
    })->name('inspektor.panduan');
});

Route::prefix('supervisor')->middleware(['auth', RoleMiddleware::class . ':supervisor'])->group(function () {
    Route::get('/dashboard', [SupervisorController::class, 'index'])->name('supervisor.index');
    Route::get('/users',function(){
        return view('supervisor.users.index');
    })->name('users');

    Route::get('/alat-berat',function(){
        return view('supervisor.alat-berat.index');
    })->name('alat-berat');

    Route::get('/komponen',function(){
        return view('supervisor.komponen.index');
    })->name('komponen');

    Route::get('/inspeksi', [SupervisorInspeksiController::class, 'index'])->name('supervisor.inspeksi.index');
    Route::post('/inspeksi/{id}/approve', [SupervisorInspeksiController::class, 'approve'])->name('supervisor.inspeksi.approve');
    Route::post('/inspeksi/{id}/cancel',[SupervisorInspeksiController::class,'cancel'])->name('supervisor.inspeksi.cancel');
    Route::get('/inspeksi/{id}/detail',[SupervisorInspeksiController::class,'show'])->name('supervisor.inspeksi.detail');
    Route::get('/inspeksi/{id}/export-pdf',[SupervisorInspeksiController::class,'exportPdf'])->name('supervisor.inspeksi.exportPdf');
    Route::delete('/inspeksi/{id}/destroy', [SupervisorInspeksiController::class, 'destroy'])->name('supervisor.inspeksi.destroy');



    Route::get('/profile/edit', function(){
        return view('supervisor.profile.edit');
    })->name('supervisor.profile.edit');

    // Route::get('/inspeksi/search', \App\Livewire\InspeksiIndex::class)->name('inspeksi.index');

    Route::get('/inspeksi/search',function(){
        return view('supervisor.komponen.index');
    })->name('komponen');

    Route::resource('/artikels', ArtikelController::class);
});

