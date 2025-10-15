<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\InquiryController;

Route::get('/',         [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::get('/confirm', fn() => redirect()->route('contact.index'));
Route::post('/thanks',  [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks',   [ContactController::class, 'thanks'])->name('contact.thanks');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [InquiryController::class, 'index'])->name('index');
    Route::get('/{contact}', [InquiryController::class, 'show'])->name('show');
    Route::delete('/{contact}', [InquiryController::class, 'destroy'])->name('destroy');
    Route::get('/export', [InquiryController::class, 'export'])->name('export');
});