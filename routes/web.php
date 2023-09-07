<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemController;
use App\Models\Item;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/items', ItemController::class);
    Route::resource('/systems', SystemController::class);

});




//systems



Route::get('/systems/create', [App\Http\Controllers\SystemController::class, 'create'])->name('systems.create');

Route::post('/systems', [App\Http\Controllers\SystemController::class, 'store'])->name('systems.store');



Route::patch('/items/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('items.update');

Route::delete('items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
Route::inertia('/test', 'Test');

require __DIR__ . '/auth.php';
