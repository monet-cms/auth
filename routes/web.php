<?php

use Illuminate\Support\Facades\Route;
use Monet\Framework\Auth\Http\Controllers\LoginController;

$routes = config('monet.auth.routes', []);

if (isset($routes['login'])) {
    $route = is_array($routes['login'])
        ? $routes['login']
        : ['path' => $routes['login']];

    Route::get(
        $route['path'],
        data_get($route, 'controller', [LoginController::class, 'show'])
    )
        ->middleware(data_get($route, 'middleware', []))
        ->name('login');
}

if (isset($routes['login.store'])) {
    $route = is_array($routes['login.authenticate'])
        ? $routes['login.authenticate']
        : ['path' => $routes['login.authenticate']];

    Route::post(
        $route['path'],
        data_get($route, 'controller', [LoginController::class, 'store'])
    )
        ->middleware(data_get($route, 'middleware', []))
        ->name('login.authenticate');
}