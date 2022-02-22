<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Redirect');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('admin/redirect', function ($routes) {
    $routes->add('', 'Admin\Redirect::index');
    $routes->add('add', 'Admin\Redirect::index');
    $routes->add('insert', 'Admin\Redirect::index');
    $routes->add('insert_validation', 'Admin\Redirect::index');
    $routes->add('edit/(:num)', 'Admin\Redirect::index');
    $routes->add('update_validation/(:num)', 'Admin\Redirect::index');
    $routes->add('update/(:num)', 'Admin\Redirect::index');
    $routes->add('success/(:num)', 'Admin\Redirect::index');
    $routes->add('delete/(:num)', 'Admin\Redirect::index');
    $routes->add('ajax_list_info', 'Admin\Redirect::index');
    $routes->add('ajax_list', 'Admin\Redirect::index');
    $routes->add('export', 'Admin\Redirect::index');
});

$routes->get('login', 'Auth\login', ['as' => 'login']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
