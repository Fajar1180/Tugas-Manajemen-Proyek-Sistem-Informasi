<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpacController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Member;

Route::get('/', [OpacController::class, 'index'])->name('home');
Route::get('/opac', [OpacController::class, 'index'])->name('opac.index');
Route::get('/opac/{book}', [OpacController::class, 'show'])->name('opac.show');

require __DIR__.'/auth.php';

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', Admin\BookController::class);
    Route::resource('categories', Admin\CategoryController::class);
    Route::resource('members', Admin\MemberController::class);
    Route::resource('loans', Admin\LoanController::class)->only(['index','create','store','show']);
    Route::get('/returns/{loan}/create', [Admin\ReturnController::class, 'create'])->name('returns.create');
    Route::post('/returns', [Admin\ReturnController::class, 'store'])->name('returns.store');
    Route::post('/fine-payments', [Admin\FinePaymentController::class, 'store'])->name('fine-payments.store');
    Route::resource('eresources', Admin\EResourceController::class);
});

// Member Routes
Route::prefix('member')->name('member.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Member\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('loans', Member\LoanController::class)->only(['index','show']);
    Route::resource('eresources', Member\EResourceController::class)->only(['index','show']);
});
