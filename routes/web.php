<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControlCardController;


Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/download-control-card-pdf', 
[ControlCardController::class, 'downloadPdf'])->name('control-card.pdf');