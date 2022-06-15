<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index',['filter' => 'noauth']);
$routes->get('/logout', 'Login::logout',['filter' => 'auth']);
$routes->get('/dashboard', 'Dashboard::index',['filter' => 'auth']);
$routes->get('/chequeo', 'Dashboard::chequeo',['filter' => 'auth']);
$routes->get('/chequeoRecepcion', 'ChequeoRecepcion::nuevoRegistro',['filter' => 'auth']);
$routes->get('/consultas', 'Consultas::show',['filter' => 'auth']);
$routes->get('/tablas', 'Dashboard::tablas',['filter' => 'auth']);

//Mto Articulos
$routes->get('/articulos', 'Articulos::show',['filter' => 'auth']);
$routes->get('/articulos/show', 'Articulos::show',['filter' => 'auth']);
$routes->get('/articulos/edit', 'Articulos::edit',['filter' => 'auth']);
$routes->get('/articulos/new', 'Articulos::edit',['filter' => 'auth']);
$routes->get('/articulos/grabararticulogrupo', 'Articulos::grabarArticuloGrupo',['filter' => 'auth']);
$routes->get('/articulos/grabararticuloitemsformulario', 'Articulos::grabarArticuloItemsFormulario',['filter' => 'auth']);

//Mto Clientes
$routes->get('/clientes', 'Clientes::show',['filter' => 'auth']);
$routes->get('/clientes/show', 'Clientes::show',['filter' => 'auth']);
$routes->get('/clientes/edit', 'Clientes::edit',['filter' => 'auth']);
$routes->get('/clientes/new', 'Clientes::new',['filter' => 'auth']);

//Recibos
$routes->get('/formularios', 'Formularios::show',['filter' => 'auth']);
$routes->get('/formularios/show', 'Formularios::show',['filter' => 'auth']);
$routes->get('/formularios/edit', 'Formularios::edit',['filter' => 'auth']);
$routes->get('/formularios/new', 'Formularios::edit',['filter' => 'auth']);
$routes->get('formularios/agregaritems', 'Formularios::agregarItems',['filter' => 'auth']);

//Mto Bancos
$routes->get('/bancos', 'Bancos::show',['filter' => 'auth']);
$routes->get('/bancos/show', 'Bancos::show',['filter' => 'auth']);
$routes->get('/bancos/edit', 'Bancos::edit',['filter' => 'auth']);
$routes->get('/bancos/new', 'Bancos::new',['filter' => 'auth']);

//Mto Categorias
$routes->get('/categorias', 'Categorias::show',['filter' => 'auth']);
$routes->get('/categorias/show', 'Categorias::show',['filter' => 'auth']);
$routes->get('/categorias/edit', 'Categorias::edit',['filter' => 'auth']);
$routes->get('/categorias/new', 'Categorias::new',['filter' => 'auth']);

//Mto Usuarios
$routes->get('/usuarios', 'Usuarios::show',['filter' => 'auth']);
$routes->get('/usuarios/show', 'Usuarios::show',['filter' => 'auth']);
$routes->get('/usuarios/edit', 'Usuarios::edit',['filter' => 'auth']);
$routes->get('/usuarios/new', 'Usuarios::new',['filter' => 'auth']);


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
