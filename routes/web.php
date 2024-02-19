<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ItemController;
use App\Models\Sale;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Redirect::to('/dashboard');
});

Route::get('/add-items', function (Request $request) {
    return view('items-create-forms');
})->middleware(['auth', 'verified'])->name('add-items');

Route::get('/dashboard', function (Request $request) {

    $sale = Sale::all();

    if ($sale == null) {
        return Redirect::route('sale.create');
    }

    return view('dashboard')->with('sale', $sale)
        ->with('total', array_sum($sale->sales_line_item()->pluck('total')->all()))
        ->with('sale_items', $sale->sales_line_item()->get())
        ->with('stock', ItemController::get_available_items());







})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/add-items', [ItemController::class, 'create_item'])->name('add-items');
    Route::patch('/item', [ItemController::class, 'update_item'])->name('item.update');
    Route::post('/item', [ItemController::class, 'delete_item'])->name('item.delete');


    Route::get('/sale/open', [SaleController::class, 'open_sale'])->name('sale.open');
    Route::get('/dashboard', [SaleController::class, 'index'])->name('dashboard');

    Route::get('/sale/{id}', function ($id) {
        $sale = Sale::find($id);
        return view('sale')->with('sale', $sale)
            ->with('total', $sale->salesLineItems()->sum('total'))
            ->with('sale_items', $sale->salesLineItems()->get())
            ->with('stock', ItemController::get_available_items());
    })->name('sale');

    Route::get('/items', function () {
        return view('items')->with('items', ItemController::get_available_items());
    })->name('items');






    Route::post('/sale', [SaleController::class, 'remove_sale'])->name('sale.delete');

    Route::get('/add_line_item', [SaleController::class, 'create_sale_lines_item'])->name('saleLineItem.create');
    Route::delete('/delete_item', [SaleController::class, 'remove_sale_lines_item'])->name('saleLineItem.delete');




});

require __DIR__ . '/auth.php';
