<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    $name = "john doe";
    return view ("sample",["name" => $name]);
}); 

Route ::prefix('admin')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::resource('/products', ProductController::class);
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions/import', [TransactionController::class, 'import'])->name('transactions.import');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/export', [TransactionController::class, 'export'])->name('transactions.export');
});



