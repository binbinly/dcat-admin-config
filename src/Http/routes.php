<?php

use AdminExtConfig\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource('auth/config', Controllers\AdminConfigController::class)->names('配置管理');
Route::resource('auth/config_group', Controllers\AdminConfigGroupController::class)->names('配置分组');

Route::get('config/{key}', Controllers\AdminConfigValueController::class.'@field');
Route::post('config', Controllers\AdminConfigValueController::class.'@save');
