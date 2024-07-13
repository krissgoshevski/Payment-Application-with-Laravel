<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use illuminate\Support\Facades\Log;
use illuminate\Support\Facades\Request;

use Illuminate\Foundation\MixManifestNotFoundException;

Route::get('/', function () {
    return view('app');
});


Route::get('/products', [ProductController::class, 'index']);
Route::post('/purchase', [UserController::class, 'purchase']);


Route::any('/{any}', function (){
    return view('app');
})->where('any', '.*', );
