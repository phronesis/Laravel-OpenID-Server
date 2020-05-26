<?php

use DavidUmoh\LaravelOpenID\Http\Controllers\DiscoveryController;
use DavidUmoh\LaravelOpenID\Http\Controllers\EndSessionController;
use DavidUmoh\LaravelOpenID\Http\Controllers\JWKController;
use DavidUmoh\LaravelOpenID\Http\Controllers\RevokeTokenController;
use DavidUmoh\LaravelOpenID\Http\Controllers\UserInfoController;

Route::get('/.well-known/openid-configuration', DiscoveryController::class);
Route::get('/oauth/certs', JWKController::class);
Route::get('/userinfo', UserInfoController::class)->middleware('auth:api', 'scope:profile');
Route::post('/oauth/revoke', RevokeTokenController::class);
Route::get('/end_session', EndSessionController::class);
