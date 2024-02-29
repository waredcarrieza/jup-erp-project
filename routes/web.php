<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\InventoriController;

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

Route::get('/', [UserController::class, 'signin']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::prefix('/customer')->group(function () {
	Route::get('/', [CustomerController::class, 'index']);
	Route::get('/create', [CustomerController::class, 'create']);
	Route::get('/delete/{id}', [CustomerController::class, 'delete']);
	Route::get('/detail/{id}', [CustomerController::class, 'detail']);
	Route::get('/edit/{id}', [CustomerController::class, 'edit']);
	Route::post('/insert', [CustomerController::class, 'insert']);
	Route::post('/update', [CustomerController::class, 'update']);
});

Route::prefix('/car')->group(function () {
	Route::get('/', [CarController::class, 'index']);
	Route::get('/create', [CarController::class, 'create']);
	Route::get('/delete/{id}', [CarController::class, 'delete']);
	Route::get('/detail/{id}', [CarController::class, 'detail']);
	Route::get('/edit/{id}', [CarController::class, 'edit']);
	Route::post('/insert', [CarController::class, 'insert']);
	Route::post('/update', [CarController::class, 'update']);
});

Route::prefix('/rent')->group(function () {
	Route::get('/', [RentController::class, 'index']);
	Route::get('/create', [RentController::class, 'create']);
	Route::post('/check_car_availability_by_date', [RentController::class, 'check_car_availability_by_date']);
	Route::post('/get_nums_between_date', [RentController::class, 'get_nums_between_date']);
	Route::post('/insert', [RentController::class, 'insert']);
	Route::get('/detail/{id}', [RentController::class, 'detail']);
	Route::get('/edit/{id}', [RentController::class, 'edit']);
	Route::post('/update', [RentController::class, 'update']);
});

Route::prefix('/user')->group(function () {
	Route::get('/', [UserController::class, 'index']);
	Route::get('/signin', [UserController::class, 'signin']);
	Route::post('/login', [UserController::class, 'login']);
	Route::get('/logout', [UserController::class, 'logout']);
});

Route::prefix('/produk')->group(function () {
	Route::get('/', [ProdukController::class, 'index']);
	Route::get('/create', [ProdukController::class, 'create']);
	Route::get('/delete/{id}', [ProdukController::class, 'delete']);
	Route::get('/detail/{id}', [ProdukController::class, 'detail']);
	Route::get('/edit/{id}', [ProdukController::class, 'edit']);
	Route::post('/insert', [ProdukController::class, 'insert']);
	Route::post('/update', [ProdukController::class, 'update']);
});

Route::prefix('/kategori')->group(function () {
	Route::get('/', [KategoriController::class, 'index']);
	Route::get('/create', [KategoriController::class, 'create']);
	Route::get('/delete/{id}', [KategoriController::class, 'delete']);
	Route::get('/detail/{id}', [KategoriController::class, 'detail']);
	Route::get('/edit/{id}', [KategoriController::class, 'edit']);
	Route::post('/insert', [KategoriController::class, 'insert']);
	Route::post('/update', [KategoriController::class, 'update']);
});

Route::prefix('/inventori')->group(function () {
	Route::get('/', [InventoriController::class, 'index']);
	Route::get('/create', [InventoriController::class, 'create']);
	Route::get('/delete/{id}', [InventoriController::class, 'delete']);
	Route::get('/detail/{id}', [InventoriController::class, 'detail']);
	Route::get('/edit/{id}', [InventoriController::class, 'edit']);
	Route::get('/getproducts', [InventoriController::class, 'getproducts']);
	Route::post('/insert', [InventoriController::class, 'insert']);
	Route::post('/update', [InventoriController::class, 'update']);
});