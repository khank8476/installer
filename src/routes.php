<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Kamrankhandev\Installer')->group(function () {
    Route::controller('InstallerController')->name('install.')->prefix('install')->group(function () {
        Route::middleware(['web','Kamrankhandev\Installer\InstallerMiddleware'])->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('requirements', 'requirements')->name('requirements');
            Route::get('permissions', 'permissions')->name('permissions');
            Route::get('database', 'database')->name('database');
            Route::get('account', 'account')->name('account');
            Route::post('database', 'storeConfig');
            Route::post('account', 'storeDatabase');
        });
        Route::get('complete', 'complete')->name('complete');
    });
});
