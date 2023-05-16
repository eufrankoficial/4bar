<?php

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('guest')->namespace('Auth')->group(function() {
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('/auth', 'LoginController@login')->name('login.post');

    Route::post('send-link-forgot-password', 'ForgotPasswordController@sendEmail')->name('forgot.password.post');
    Route::get('forgot-password', 'ForgotPasswordController@index')->name('forgot.password');

    Route::post('reset', 'ResetPasswordController@doReset')->name('password.reset.post');
    Route::get('reset', 'ResetPasswordController@form')->name('password.reset');
});


Route::middleware('auth')->group(function() {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    /**
     * Usersr and permissions
     */
    Route::prefix('users')->name('users.')->group(function(){

        // user add
        Route::get('/', 'UserController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'UserController@create')->name('add')->middleware('has_permission:add');
        Route::get('/edit/{user}', 'UserController@edit')->name('edit')->middleware('has_permission:alter');
        Route::get('/delete/{user}', 'UserController@destroy')->name('delete')->middleware('has_permission:delete');
        Route::post('/save', 'UserController@store')->name('save.post')->middleware('has_permission:add');
        Route::post('/save/{user}', 'UserController@update')->name('update.post')->middleware('has_permission:alter');



        //User group
        Route::get('/groups', 'UserGroupController@index')->name('group.index')->middleware('has_permission:list');
        Route::get('/groups/add', 'UserGroupController@create')->name('group.add')->middleware('has_permission:add');
        Route::post('/groups/add', 'UserGroupController@store')->name('group.save.post')->middleware('has_permission:add');
        Route::get('/groups/{group}', 'UserGroupController@edit')->name('group.edit')->middleware('has_permission:alter');
        Route::post('/groups/{group}', 'UserGroupController@update')->name('group.update.post')->middleware('has_permission:alter');
        Route::get('/groups/delete/{group}', 'UserGroupController@destroy')->name('group.delete')->middleware('has_permission:delete');

        //Permissions
        Route::get('permissions', 'PermissionController@index')->name('permission.index')->middleware('has_permission:list');
        Route::get('permissions/add', 'PermissionController@create')->name('permission.add')->middleware('has_permission:add');
        Route::post('permissions/add', 'PermissionController@store')->name('permission.save.post')->middleware('has_permission:add');

        Route::get('permissions/edit/{permission}', 'PermissionController@edit')->name('permission.edit')->middleware('has_permission:alter');
        Route::post('permissions/edit/{permission}', 'PermissionController@update')->name('permission.update.post')->middleware('has_permission:alter');

        Route::get('/permissoins/delete/{permission}', 'PermissionController@destroy')->name('permission.delete')->middleware('has_permission:delete');
    });

    /***
     * Organizations and branchs
     */
    Route::prefix('organizations')->name('orgs.')->group(function() {
       Route::get('/', 'OrganizationController@index')->name('index')->middleware('has_permission:list');

       Route::get('/add', 'OrganizationController@create')->name('add')->middleware('has_permission:add');
       Route::post('/add', 'OrganizationController@store')->name('save.post')->middleware('has_permission:add');


        Route::get('/edit/{organization}', 'OrganizationController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{organization}', 'OrganizationController@update')->name('update.post')->middleware('has_permission:alter');
        Route::get('delete/{organization}', 'OrganizationController@destroy')->name('delete')->middleware('has_permission:delete');

        Route::prefix('{organization}/branchs')->name('branchs.')->group(function(){
            Route::get('/', 'BranchController@index')->name('index')->middleware('has_permission:list');
            Route::get('/add', 'BranchController@create')->name('add')->middleware('has_permission:add');
            Route::post('/add', 'BranchController@store')->name('save.post')->middleware('has_permission:add');

            Route::get('/edit/{branch}', 'BranchController@edit')->name('edit')->middleware('has_permission:alter');
            Route::post('/edit/{branch}', 'BranchController@update')->name('update.post')->middleware('has_permission:alter');

            Route::get('/delete/{branch}', 'BranchController@destroy')->name('delete')->middleware('has_permission:delete');

            /**
             * Calendar.
             */
            Route::prefix('{branch}/calendar')->name('calendar.')->group(function() {
                Route::get('/', 'CalendarController@index')->name('index')->middleware('has_permission:list');
                Route::get('/add', 'CalendarController@create')->name('add')->middleware('has_permission:add');
                Route::post('/add', 'CalendarController@store')->name('save.post')->middleware('has_permission:add');
                Route::get('/edit/{calendar}', 'CalendarController@edit')->name('edit')->middleware('has_permission:alter');
                Route::post('/edit/{calendar}', 'CalendarController@update')->name('update.post')->middleware('has_permission:alter');

                Route::get('/delete/{calendar}', 'CalendarController@destroy')->name('delete')->middleware('has_permission:delete');
            });
        });
    });

    Route::prefix('branchs')->name('branchs.')->group(function(){
        Route::get('/', 'BranchController@index')->name('index');
        Route::get('/add', 'BranchController@create')->name('add');
        Route::post('/add', 'BranchController@store')->name('save.post');

        Route::get('/edit/{branch}', 'BranchController@edit')->name('edit');
        Route::post('/edit/{branch}', 'BranchController@update')->name('update.post');

        Route::get('/delete/{branch}', 'BranchController@destroy')->name('delete');

        /**
         * Calendar.
         */
        Route::prefix('{branch}/calendar')->name('calendar.')->group(function() {
            Route::get('/', 'CalendarController@index')->name('index')->middleware('has_permission:full,calendar.index');
            Route::get('/add', 'CalendarController@create')->name('add')->middleware('has_permission:full,add.calendar');
            Route::post('/add', 'CalendarController@store')->name('save.post')->middleware('has_permission:full,add.calendar');
            Route::get('/edit/{calendar}', 'CalendarController@edit')->name('edit')->middleware('has_permission:full,edit.calendar');
            Route::post('/edit/{calendar}', 'CalendarController@update')->name('update.post')->middleware('has_permission:full,edit.calendar');

            Route::get('/delete/{calendar}', 'CalendarController@destroy')->name('delete')->middleware('has_permission:full,delete.calendar');
        });
    });

    /**
     * Supplier
     */
    Route::prefix('suppliers')->name('supplier.')->group(function() {
        Route::get('/', 'SupplierController@index')->name('index')->middleware('has_permission:supplier.index');
        Route::get('/add', 'SupplierController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'SupplierController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/edit/{supplier}', 'SupplierController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{supplier}', 'SupplierController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/delete/{supplier}', 'SupplierController@destroy')->name('delete')->middleware('has_permission:delete');
    });

    /**
     * Beer types
     */
    Route::prefix('beer-types')->name('beer_type.')->group(function() {
        Route::get('/', 'BeerTypeController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'BeerTypeController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'BeerTypeController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/edit/{beerType}', 'BeerTypeController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{beerType}', 'BeerTypeController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/import', 'BeerTypeController@importNatives')->name('import')->middleware('has_permission:add');
        Route::get('/approve/{beerType}', 'BeerTypeController@approve')->name('approve')->middleware('has_permission:alter');
        Route::get('/delete/{beerType}', 'BeerTypeController@destroy')->name('delete')->middleware('has_permission:delete');
    });


    /***
     * Kegs.
     */
    Route::prefix('kegs')->name('kegs.')->group(function() {
        Route::get('/', 'KegController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'KegController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'KegController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/edit/{keg?}', 'KegController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{keg?}', 'KegController@update')->name('update.post')->middleware('has_permission:alter');
        Route::post('/out-keg/{keg}', 'KegController@outKeg')->name('out')->middleware('has_permission:alter');

        Route::get('/taps/add/{keg}', 'KegController@attrTapToBarrel')->name('taps_add')->middleware('has_permission:add');
        Route::post('/taps/add/{keg}', 'KegController@saveTap')->name('taps_add.post')->middleware('has_permission:add');
        Route::get('/taps/delete/{tap}', 'KegController@deleteTap')->name('delete.tap')->middleware('has_permission:add');
        Route::get('/delete/{keg}', 'KegController@destroy')->name('delete')->middleware('has_permission:delete');
    });

    /**
     * WARNINGS.
     */
    Route::prefix('alerts')->name('alerts.')->group(function() {
        Route::get('/add-keg-alert/{keg?}', 'AlertController@kegAlertAdd')->name('add.keg')->middleware('has_permission:add');
        Route::post('/add-keg-alert/{keg}', 'AlertController@storeAlertKeg')->name('save.keg.post')->middleware('has_permission:add');

        Route::get('/add-cold-chamber-alert/{coldChamber}', 'AlertController@coldChamberAdd')->name('add.cold_chamber')->middleware('has_permission:add');
        Route::post('/add-cold-chamber-alert/{coldChamber}', 'AlertController@storeAlertColdChamber')->name('save.cold_chamber.post')->middleware('has_permission:add');

        Route::get('/delete/{warning}', 'AlertController@destroy')->name('delete');
    });


    /**
     * Pins of kegs.
     */
    Route::prefix('pins')->name('pins.')->group(function() {
        Route::get('/', 'PinKegBranchController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'PinKegBranchController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'PinKegBranchController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/edit/{pinKegBranch}', 'PinKegBranchController@edit')->name('edit')->middleware('has_permission:alter');
        Route::get('/get/{pinKegBranch?}', 'PinKegBranchController@getPin')->name('get')->middleware('has_permission:alter');
        Route::post('/edit/{pinKegBranch}', 'PinKegBranchController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/delete/{pinKegBranch}', 'PinKegBranchController@destroy')->name('delete')->middleware('has_permission:delete');
    });

    /**
     * Sensor types.
     */
    Route::prefix('sensor-type')->name('sensor_type.')->group(function() {
        Route::get('/', 'SensorTypeController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'SensorTypeController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'SensorTypeController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/edit/{sensorType}', 'SensorTypeController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{sensorType}', 'SensorTypeController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/delete/{sensorType}', 'SensorTypeController@destroy')->name('delete')->middleware('has_permission:delete');
    });

    Route::prefix('sensors')->name('sensors.')->group(function() {
        Route::get('/', 'SensorController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'SensorController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'SensorController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/edit/{sensor}', 'SensorController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{sensor}', 'SensorController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/delete/{sensor}', 'SensorController@destroy')->name('delete')->middleware('has_permission:delete');
    });

    /**
     * Menus.
     */
    Route::prefix('menus')->name('menu.')->group(function() {
        Route::get('/', 'MenuController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'MenuController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'MenuController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/edit/{menu}', 'MenuController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{menu}', 'MenuController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/delete/{menu}', 'MenuController@destroy')->name('delete')->middleware('has_permission:delete');
    });

    /**
     * Devices
     */
        Route::prefix('devices')->name('devices.')->group(function() {
        Route::get('/', 'DeviceController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'DeviceController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'DeviceController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/edit/{device}', 'DeviceController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{device}', 'DeviceController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/delete/{device}', 'DeviceController@destroy')->name('delete')->middleware('has_permission:delete');
    });

    Route::prefix('cold-chamber')->name('cold_chamber.')->group(function() {
        Route::get('/', 'ColdChamberController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'ColdChamberController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'ColdChamberController@store')->name('save.post')->middleware('has_permission:add');
        Route::get('/temperature', 'ColdChamberController@temperature')->name('current.temperature');

        Route::get('/edit/{coldChamber}', 'ColdChamberController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{coldChamber}', 'ColdChamberController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/delete/{coldChamber}', 'ColdChamberController@destroy')->name('delete')->middleware('has_permission:delete');

    });

    Route::prefix('taps')->name('taps.')->group(function() {
        Route::get('/', 'TapController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'TapController@create')->name('add')->middleware('has_permission:add');
        Route::get('/actives', 'TapController@getActiveTaps')->name('actives');
        Route::post('/add', 'TapController@store')->name('save.post')->middleware('has_permission:add');
        Route::post('/change-keg', 'TapController@changeKeg')->name('change.keg')->middleware('has_permission:alter');
        Route::post('/assign-barrel/{tap?}/{keg?}', 'TapController@assignBarrel')->name('assign.keg')->middleware('has_permission:alter');

        Route::get('/edit/{tap}', 'TapController@edit')->name('edit')->middleware('has_permission:alter');
        Route::post('/edit/{tap}', 'TapController@update')->name('update.post')->middleware('has_permission:alter');

        Route::get('/delete/{tap}', 'TapController@destroy')->name('delete')->middleware('has_permission:delete');
        Route::post('/realease/{tap?}', 'TapController@realeaseTap')->name('realease.post');
    });

    Route::prefix('maintenance')->name('maintenance.')->group(function() {
        Route::get('/', 'MaintenanceController@index')->name('index')->middleware('has_permission:list');
        Route::get('/add', 'MaintenanceController@create')->name('add')->middleware('has_permission:add');
        Route::post('/add', 'MaintenanceController@store')->name('save.post')->middleware('has_permission:add');

        Route::get('/view/{maintenance}', 'MaintenanceController@show')->name('view')->middleware('has_permission:list');

        Route::get('/delete/{maintenance}', 'MaintenanceController@destroy')->name('delete')->middleware('has_permission:delete');
    });

    /**
     * Change branch.
     */
    Route::get('change-branch/{branch?}', 'ChangeBranchController@change')->name('branch.change');


});





