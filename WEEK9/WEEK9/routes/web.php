<?php

use App\Http\Controllers\ProgramController;
use App\Models\Program;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/programs');

// CRUD Program: index, create, store, edit, update, destroy
Route::resource('programs', ProgramController::class)->except('show');

// Task 02: uji Eloquent (lihat hasilnya di /uji-eloquent)
Route::get('/uji-eloquent', function () {
    return response()->json([
        'Program::all()'   => Program::all(),    // banyak object
        'Program::find(1)' => Program::find(1),  // satu object
        'Program::count()' => Program::count(),
    ]);
});
