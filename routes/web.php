<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('admin.credentials');
});


Route::get('/index', 'App\Http\Controllers\HomeController@index');

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('admin.credentials');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('states')->name('states/')->group(static function() {
            Route::get('/',                                             'StatesController@index')->name('index');
            Route::get('/create',                                       'StatesController@create')->name('create');
            Route::post('/',                                            'StatesController@store')->name('store');
            Route::get('/{state}/edit',                                 'StatesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'StatesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{state}',                                     'StatesController@update')->name('update');
            Route::delete('/{state}',                                   'StatesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('credentials')->name('credentials/')->group(static function() {
            Route::get('/',                                             'CredentialsController@index')->name('index');
            Route::get('/create',                                       'CredentialsController@create')->name('create');
            Route::post('/',                                            'CredentialsController@store')->name('store');
            Route::get('/{credential}/edit',                            'CredentialsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CredentialsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{credential}',                                'CredentialsController@update')->name('update');
            Route::delete('/{credential}',                              'CredentialsController@destroy')->name('destroy');
        });
    });
});
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('credentials')->name('credentials/')->group(static function() {
            Route::get('/', 'CredentialsController@index')->name('index');
            Route::get('/create', 'CredentialsController@create')->name('create');
            Route::post('/', 'CredentialsController@store')->name('store');
            Route::get('/{credential}/edit', 'CredentialsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CredentialsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{credential}', 'CredentialsController@update')->name('update');
            Route::delete('/{credential}', 'CredentialsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('services')->name('services/')->group(static function() {
            Route::get('/',                                             'ServicesController@index')->name('index');
            Route::get('/create',                                       'ServicesController@create')->name('create');
            Route::post('/',                                            'ServicesController@store')->name('store');
            Route::get('/{service}/edit',                               'ServicesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ServicesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{service}',                                   'ServicesController@update')->name('update');
            Route::delete('/{service}',                                 'ServicesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('categories')->name('categories/')->group(static function() {
            Route::get('/',                                             'CategoriesController@index')->name('index');
            Route::get('/create',                                       'CategoriesController@create')->name('create');
            Route::post('/',                                            'CategoriesController@store')->name('store');
            Route::get('/{category}/edit',                              'CategoriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CategoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{category}',                                  'CategoriesController@update')->name('update');
            Route::delete('/{category}',                                'CategoriesController@destroy')->name('destroy');
        });
    });
});
