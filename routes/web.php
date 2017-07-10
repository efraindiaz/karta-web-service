<?php

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

$app->get('/', function () use ($app) {
    return $app->version();
});

/*
/ URIs

/api/ 
/api/platform
/api/commerce
/api/consumer
*/

/*
|--------------------------------------------------------------------------
| Platform
|--------------------------------------------------------------------------
|
| Seccion de plataforma para administrar comercios
| 
| 
|
*/

/*----- Gestionar comercios ------*/
//Listar comercios
$app->get('api/platform/', 'Platform\CommerceController@index');
//Detalle comercio
$app->get('api/platform/detail-commerce/{id_commerce}', 'Platform\CommerceController@detail');
//Modificar informacion de algun comercio
$app->put('api/platform/update-commerce/{id_commerce}', 'Platform\CommerceController@update');
//Eliminar un comercio ---- ESTE YA NO XD
//$app->delete('api/platform/delete-commerce/{id_commerce}', 'Platform\CommerceController@delete');


/*
|--------------------------------------------------------------------------
| Commerce
|--------------------------------------------------------------------------
| Modulo de Comercios
*/

/*****Gestionar Perfil*******/

//Pre suscripcion del comercio
$app->get('api/commerce/subscribe', 'Commerce\CommerceController@subscribe');

//obtener informacion del comercio @@solo admin
$app->get('api/commerce/{id_commerce}', 'Commerce\CommerceController@index');

$app->put('api/commerce/update-commerce/{id_commerce}', 'Commerce\CommerceController@update');

/*****Gestionar Personal*******/
//Lista todo el personal
$app->get('api/commerce/{id_commerce}/staff', 'Commerce\StaffController@index');
//Buscar a un staff en especifico
$app->get('api/commerce/{id_commerce}/search-staff/{id_staff}', 'Commerce\StaffController@search');
//Crear un nuevo staff
$app->post('api/commerce/{id_commerce}/create-staff', 'Commerce\StaffController@create');
//Modificar un staff
$app->put('api/commerce/{id_commerce}/update-staff/{id_staff}', 'Commerce\StaffController@update');
//Eliminar un staff
$app->delete('api/commerce/{id_commerce}/delete-staff/{id_staff}', 'Commerce\StaffController@delete');


/*****Gestionar Productos*******/
//Lista todos los productos
$app->get('api/commerce/{id_commerce}/product','Commerce\ProductController@index');
//Informacion de un producto en especifico
$app->get('api/commerce/{id_commerce}/detail-product/{id_product}','Commerce\ProductController@detail');
//Crea un nuevo producto
$app->post('api/commerce/{id_commerce}/create-product','Commerce\ProductController@create');
//Modifica la Informacion de un producto en especifico
$app->put('api/commerce/{id_commerce}/update-product/{id_product}','Commerce\ProductController@update');
//Eliminar un producto
$app->delete('api/commerce/{id_commerce}/delete-product/{id_product}','Commerce\ProductController@delete');


/*****Gestionar Pedidos*******/
//Lista todos los pedidos
$app->get('api/commerce/{id_commerce}/request', 'Commerce\RequestController@index');
//Lista un pedido en especifico
$app->get('api/commerce/{id_commerce}/search-request/{id_request}', 'Commerce\RequestController@search');
//modifica la informacion de un pedido en especifico
$app->put('api/commerce/{id_commerce}/update-request/{id_request}', 'Commerce@RequestController@search');


/*
|--------------------------------------------------------------------------
| Consumers
|--------------------------------------------------------------------------
| Seccion de plataforma para Consumidores (clientes)
*/

/*****Gestionar Perfil*******/
//Registro de usuario
$app->post('api/consumer/new-profile', 'Consumer\ConsumerController@create');
//Despliega informacion del usuario
$app->get('api/consumer/{id_consumer}/profile','Consumer\ConsumerController@profile');
//Modifica informacion del usuario
$app->put('api/consumer/{id_consumer}/update-profile', 'Consumer\ConsumerController@update');


/*****Gestionar Ubicaciones*******/
//Lista las ubicaciones del usuario
$app->get('api/consumer/{id_consumer}/location', 'Consumer\LocationController@index');
//Lista una ubicacion especifica del usuario
$app->get('api/consumer/{id_consumer}/location/{id_location}', 'Consumer\LocationController@search');
//Crear una ubicacion nueva de usuario
$app->post('api/consumer/{id_consumer}/create-location', 'Consumer\LocationController@create');
//Modificar informacion de ubicacion especifica del usuario
$app->put('api/consumer/{id_consumer}/update-location/{id_location}', 'Consumer\LocationController@update');
//Eliminar una ubicacion del usuario
$app->delete('api/consumer/{id_consumer}/delete-location/{id_location}', 'Consumer\LocationController@delete');


/*****Gestionar Pedidos*******/

//Generar nuevo pedido

$app->post('api/consumer/{id_consumer}/create-request','Consumer\RequestController@create');

//Listar pedidos del cliente

$app->get('api/consumer/{id_consumer}/list-request', 'Consumer\RequestController@search');

//Ver datalle de pedido

$app->get('api/consumer/{id_consumer}/detail-request/{id_request}', 'Consumer\RequestController@detail');




