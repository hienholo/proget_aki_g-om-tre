<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/connextion', [UserController::class, 'connextion']);
Route::get('/regsiter', [UserController::class, 'enregistrement'])->name('regsiter');

//
Route::middleware(['auth'])->group(function () {

    // affichage get
Route::get('/home', [AdminController::class, 'dashbord_1'])->name('home');;
Route::get('/home_Liste_client', [AdminController::class, 'dashbord_2'])->name('Liste_client');
Route::get('/home_modifier_client', [AdminController::class, 'dashbord_3'])->name('Modifier_client');
Route::get('/home_Ajout_document', [AdminController::class, 'dashbord_4'])->name('Ajout_document');
Route::get('/home_Eatat_document', [AdminController::class, 'dashbord_5'])->name('Eatat_document');

//poste
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// gestion client 
Route::post('/store_client',[ClientController::class, 'store'])->name('store_client');
Route::get('/clients/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::post('/clients/update', [ClientController::class, 'update'])->name('clients.update');


});
