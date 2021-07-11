<?php

use Illuminate\Support\Facades\Route;

Route::get('/facturation-pro-form', [\App\Http\Controllers\FacturationProFormController::class, 'index'])->name('facturation-pro-form');

