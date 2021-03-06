<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->get('/', 'Login::index');

$routes->get('/login', 'Login::index');
$routes->get('/login/change_password_u', 'Login::change_password_u', ['filter' => 'auth']);
$routes->get('/user', 'User::index', ['filter' => 'auth']);
$routes->get('/teknisi', 'Teknisi::index', ['filter' => 'auth']);
$routes->get('/manager', 'Manager::index', ['filter' => 'auth']);
$routes->get('/admin', 'Admin::index', ['filter' => 'auth']);
$routes->delete('/admin/(:any)', 'Admin::delete/$1');
$routes->delete('/project/(:any)', 'Admin::delete_pjt/$1');
$routes->delete('/customer/(:any)', 'Admin::delete_cs/$1');
$routes->delete('/product/(:any)', 'Admin::delete_pdc/$1');
$routes->delete('/correctword/(:any)', 'Admin::delete_word/$1');
$routes->delete('/edc/(:any)', 'Admin::delete_edc/$1');
$routes->delete('/vocabs/(:any)', 'Admin::delete_vocabs/$1');
// $routes->post('/user/create_ticket', 'User::getCustomer');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
