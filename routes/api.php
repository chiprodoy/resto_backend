<?php

use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('product',ProductController::class);
    Route::resource('order',OrderController::class);
    Route::resource('invoice_item',InvoiceItemController::class);
    Route::resource('invoice',InvoiceController::class);
    Route::resource('meja',MejaController::class);

    Route::get('auth/check/',function(Request $request){
        $user = Auth::user();
        $roles = $user->roles;
        $merchants = $user->merchants;
        return response()->json(compact('user'));
    })->name('auth.check');

});

Route::get('/headline', [HeadlineController::class,'index']);

require __DIR__.'/auth.php';
