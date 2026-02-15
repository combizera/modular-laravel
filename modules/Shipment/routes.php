<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', fn () => 'Hello from Shipment module!')->name('index');
