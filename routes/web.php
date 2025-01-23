<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryCountroller;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;

Route::resource('countries', CountryCountroller::class);
Route::resource('states', StateController::class);
Route::resource('cities', CityController::class);
