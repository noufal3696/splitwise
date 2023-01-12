<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ExpenseController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/groups', [GroupController::class, 'index'])->name('group');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/groups/store', [GroupController::class, 'store'])->name('group.store');
    Route::get('/groups/{id}', [GroupController::class, 'edit'])->name('group.edit');
    Route::get('/groups/{id}/show', [GroupController::class, 'show'])->name('group.show');
    Route::post('/groups/{id}/update', [GroupController::class, 'update'])->name('group.update');
    Route::get('/groups/{id}/destroy', [GroupController::class, 'destroy'])->name('group.destroy');
    Route::post('/groups/{id}/add-user', [GroupController::class, 'addUser'])->name('group.add-user');
    Route::get('/groups/{id}/destroy-user/{user_id}', [GroupController::class, 'destroyUser'])
        ->name('group.destroy-user');
    Route::post('/groups/{id}/add-expense', [GroupController::class, 'addExpense'])->name('group.add-expense');
    Route::get('/groups/{id}/destroy-expense/{expense_id}', [GroupController::class, 'destroyExpense'])
        ->name('group.destroy-expense');

});

require __DIR__ . '/auth.php';
