<?php

use Illuminate\Support\Facades\Route;
// use App\Auth;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/actlists/data', 'Admin\ActlistsController@data')->name('admin.actlists.data');
Route::get('/admin/actlists/checInOut', 'Admin\ActlistsController@checInOut')->name('admin.actlists.checInOut');
Route::get('/admin/actlists/fetchActlist', 'Admin\ActlistsController@fetchActlist')->name('admin.actlists.fetchActlist');
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
    Route::resource('/actlists', 'ActlistsController');
    Route::resource('/customers', 'CustomersController');
});


Route::get('/master/accounts/data', 'Master\AccountsController@data')->name('master.accounts.data');
Route::get('/master/accounts/fetch', 'Master\AccountsController@fetch')->name('master.accounts.fetch');
Route::get('/master/accounts/fetch_data', 'Master\AccountsController@fetch_data')->name('master.accounts.fetch_data');
Route::get('/master/contactPersons/fetch', 'Master\ContactPersonsController@fetch')->name('master.contactPersons.fetch');
Route::get('/master/contactPersons/fetch_data', 'Master\ContactPersonsController@fetch_data')->name('master.contactPersons.fetch_data');

Route::get('/master/contactPersons/data', 'Master\ContactPersonsController@data')->name('master.contactPersons.data');
Route::get('/master/leadsScores/getScore', 'Master\leadsScoresController@getScore')->name('master.leadsScores.getScore');

Route::namespace('Master')->prefix('master')->name('master.')->group(function(){
    Route::resource('/statusaccounts', 'StatusaccountsController');
    Route::resource('/accounts', 'AccountsController');
    Route::resource('/contactPersons', 'ContactPersonsController');
    Route::resource('/leadsScores', 'leadsScoresController');
});

// router Transaksi
Route::get('/trans/leads/data', 'Trans\leadsController@data')->name('trans.leads.data');
Route::namespace('Trans')->prefix('trans')->name('trans.')->group(function(){
    Route::resource('/leads', 'leadsController');
    Route::resource('/optys', 'optysController');
    Route::resource('/quots', 'quotsController');
});
