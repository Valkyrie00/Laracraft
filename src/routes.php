<?php

Route::get('/laracraft/dashboard',  ['as' => 'laracraft-dashboard', 'uses' => 'Valkyrie\Laracraft\Controllers\DashboardController@index']);

Route::get('/laracraft/server/start',  ['as' => 'laracraft-dashboard', 'uses' => 'Valkyrie\Laracraft\Controllers\LaracraftController@startServer']);


Route::group(['prefix' => '/laracraft/base'], function () {
    Route::get('controller',    ['as' => 'laracraft-base-controller', 'uses' => 'Valkyrie\Laracraft\Controllers\Base\ControllerController@index']);
    Route::post('controller',   ['as' => 'laracraft-base-controller', 'uses' => 'Valkyrie\Laracraft\Controllers\Base\ControllerController@save']);

    Route::get('model',         ['as' => 'laracraft-base-model',     'uses' => 'Valkyrie\Laracraft\Controllers\Base\ModelController@index']);
    Route::get('migration',     ['as' => 'laracraft-base-migration', 'uses' => 'Valkyrie\Laracraft\Controllers\Base\MigrationController@index']);

    Route::get('route',         ['as' => 'laracraft-base-route', 'uses' => 'Valkyrie\Laracraft\Controllers\Base\RouteController@index']);
});


Route::group(['prefix' => 'laracraft/creative'], function () {
    Route::get('/',  ['as' => 'laracraft-creative', 'uses' => 'Valkyrie\Laracraft\Controllers\CreativeController@index']);
    Route::post('create',  ['as' => 'laracraft-creative', 'uses' => 'Valkyrie\Laracraft\Controllers\CreativeController@create']);
});

Route::group(['prefix' => '/laracraft/composer'], function () {
    Route::get('/',  ['as' => 'laracraft-composer', 'uses' => 'Valkyrie\Laracraft\Controllers\ComposerController@index']);
    Route::get('/update',  ['as' => 'laracraft-composer-update', 'uses' => 'Valkyrie\Laracraft\Controllers\ComposerController@composerUpdate']);
    Route::get('/install/{name?}',  ['as' => 'laracraft-composer-install', 'uses' => 'Valkyrie\Laracraft\Controllers\ComposerController@composerInstall']);
});

Route::group(['prefix' => 'laracraft/package'], function () {
    Route::get('/',  ['as' => 'laracraft-package', 'uses' => 'Valkyrie\Laracraft\Controllers\PackageController@index']);
    Route::post('create',  ['as' => 'laracraft-package', 'uses' => 'Valkyrie\Laracraft\Controllers\PackageController@create']);
});

Route::group(['prefix' => '/laracraft/database'], function () {
    Route::get('/',  ['as' => 'laracraft-database', 'uses' => 'Valkyrie\Laracraft\Controllers\DatabaseController@index']);
    Route::get('/migration',  ['as' => 'laracraft-database-migration', 'uses' => 'Valkyrie\Laracraft\Controllers\DatabaseController@migration']);
});

Route::group(['prefix' => 'laracraft/routes'], function () {
    Route::get('/',  ['as' => 'laracraft-routes', 'uses' => 'Valkyrie\Laracraft\Controllers\RouteController@index']);
    Route::post('create',  ['as' => 'laracraft-routes', 'uses' => 'Valkyrie\Laracraft\Controllers\RouteController@create']);
});

Route::group(['prefix' => 'laracraft/logs'], function () {
    Route::get('/',  ['as' => 'laracraft-logs', 'uses' => 'Valkyrie\Laracraft\Controllers\LogController@index']);
    Route::post('/',  ['as' => 'laracraft-logs', 'uses' => 'Valkyrie\Laracraft\Controllers\LogController@clearLog']);
});

Route::group(['prefix' => 'laracraft/config'], function () {
    Route::get('/env',  ['as' => 'laracraft-config-env', 'uses' => 'Valkyrie\Laracraft\Controllers\ConfigController@getEnv']);
    Route::post('/env',  ['as' => 'laracraft-config-env', 'uses' => 'Valkyrie\Laracraft\Controllers\ConfigController@postEnv']);
});

Route::resource('/laracraft/backups', 'Valkyrie\Laracraft\Controllers\BackupController');
Route::group(['prefix' => '/laracraft/backups'], function () {
    Route::get('/',   ['as' => 'laracraft-backups',         'uses' => 'Valkyrie\Laracraft\Controllers\BackupController@index']);
    Route::post('/store',   ['as' => 'laracraft-backups',         'uses' => 'Valkyrie\Laracraft\Controllers\BackupController@store']);
    Route::get('/download/{backupsId}',   ['as' => 'download-bacup',         'uses' => 'Valkyrie\Laracraft\Controllers\BackupController@downloadBackup']);
});


//Request data
Route::get('/laracraft/code/getmethods', ['uses' => 'Valkyrie\Laracraft\Controllers\Base\RouteController@getMethods']);