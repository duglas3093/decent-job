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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('auth',['namespace'=>'App\Controllers\Auth'],function($routes){
    $routes->get('register','Register::index',['as'=>'register']);
    $routes->post('store','Register::store');
    $routes->get('login','Login::index',['as'=>'login']);
    $routes->post('check','Login::signin',['as'=>'signin']);
    $routes->get('logout', 'Login::signout',['as'=>'signout']);
});

$routes->group('admin',['namespace' => 'App\Controllers\admin','filter'=>'auth:admin'],function($routes){
    //Dashboard
    $routes->get('dashboard','Dashboard::index');

    // Users
    $routes->get('users','UserController::index');
    $routes->get('add_user','UserController::add');
    $routes->post('store_user','UserController::store');
    $routes->get('edit_user/(:num)','UserController::edit/$1');
    $routes->post('update_user','UserController::update');

    // Beneficiary
    $routes->get('beneficiaries','BeneficiaryController::index');
    $routes->get('add_beneficiary','BeneficiaryController::add');
    $routes->post('store_beneficiary','BeneficiaryController::store');
    $routes->get('edit_beneficiary/(:num)','BeneficiaryController::edit/$1');
    $routes->post('update_beneficiary','BeneficiaryController::update');
});
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
