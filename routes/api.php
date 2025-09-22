<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Team
    Route::apiResource('teams', 'TeamApiController');

    // Tebex Lizenzen
    Route::post('tebex-lizenzens/media', 'TebexLizenzenApiController@storeMedia')->name('tebex-lizenzens.storeMedia');
    Route::apiResource('tebex-lizenzens', 'TebexLizenzenApiController');

    // Kategorien
    Route::apiResource('kategoriens', 'KategorienApiController');

    // Item
    Route::apiResource('items', 'ItemApiController');

    // Fahrzeuge
    Route::post('fahrzeuges/media', 'FahrzeugeApiController@storeMedia')->name('fahrzeuges.storeMedia');
    Route::apiResource('fahrzeuges', 'FahrzeugeApiController');

    // Werkbanke
    Route::apiResource('werkbankes', 'WerkbankeApiController');

    // Shops
    Route::apiResource('shops', 'ShopsApiController');

    // Support
    Route::post('supports/media', 'SupportApiController@storeMedia')->name('supports.storeMedia');
    Route::apiResource('supports', 'SupportApiController');

    // Datenbank
    Route::apiResource('datenbanks', 'DatenbankApiController');
});
