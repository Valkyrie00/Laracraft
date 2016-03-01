<?php

Route::get('/laracraft/dashboard',  ['as' => 'laracraft-dashboard', 'uses' => 'Valkyrie\Laracraft\Controllers\DashboardController@index']);

Route::group(['prefix' => 'laracraft/mmc'], function () {
    Route::get('/',  ['as' => 'laracraft-mmc', 'uses' => 'Valkyrie\Laracraft\Controllers\MMController@index']);
    Route::post('create',  ['as' => 'laracraft-mmc', 'uses' => 'Valkyrie\Laracraft\Controllers\MMController@create']);
});

Route::group(['prefix' => '/laracraft/composer'], function () {
    Route::get('/',  ['as' => 'laracraft-composer', 'uses' => 'Valkyrie\Laracraft\Controllers\ComposerController@index']);
    Route::get('/update',  ['as' => 'laracraft-composer-update', 'uses' => 'Valkyrie\Laracraft\Controllers\ComposerController@composerUpdate']);
    Route::get('/install/{name?}',  ['as' => 'laracraft-composer-install', 'uses' => 'Valkyrie\Laracraft\Controllers\ComposerController@composerInstall']);
});

Route::group(['prefix' => '/laracraft/database'], function () {
    Route::get('/',  ['as' => 'laracraft-database', 'uses' => 'Valkyrie\Laracraft\Controllers\DatabaseController@index']);
    Route::get('/migration',  ['as' => 'laracraft-database-migration', 'uses' => 'Valkyrie\Laracraft\Controllers\DatabaseController@migration']);
});

Route::resource('/laracraft/backups', 'Valkyrie\Laracraft\Controllers\BackupController');
Route::group(['prefix' => '/laracraft/backups'], function () {
    Route::get('/',   ['as' => 'laracraft-backups',         'uses' => 'Valkyrie\Laracraft\Controllers\BackupController@index']);
    Route::post('/store',   ['as' => 'laracraft-backups',         'uses' => 'Valkyrie\Laracraft\Controllers\BackupController@store']);
    Route::get('/download/{backupsId}',   ['as' => 'download-bacup',         'uses' => 'Valkyrie\Laracraft\Controllers\BackupController@downloadBackup']);
});