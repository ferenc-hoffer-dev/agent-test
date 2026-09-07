<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return 'Laravel API is running';
});

Route::get('/health', function () {
    return response('OK', 200);
});






