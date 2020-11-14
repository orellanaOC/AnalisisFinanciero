<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
	Route::put('profile/empresa', ['as' => 'profile.empresa', 'uses' => 'ProfileController@empresa']);
});


/* Vistas de prueba (usualmente estaticas)*/
Route::get('/formulas', 'HomeController@formulas')->name('formulas');
Route::get('/analisis_de_sector', 'HomeController@analisis_sector')->name('analisis');
Route::get('/analisis_individual', 'HomeController@empresa_individual')->name('analisis_empresa');
Route::get('/analisis_horizontal', 'HomeController@analisis_horizontal')->name('analisis_horizontal');
Route::get('/ratios', 'HomeController@ratios')->name('ratios');




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
    Route::get('download/excel','CatalogoController@dowloadExcel')->name('catalogo.download');
    Route::post('upload/excel','CatalogoController@uploadExcel')->name('catalogo.upload');
    Route::get('/catalogo/create', 'HomeController@catalogo2')->name('catalogo_prueba_create');
    Route::post('catalogo/deleteall','CatalogoController@BorrarCuentas')->name('cuenta.deleteall');
    Route::post('catalogo/confirmar','CatalogoController@ConfirmarCatalogo')->name('catalogo.confirmar');
    Route::post('catalogo/confirmarVinculacion','CuentaSistemaController@confirmarVinculacion')->name('cuenta.vinculacion');
    Route::get('/catalogo/show', 'CatalogoController@show')->name('catalogo_show');


	//Guardar cuentas de forma manual
	Route::post('/catalogo', 'CatalogoController@store')->name('cuenta_store');
	Route::put('/catalogo','CatalogoController@update')->name('cuenta_update');
    Route::delete('/catalogo/{id}', 'CatalogoController@destroy')->name('cuenta.destroy');



	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- CUENTA-SISTEMA -------------------------------------------*/
	Route::get('/cuenta_sistema', 'CuentaSistemaController@index')->name('cuenta_sistema.index');
	//Vinculacion de cuenta
	Route::post('/cuenta_sistema/{id_cuenta_sistema}', 'CuentaSistemaController@vinculacion')->name('cuenta_sistema.vinculacion');
	Route::delete('/cuenta_sistema_d/{id_cuenta_sistema}', 'CuentaSistemaController@destroy')->name('vinculacion.destroy');
    /*-----------------------------------------------------------------------------------------------------*/
    Route::get('/periodos','PeriodoController@index')->name('periodo.index');
	Route::post('periodo/create','PeriodoController@store')->name('periodo.create');
	Route::delete('periodo/delete/{id}','PeriodoController@destroy')->name('periodo.delete');

	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- BALANCE-GENERAL -------------------------------------------*/
	Route::get('/balance_general_index', 'HomeController@balance_general_index')->name('balance_general_index');
    Route::get('/{id_periodo}/balance_general_create', 'BalanceGeneralController@create')->name('balance_general_create');
    Route::get('balance_general/download/excel','BalanceGeneralController@dowloadExcel')->name('balance_general.download');

	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- ESTADO-RESULTADO -------------------------------------------*/
	Route::get('/estado_resultados_index', 'HomeController@estado_resultado_index')->name('estado_resultado_index');
	Route::get('/{id_periodo}/estado_resultados_create', 'EstadoResultadoController@create')->name('estado_resultado_create');
    Route::post('/{id_periodo}/estado_resultados', 'EstadoResultadoController@store')->name('estado_resultado.store');
    Route::post('estado_resultado/upload/excel/{id_periodo}','EstadoResultadoController@uploadExcel')->name('estado_resultado.upload');
    Route::get('estado_resultado/download/excel','EstadoResultadoController@dowloadExcel')->name('estado_resultado.download');

	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- CUENTA-PERIODO-------------------------------------------*/
	Route::post('cuenta_periodo/{id_periodo}/{cuenta_id}', 'CuentaPerioController@store')->name('cuenta_periodo.store');
	Route::post('cuenta_periodo_p/{id_periodo}/{cuenta_id}', 'CuentaPerioController@storePadre')->name('cuenta_periodo.storePadre');
	Route::delete('cuenta_periodo/{id_periodo}/{cuenta_id}', 'CuentaPerioController@destroy')->name('cuenta_periodo.destroy');
    Route::delete('cuenta_periodo_p/{id_periodo}/{cuenta_id}', 'CuentaPerioController@destroyPadre')->name('cuenta_periodo.destroyPadre');
    Route::post('cuenta_periodo/upload/excel/{id_periodo}/{anio}','CuentaPerioController@uploadExcel')->name('cuenta_periodo.upload');


	/*-----------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- ANALISIS-VERTICAL-------------------------------------------*/
	//padre
	Route::get('/analisis_vertical', 'AnalisisVerticalController@index')->name('analisis_vertical.index');
	//hijo
	Route::get('/{id_periodo}/analisis_vertical', 'AnalisisVerticalController@show')->name('analisis_vertical.show');
	/*--------------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- ANALISIS-HORIZONTAL-------------------------------------------*/
	//padre
	Route::get('/analisis_horizontal', 'AnalisisHorizontalController@index')->name('analisis_horizontal.index');
	//hijo
	Route::get('/{id_periodo1}/{id_periodo2}/analisis_horizontal', 'AnalisisHorizontalController@show')->name('analisis_horizontal.show');
	/*--------------------------------------------------------------------------------------------------------*/

	/*------------------------------------------- RATIOS --------------------------------------------------------*/

	Route::get('/ratio/individual', 'RatioController@individual_padre')->name('ratio.individual_padre');
	Route::get('/ratio/individual/{id_periodo}', 'RatioController@individual')->name('ratio.individual');

	/*--------------------------------------------------------------------------------------------------------*/

	/*------------------------------------ RATIOS POR SECTOR -------------------------------------------------*/

	Route::get('/ratio/sector_calcular/{id_periodo}', 'RatioSectorController@calcular_ratios')->name('ratio_sector.calcular');
	Route::get('/ratio/sector', 'RatioSectorController@sector_padre')->name('ratio_sector.padre');
	Route::get('/ratio/sector/{id_periodo}', 'RatioSectorController@sector')->name('ratio.sector');

	/*--------------------------------------------------------------------------------------------------------*/
});
