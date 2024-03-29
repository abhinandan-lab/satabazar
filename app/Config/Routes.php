<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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

// $routes->get('test', 'Home::test');

$routes->get('setAdminDefaults', 'Home::setdefaultAdminCredentials');


$routes->get('forgot-password-confirm', 'Home::adminForgotPasswordConfirm');
$routes->get('forgot-admin-password', 'Home::adminChangePassword');
$routes->post('forgot-admin-password', 'Home::adminForgotAdminPass');


$routes->get('satta-panel/(:num)', 'Home::sattaPanel/$1');
$routes->get('satta-jodi/(:num)', 'Home::sattaJodi/$1');

$routes->post('admin-getnew-password', 'Home::adminGetNewpassword');


// admin routes
$routes->get('adminlogin', 'Home::adminLogin');
$routes->post('adminlogin', 'Home::adminLogin');

$routes->post('verify-login-otp', 'Home::adminVerifyOtpLogin');

$routes->group('', ['filter'=> 'isAdminLoggedin'], function($routes){
    $routes->get('admin', 'Home::admin');

    $routes->get('create', 'Home::adminCreate');
    $routes->post('create', 'Home::adminCreate');

    $routes->get('satta-edit/(:num)', 'Home::adminSattaEdit/$1');
    $routes->post('satta-edit', 'Home::adminSattaEdit');   

    $routes->get('confirm-delete/(:num)', 'Home::adminSattaDeleteConfirmation/$1');
    $routes->get('satta-delete/(:num)', 'Home::adminSattaDelete/$1');
    
    $routes->get('adminsettings', 'Home::adminSettings');
    $routes->post('adminsettings', 'Home::adminSettings');

    $routes->get('admin-change-password', 'Home::adminChangePassword');
    $routes->post('admin-change-password', 'Home::adminChangePassword');

    $routes->get('admin-change-email', 'Home::adminChangeEmail');
    $routes->post('admin-change-email', 'Home::adminChangeEmail');
    
    $routes->get('adminlogout', 'Home::adminLogout');

    $routes->post('admin-verify', 'Home::adminVerifyOtp');
    

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
