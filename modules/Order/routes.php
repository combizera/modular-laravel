<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', fn () => 'Hello from Order module!')->name('index');