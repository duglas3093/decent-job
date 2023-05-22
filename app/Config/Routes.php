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
// POSTULANT
$routes->get('application_form', 'PostulantController::add');
$routes->post('store_postulant', 'PostulantController::store');

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

    //Postulant
    $routes->get('postulants','BeneficiaryController::postulants');
    $routes->get('info_postulant/(:num)','BeneficiaryController::getPostulant/$1');
    $routes->get('approve_postulant/(:num)','BeneficiaryController::approvePostulant/$1');
    $routes->get('drop_postulant/(:num)','BeneficiaryController::dropPostulant/$1');

    //contacts
    $routes->post('contact_beneficiary','ContactController::contactBeneficiary');
    $routes->post('store_contact','ContactController::store');
    
     // Areas
    $routes->get('areas','AreaController::index');
    $routes->get('add_area','AreaController::add');
    $routes->post('store_area','AreaController::store');
    $routes->get('edit_area/(:num)','AreaController::edit/$1');
    $routes->post('update_area','AreaController::update');
    $routes->get('view_area/(:any)/(:num)','AreaController::view_area/$1/$2');

    // Companies 
    $routes->get('companies','CompanyController::index');
    $routes->get('add_company','CompanyController::add');
    $routes->post('store_company','CompanyController::store');
    $routes->get('edit_company/(:num)','CompanyController::edit/$1');
    $routes->post('update_company','CompanyController::update');
    
    // Activities
    $routes->get('activities','ActivityController::index');
    $routes->get('add_activity','ActivityController::add');
    $routes->post('store_activity','ActivityController::store');
    $routes->get('edit_activity/(:num)','ActivityController::edit/$1');
    $routes->post('update_activity','ActivityController::update');

    // Suports
    $routes->get('supports','SuportController::index');
    $routes->get('add_support','SuportController::add');
    $routes->post('store_support','SuportController::store');
    $routes->get('edit_support/(:num)','SuportController::edit/$1');
    $routes->post('update_support','SuportController::update');

    // Vulnerabilities
    $routes->get('vulnerabilities','VulnerabilityController::index');
    $routes->get('add_vulnerability','VulnerabilityController::add');
    $routes->post('store_vulnerability','VulnerabilityController::store');
    $routes->get('edit_vulnerability/(:num)','VulnerabilityController::edit/$1');
    $routes->post('update_vulnerability','VulnerabilityController::update');
    $routes->post('get_vulnerabilities','VulnerabilityController::vulnerabilyBeneficiary');
    $routes->post('save_vulnerabilities','VulnerabilityController::storeVulnerabilyBeneficiary');

    // KARDEX
    $routes->post('area_beneficiary','KardexController::kardexBeneficiary');
    $routes->post('save_area_beneficiary','KardexController::store');
    $routes->get('kardex_beneficiary/(:num)','KardexController::kardexBeneficiary/$1');
    $routes->get('view_kardex_beneficiary/(:num)','KardexController::viewKardex/$1');
    $routes->get('view_kardex_beneficiary/(:num)/area/(:num)','KardexController::viewKardexArea/$1/$2');
    
    // DET KARDEX
    $routes->post('support_beneficiary','KardexDetailController::supportBeneficiary');
    $routes->post('edit_support_beneficiary','KardexDetailController::edit');
    $routes->post('save_support_beneficiary','KardexDetailController::store');
    $routes->get('kardex_beneficiary','KardexDetailController::kardexBeneficiary');
    $routes->post('delete_activity','KardexDetailController::delete');
    
    $routes->get('reports','ReportController::index');
    $routes->post('get_report','ReportController::getReport');
    
    // COMPROMISE
    $routes->get('compromises','CompromiseController::index');
    $routes->get('edit_compromise/(:num)','CompromiseController::edit/$1');
    $routes->post('update_compromise','CompromiseController::update');
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
