<?php

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

Route::get('/go', function () {
    return view('welcome');
});

Auth::routes();
//Auth Routed
Route::post('loginUser', [App\Http\Controllers\AuthController::class, 'loginUser'])->name('loginUser');
Route::get('profile', [App\Http\Controllers\AuthController::class, 'profile']);
Route::get('update', [App\Http\Controllers\AuthController::class, 'updateUserinfo']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//support routes
Route::get('support', [App\Http\Controllers\SupportController::class, 'index']);
Route::get('addUser', [App\Http\Controllers\SupportController::class, 'addUser']);
Route::get('editUser', [App\Http\Controllers\SupportController::class, 'editUser']);
Route::get('resetPassword', [App\Http\Controllers\SupportController::class, 'passwordReset']);
Route::get('postEdit', [App\Http\Controllers\SupportController::class, 'postEdit']);
Route::get('deleteUser', [App\Http\Controllers\SupportController::class, 'deleteUser']);
//backend routes
Route::get('/', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('dashboard', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('products', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('storeProducts', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct');
Route::get('getProducts', [App\Http\Controllers\ProductController::class, 'getProduct']);
Route::get('deleteProducts', [App\Http\Controllers\ProductController::class, 'deleteProducts']);
Route::post('editProduct', [App\Http\Controllers\ProductController::class, 'editProduct'])->name('editProduct');
Route::get('purchase', [App\Http\Controllers\PurchaseController::class, 'index']);
Route::get('sales', [App\Http\Controllers\SaleController::class, 'index']);
Route::get('getPurchaseProduct', [App\Http\Controllers\PurchaseController::class, 'getPurchaseProduct']);
Route::get('purchaseTable', [App\Http\Controllers\PurchaseController::class, 'purchaseTable']);
Route::get('total', [App\Http\Controllers\PurchaseController::class, 'total']);
Route::get('editPurchase', [App\Http\Controllers\PurchaseController::class, 'editPurchase']);
Route::get('ePurchase', [App\Http\Controllers\PurchaseController::class, 'ePurchase']);
Route::get('startOver', [App\Http\Controllers\PurchaseController::class, 'startOver']);
Route::get('resume', [App\Http\Controllers\PurchaseController::class, 'resume']);
Route::get('sold', [App\Http\Controllers\SaleController::class, 'sold']);
Route::get('recordSale', [App\Http\Controllers\SoldController::class, 'recordSale']);
Route::get('records', [App\Http\Controllers\SoldController::class, 'index']);
Route::get('filterRecord', [App\Http\Controllers\SoldController::class, 'filterRecord']);
Route::get('filterPrice', [App\Http\Controllers\SoldController::class, 'filterPrice']);
Route::get('filterProfit', [App\Http\Controllers\SoldController::class, 'filterProfit']);
Route::get('filterHeader', [App\Http\Controllers\SoldController::class, 'filterHeader']);
Route::get('filterExpense', [App\Http\Controllers\SoldController::class, 'filterExpense']);
Route::get('finalProfit', [App\Http\Controllers\SoldController::class, 'finalProfit']);
Route::get('expenses', [App\Http\Controllers\ExpensesController::class, 'expenses']);
Route::post('addExpense', [App\Http\Controllers\ExpensesController::class, 'addExpense'])->name('addExpense');
Route::get('deleteExpense', [App\Http\Controllers\ExpensesController::class, 'deleteExpense']);
Route::get('belowThree', [App\Http\Controllers\ProductController::class, 'belowThree']);
