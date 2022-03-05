<?php

use Illuminate\Support\Facades\Route;
use Monet\Framework\Auth\Http\Controllers\LoginController;
use Monet\Framework\Auth\Http\Controllers\RegisterController;

$routes = config('monet.auth.routes', []);

if (isset($routes['login'])) {
    $route = is_array($routes['login'])
        ? $routes['login']
        : ['path' => $routes['login']];

    Route::get(
        $route['path'],
        data_get($route, 'controller', [LoginController::class, 'show'])
    )
        ->middleware(data_get($route, 'middleware', 'web'))
        ->name('login');
}

if (isset($routes['login.store'])) {
    $route = is_array($routes['login.store'])
        ? $routes['login.store']
        : ['path' => $routes['login.store']];

    Route::post(
        $route['path'],
        data_get($route, 'controller', [LoginController::class, 'store'])
    )
        ->middleware(data_get($route, 'middleware', 'web'))
        ->name('login.store');
}

if (isset($routes['register'])) {
    $route = is_array($routes['register'])
        ? $routes['register']
        : ['path' => $routes['register']];

    Route::get(
        $route['path'],
        data_get($route, 'controller', [RegisterController::class, 'show'])
    )
        ->middleware(data_get($route, 'middleware', 'web'))
        ->name('register');
}

if (isset($routes['register.store'])) {
    $route = is_array($routes['register.store'])
        ? $routes['register.store']
        : ['path' => $routes['register.store']];

    Route::post(
        $route['path'],
        data_get($route, 'controller', [RegisterController::class, 'store'])
    )
        ->middleware(data_get($route, 'middleware', 'web'))
        ->name('register.store');
}