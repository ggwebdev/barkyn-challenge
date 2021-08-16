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

$router->group(['prefix' => 'customers'], function () use ($router) {
    $router->get('/', 'CustomerController@index');
    $router->get('/{id}/profile', 'CustomerController@profile');
    $router->get('/{id}/subscription', 'CustomerController@subscription');
    $router->get('/{id}/subscription/dispatch', 'CustomerController@Dispatch');
    $router->get('/{id}/pets', 'CustomerController@pets');
    $router->get('/{id}', 'CustomerController@show');
    $router->post('/', 'CustomerController@store');
    $router->put('/{id}', 'CustomerController@update');
    $router->delete('/{id}', 'CustomerController@destroy');
});

$router->group(['prefix' => 'subscriptions'], function () use ($router) {
    $router->get('/', 'SubscriptionController@index');
    $router->get('/{id}', 'SubscriptionController@show');
    $router->get('/{id}/pets', 'SubscriptionController@pets');
    $router->get('/{id}/dispatch', 'SubscriptionController@dispatch');
    $router->post('/', 'SubscriptionController@store');
    $router->put('/{id}', 'SubscriptionController@update');
    $router->delete('/{id}', 'SubscriptionController@destroy');
});

$router->group(['prefix' => 'pets'], function () use ($router) {
    $router->get('/', 'PetController@index');
    $router->get('/{id}', 'PetController@show');
    $router->get('/{id}/pets', 'PetController@pets');
    $router->post('/', 'PetController@store');
    $router->put('/{id}', 'PetController@update');
    $router->delete('/{id}', 'PetController@destroy');
});