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
/-------------------------------
/AUTH ROUTES
/-------------------------------
*/

//Login karta
$app->post('api/platform/login', 'Auth\AuthController@karta_login');

//Login Comercios
$app->post('api/commerce/login', 'Auth\AuthController@commerce_login');

//Login Usuarios
$app->post('api/client/login', 'Auth\AuthController@client_login');


//password recovery

//Generate a code recovery
$app->post('api/recovery/new-code', 'Auth\RecoveryController@new-code');

//check code
$app->post('api/recovery/check-code', 'Auth\RecoveryController@check-code');

//update password
$app->put('api/recovery/restore', 'Auth\RecoveryController@restore');



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

//Listar Repartidores de comercio

$app->get('api/commerce/{id_commerce}/driver', 'Commerce\StaffController@driver');


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
$app->post('api/client/new-profile', 'Client\ClientController@create');
//Despliega informacion del usuario
$app->get('api/client/{id_client}/profile','Client\ClientController@profile');
//Modifica informacion del usuario
$app->put('api/client/{id_client}/update-profile', 'Client\ClientController@update');


/*****Gestionar Ubicaciones*******/
//Lista las ubicaciones del usuario
$app->get('api/client/{id_client}/location', 'Client\LocationController@index');
//Lista una ubicacion especifica del usuario
$app->get('api/client/{id_client}/location/{id_location}', 'Client\LocationController@detail');
//Crear una ubicacion nueva de usuario
$app->post('api/client/{id_client}/create-location', 'Client\LocationController@create');
//Modificar informacion de ubicacion especifica del usuario
$app->put('api/client/{id_client}/update-location/{id_location}', 'Client\LocationController@update');
//Eliminar una ubicacion del usuario
$app->delete('api/client/{id_client}/delete-location/{id_location}', 'Client\LocationController@delete');


/*****Gestionar Pedidos*******/

//Generar nuevo pedido

$app->post('api/consumer/{id_consumer}/create-request','Consumer\RequestController@create');

//Listar pedidos del cliente

$app->get('api/consumer/{id_consumer}/list-request', 'Consumer\RequestController@search');

//Ver datalle de pedido

$app->get('api/consumer/{id_consumer}/detail-request/{id_request}', 'Consumer\RequestController@detail');



//informacion publica del comercio
$app->get('api/free/commerces/', 'Commerce\CommerceController@freeCommerces');
$app->get('api/free/commerce/detail/{id_commerce}', 'Commerce\CommerceController@freeCommerceDetail');


