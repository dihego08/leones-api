<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

 // SOCIOS
    $router->get('socios', 'SocioController@index');
    $router->get('socios/{id}', 'SocioController@show');
    $router->post('socios', 'SocioController@store');
    $router->put('socios/{id}', 'SocioController@update');
    $router->delete('socios/{id}', 'SocioController@destroy');
    $router->put('/socios/{id}/estado', 'SocioController@editarEstado');

    // CONCEPTOS
    $router->get('conceptos', 'ConceptoController@index');
    $router->post('conceptos', 'ConceptoController@store');
    $router->put('conceptos/{id}', 'ConceptoController@update');
    $router->delete('conceptos/{id}', 'ConceptoController@destroy');
    $router->put('/conceptos/{id}/estado', 'ConceptoController@editarEstado');

    // PAGOS
    $router->get('pagos', 'PagoController@index');
    $router->post('pagos', 'PagoController@store');
    $router->put('pagos/{id}', 'PagoController@update');
    $router->delete('pagos/{id}', 'PagoController@destroy');

    // PERIODICIDAD
    $router->get('periodicidad', 'PeriodicidadController@index');
    $router->post('periodicidad', 'PeriodicidadController@store');
    $router->put('periodicidad/{id}', 'PeriodicidadController@update');
    $router->delete('periodicidad/{id}', 'PeriodicidadController@destroy');
    
    // ESTADO PAGO
    $router->get('estado-pago', 'EstadoPagoController@index');
    $router->post('estado-pago', 'EstadoPagoController@store');
    $router->put('estado-pago/{id}', 'EstadoPagoController@update');
    $router->delete('estado-pago/{id}', 'EstadoPagoController@destroy');
$router->post('/login', 'AuthController@login');
$router->get('/me', ['middleware' => 'auth', 'uses' => 'AuthController@me']);

// GASTOS
    $router->get('gastos', 'GastoController@index');
    $router->post('gastos', 'GastoController@store');
    $router->put('gastos/{id}', 'GastoController@update');
    $router->delete('gastos/{id}', 'GastoController@destroy');

    // TIPO MONEDA
    $router->get('tipo_moneda', 'TipoMonedaController@index');
    $router->post('tipo_moneda', 'TipoMonedaController@store');
    $router->put('tipo_moneda/{id}', 'TipoMonedaController@update');
    $router->delete('tipo_moneda/{id}', 'TipoMonedaController@destroy');

    // REPORTE
    $router->post('reportes/socios_deudores_mes_actual', 'ReporteController@socios_deudores_mes_actual');