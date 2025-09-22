<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Tebex Lizenzen
    Route::delete('tebex-lizenzens/destroy', 'TebexLizenzenController@massDestroy')->name('tebex-lizenzens.massDestroy');
    Route::post('tebex-lizenzens/media', 'TebexLizenzenController@storeMedia')->name('tebex-lizenzens.storeMedia');
    Route::post('tebex-lizenzens/ckmedia', 'TebexLizenzenController@storeCKEditorImages')->name('tebex-lizenzens.storeCKEditorImages');
    Route::post('tebex-lizenzens/parse-csv-import', 'TebexLizenzenController@parseCsvImport')->name('tebex-lizenzens.parseCsvImport');
    Route::post('tebex-lizenzens/process-csv-import', 'TebexLizenzenController@processCsvImport')->name('tebex-lizenzens.processCsvImport');
    Route::resource('tebex-lizenzens', 'TebexLizenzenController');

    // Kategorien
    Route::delete('kategoriens/destroy', 'KategorienController@massDestroy')->name('kategoriens.massDestroy');
    Route::post('kategoriens/parse-csv-import', 'KategorienController@parseCsvImport')->name('kategoriens.parseCsvImport');
    Route::post('kategoriens/process-csv-import', 'KategorienController@processCsvImport')->name('kategoriens.processCsvImport');
    Route::resource('kategoriens', 'KategorienController');

    // Item
    Route::delete('items/destroy', 'ItemController@massDestroy')->name('items.massDestroy');
    Route::post('items/parse-csv-import', 'ItemController@parseCsvImport')->name('items.parseCsvImport');
    Route::post('items/process-csv-import', 'ItemController@processCsvImport')->name('items.processCsvImport');
    Route::resource('items', 'ItemController');

    // Fahrzeuge
    Route::delete('fahrzeuges/destroy', 'FahrzeugeController@massDestroy')->name('fahrzeuges.massDestroy');
    Route::post('fahrzeuges/media', 'FahrzeugeController@storeMedia')->name('fahrzeuges.storeMedia');
    Route::post('fahrzeuges/ckmedia', 'FahrzeugeController@storeCKEditorImages')->name('fahrzeuges.storeCKEditorImages');
    Route::post('fahrzeuges/parse-csv-import', 'FahrzeugeController@parseCsvImport')->name('fahrzeuges.parseCsvImport');
    Route::post('fahrzeuges/process-csv-import', 'FahrzeugeController@processCsvImport')->name('fahrzeuges.processCsvImport');
    Route::resource('fahrzeuges', 'FahrzeugeController');

    // Werkbanke
    Route::delete('werkbankes/destroy', 'WerkbankeController@massDestroy')->name('werkbankes.massDestroy');
    Route::post('werkbankes/parse-csv-import', 'WerkbankeController@parseCsvImport')->name('werkbankes.parseCsvImport');
    Route::post('werkbankes/process-csv-import', 'WerkbankeController@processCsvImport')->name('werkbankes.processCsvImport');
    Route::resource('werkbankes', 'WerkbankeController');

    // Shops
    Route::delete('shops/destroy', 'ShopsController@massDestroy')->name('shops.massDestroy');
    Route::post('shops/parse-csv-import', 'ShopsController@parseCsvImport')->name('shops.parseCsvImport');
    Route::post('shops/process-csv-import', 'ShopsController@processCsvImport')->name('shops.processCsvImport');
    Route::resource('shops', 'ShopsController');

    // Support
    Route::delete('supports/destroy', 'SupportController@massDestroy')->name('supports.massDestroy');
    Route::post('supports/media', 'SupportController@storeMedia')->name('supports.storeMedia');
    Route::post('supports/ckmedia', 'SupportController@storeCKEditorImages')->name('supports.storeCKEditorImages');
    Route::post('supports/parse-csv-import', 'SupportController@parseCsvImport')->name('supports.parseCsvImport');
    Route::post('supports/process-csv-import', 'SupportController@processCsvImport')->name('supports.processCsvImport');
    Route::resource('supports', 'SupportController');

    // Datenbank
    Route::delete('datenbanks/destroy', 'DatenbankController@massDestroy')->name('datenbanks.massDestroy');
    Route::post('datenbanks/parse-csv-import', 'DatenbankController@parseCsvImport')->name('datenbanks.parseCsvImport');
    Route::post('datenbanks/process-csv-import', 'DatenbankController@processCsvImport')->name('datenbanks.processCsvImport');
    Route::resource('datenbanks', 'DatenbankController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
