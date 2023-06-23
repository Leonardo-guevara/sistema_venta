<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
 $routes->setAutoRoute(true);


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::login');
$routes->get('unidad', 'Unidad::index');
$routes->get('categoria', 'Categoria::index');
$routes->get('producto', 'Producto::index');
$routes->get('usuario', 'Usuario::index');
// $route['Usuario::login'] = 'login';
$routes->get('login', 'Home::login');
$routes->post('login', 'Home::login');
$routes->get('recover_password', 'Home::recover_password');
$routes->post('recover_password', 'Home::recover_password');

$routes->get('roles', 'Roles::index');
$routes->get('caja', 'Caja::index');
$routes->get('persona', 'Persona::index');
$routes->get('presentacion', 'Presentacion::index');
$routes->get('marca', 'Marca::index');
$routes->get('persona', 'Persona::index');
$routes->get('arqueo', 'Arqueo::index');
$routes->get('inventario', 'Inventario::index');
$routes->get('agregar', 'Inventario::agregar');
$routes->post('agregar', 'Inventario::agregar');
$routes->get('venta', 'Venta::index');
$routes->get('recibo', 'Venta::recibo');
$routes->get('reporte', 'Reporte::index');
// barcode
$routes->get('barcode', 'Home::barcode');

$routes->get('close', 'Home::close_sesion');


// $routes->get('home', 'Home::img');          // Add this line.
// $routes->post('home', 'Home::img');


// Product




/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
