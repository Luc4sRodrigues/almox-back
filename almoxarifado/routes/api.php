<?php

use App\Http\Controllers\UserController;
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

// ROTA SIMPLES DE USER
Route::resource('users', UserController::class);

Route::group(["prefix" => "/auth"], function () {
	// ROTAS DE AUTENTICAÇÃO
	Route::post('/login', 'App\Http\Controllers\LoginController@authenticate')->name('login');
	Route::get('/me', 'App\Http\Controllers\LoginController@me');
});

Route::group(['middleware' => 'jwt.auth'], function () {
	// ROTAS DE RECURSOS
	Route::resources([
		'equipments' => 'App\Http\Controllers\EquipmentController',
		'bookings' => 'App\Http\Controllers\BookingController',
	]);

	// ROTAS DE REGRAS DE NEGÓCIO
	Route::group(["prefix" => "/bookings"], function () {
		Route::post('transaction/', 'App\Http\Controllers\BookingController@transaction');
		Route::post('cancel/', 'App\Http\Controllers\BookingController@cancelBooking');
	});
});
