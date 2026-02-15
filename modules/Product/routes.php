<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', fn () => 'Hello from Product module!')->name('index');
