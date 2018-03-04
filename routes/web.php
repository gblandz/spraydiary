<?php
Route::get('/', function () { return redirect('/admin/home'); });

//Temp reports route..
Route::get('/admin/reports', function() { return view('admin.reports.index'); });

//Greenhouse Routes..
Route::post('/admin/greenhouse/storeblock','GreenhouseController@storeBlock')->name('admin.greenhouse.storeblock');
Route::post('/admin/greenhouse/storeshed','GreenhouseController@storeShed')->name('admin.greenhouse.storeshed');
Route::get('/admin/greenhouse/block/{block}/edit','GreenhouseController@editBlock')->name('admin.greenhouse.block');
Route::get('/admin/greenhouse/shed/{shed}/edit','GreenhouseController@editShed')->name('admin.greenhouse.shed');
Route::post('/admin/greenhouse/block/{block}','GreenhouseController@updateBlock')->name('admin.greenhouse.updateblock');
Route::post('/admin/greenhouse/shed/{shed}','GreenhouseController@updateShed')->name('admin.greenhouse.updateshed');
Route::delete('/admin/greehouse/block/{block}', 'GreenhouseController@destroyBlock')->name('admin.greenhouse.deleteblock');
Route::delete('/admin/greenhouse/shed/{shed}', 'GreenhouseController@destroyShed')->name('admin.greenhouse.deleteshed');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

//Timekeeping save route
Route::post('/insert','TimesController@insert');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::resource('timekeeping', 'TimesController');
    Route::resource('chemicals', 'ChemicalsController');
    Route::resource('tasks', 'TasksController');
    Route::resource('greenhouse', 'GreenhouseController');

});
