<?php

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

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('clients', 'ClientsController');
    Route::resource('services', 'ServicesController');
    Route::resource('jobs', 'JobsController');

    Route::get('reports', 'ReportsController@index')->name('reports.index');
    Route::get('reports/week', 'ReportsController@week')->name('reports.week');
    Route::get('reports/month', 'ReportsController@month')->name('reports.month');
    Route::post('reports', 'ReportsController@generate')->name('reports.generate');
    Route::get('reports/{year}/{month}/{service?}', 'ReportsController@show')->name('reports.show');
});

Route::get('/', function () {
    return view('welcome');
})->name('frontpage');

Auth::routes();
