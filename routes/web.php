<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		//Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
		//Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


/* Vistas de prueba (usualmente estaticas)*/
Route::get('/formulas', 'HomeController@formulas')->name('formulas');
Route::get('/analisis_de_sector', 'HomeController@analisis_sector')->name('analisis');
Route::get('/analisis_individual', 'HomeController@empresa_individual')->name('analisis_empresa');
Route::get('/estado_resultados_index', 'HomeController@estado_resultado_index')->name('estado_resultado_index');
Route::get('/estado_resultados_create', 'HomeController@estado_resultado_create')->name('estado_resultado_create');
Route::get('/balance_general_index', 'HomeController@balance_general_index')->name('balance_general_index');
Route::get('/balance_general_create', 'HomeController@balance_general_create')->name('balance_general_create');


Route::middleware(['auth'])->group(function(){

	/*---------------------------------------------- USUARIO ----------------------------------------------*/

		Route::post('users/store', 'UserController@store')->name('users.store')
		->middleware('has.permission:users.create');
	
		Route::get('users', 'UserController@index')->name('users.index')
		->middleware('has.permission:users.index');
	
		Route::get('users/create', 'UserController@create')->name('users.create')
		->middleware('has.permission:users.create');
	
		Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
		->middleware('has.permission:users.edit');
	
		Route::put('users/{user}', 'UserController@update')->name('users.update')
		->middleware('has.permission:users.edit');
	
		Route::get('users/{user}', 'UserController@show')->name('users.show')
		->middleware('has.permission:users.show');
	
		Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
		->middleware('has.permission:users.destroy');

	/*-----------------------------------------------------------------------------------------------------*/

	/*----------------------------------------------- ROLES -----------------------------------------------*/

		Route::post('roles/store', 'RoleController@store')->name('roles.store')
		->middleware('has.permission:role.create');

		Route::get('roles', 'RoleController@index')->name('roles.index')
		->middleware('has.permission:role.index');

		Route::get('roles/create', 'RoleController@create')->name('roles.create')
		->middleware('has.permission:role.create');

		Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
		->middleware('has.permission:role.edit');

		Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
		->middleware('has.permission:role.show');

		Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
		->middleware('has.permission:role.destroy');

		Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
		->middleware('has.permission:role.edit');

	/*-----------------------------------------------------------------------------------------------------*/

	/*---------------------------------------------- PERMISOS ---------------------------------------------*/

		Route::get('user/permissions/{user}', 'PermissionController@index')->name('permission.index')
		->middleware('has.permission:permission_user.index');

		Route::post('user/permissions/', 'PermissionController@store')->name('permission.store')
		->middleware('has.permission:permission_user.create');

		Route::delete('user/permissions/', 'PermissionController@destroy')->name('permission.destroy')
		->middleware('has.permission:permission_user.destroy');

	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- PERMISO - ROL -------------------------------------------*/

		Route::post('role_permissions/', 'PermissionRoleController@store')->name('role_permission.store')
		->middleware('has.permission:permission_role.create');

		Route::get('role_permissions/{role}', 'PermissionRoleController@index')->name('roles.permissions')
		->middleware('has.permission:permission_role.index');

		Route::delete('role_permissions/', 'PermissionRoleController@destroy')->name('role_permission.destroy')
		->middleware('has.permission:permission_role.destroy');

	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- PERMISO - ROL -------------------------------------------*/

	

	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- PERMISO - ROL -------------------------------------------*/

	

	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- CATALOGO0 ---------------------------------------------*/
	Route::get('/catalogo', 'CatalogoController@index')->name('catalogo_prueba');

	Route::get('/catalogo/create', 'HomeController@catalogo2')->name('catalogo_prueba_create');	

	/*-----------------------------------------------------------------------------------------------------*/
});
