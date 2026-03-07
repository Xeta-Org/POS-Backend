<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('products', [ProductController::class, 'store']);
Route::put('product/{barcode}', [ProductController::class, 'update']);
Route::delete('product/{barcode}', [ProductController::class, 'delete']);
Route::get('products', [ProductController::class,'get_products']);

Route::post('add-user', [UserController::class, 'add_user']);
Route::put('user/{id}', [UserController::class, 'update_user']);
Route::delete('user/{id}', [UserController::class,'delete_user']);
Route::get('users', [UserController::class, 'get_users']);

Route::post('login', [UserController::class,'login']);
