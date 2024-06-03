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
$routes->get('/', 'Reseller\Home::index');
$routes->get('/dashboard', 'Reseller\Home::index');
$routes->get('/login', 'Reseller\Login::index');
$routes->post('/login', 'Reseller\Login::index');
$routes->get('/logout', 'Reseller\Login::logout');
$routes->get('/change-password', 'Reseller\User::change_password');
$routes->post('/change-password', 'Reseller\User::change_password');
$routes->get('/order', 'Reseller\Order::index');
$routes->post('/order/create', 'Reseller\Order::create');
$routes->get('/my_orders', 'Reseller\Order::my_orders');
$routes->get('/order/view/(:num)', 'Reseller\Order::view/$1');
$routes->get('/balance', 'Reseller\Balance::index');

// Admin Routes
$routes->group('admin', function ($routes) {
    // resellers
    $routes->get('resellers', 'Admin\Resellers::index');
    $routes->get('resellers/create', 'Admin\Resellers::create');
    $routes->post('resellers/create', 'Admin\Resellers::create');
    $routes->get('resellers/edit/(:num)', 'Admin\Resellers::edit/$1');
    $routes->post('resellers/edit/(:num)', 'Admin\Resellers::edit/$1');
    $routes->delete('resellers/delete/(:num)', 'Admin\Resellers::delete/$1');
    $routes->get('resellers/list/(:num)', 'Admin\Resellers::list/$1');
    $routes->get('resellers/view/(:num)', 'Admin\Resellers::view/$1');

    // orders
    $routes->get('orders', 'Admin\Orders::index');
    $routes->get('orders/view/(:num)', 'Admin\Orders::view/$1');
    $routes->get('orders/edit/(:num)', 'Admin\Orders::edit/$1');
    $routes->post('orders/edit/(:num)', 'Admin\Orders::edit/$1');
    $routes->delete('orders/delete/(:num)', 'Admin\Orders::delete/$1');

    // price management
    $routes->get('price-management', 'Admin\PriceManagement::index');
    $routes->get('price-profiles/add', 'Admin\PriceProfiles::add');
    $routes->post('price-profiles/add', 'Admin\PriceProfiles::add');
    $routes->get('price-management/add/(:num)', 'Admin\PriceManagement::add/$1');
    $routes->post('price-management/add/(:num)', 'Admin\PriceManagement::add/$1');
    $routes->get('price-management/view/(:num)', 'Admin\PriceManagement::view/$1');
    $routes->get('price-management/view_price/(:num)', 'Admin\PriceManagement::view_price/$1');
    $routes->get('price-management/edit_price/(:num)', 'Admin\PriceManagement::edit_price/$1');
    $routes->post('price-management/edit_price/(:num)', 'Admin\PriceManagement::edit_price/$1');
    $routes->delete('price-management/delete/(:num)', 'Admin\PriceManagement::delete/$1');
    $routes->get('price-profiles/edit/(:num)', 'Admin\PriceProfiles::edit/$1');
    $routes->post('price-profiles/edit/(:num)', 'Admin\PriceProfiles::edit/$1');
    $routes->delete('price-profiles/delete/(:num)', 'Admin\PriceProfiles::delete/$1');

    // frame size management
    $routes->get('frame-sizes', 'Admin\FrameSizes::index');
    $routes->get('frame-sizes/add', 'Admin\FrameSizes::add');
    $routes->post('frame-sizes/add', 'Admin\FrameSizes::add');
    $routes->get('frame-sizes/edit/(:num)', 'Admin\FrameSizes::edit/$1');
    $routes->post('frame-sizes/edit/(:num)', 'Admin\FrameSizes::edit/$1');
    $routes->delete('frame-sizes/delete/(:num)', 'Admin\FrameSizes::delete/$1');

    // frame colors management
    $routes->get('frame-colors', 'Admin\FrameColors::index');
    $routes->get('frame-colors/add', 'Admin\FrameColors::add');
    $routes->post('frame-colors/add', 'Admin\FrameColors::add');
    $routes->get('frame-colors/edit/(:num)', 'Admin\FrameColors::edit/$1');
    $routes->post('frame-colors/edit/(:num)', 'Admin\FrameColors::edit/$1');
    $routes->delete('frame-colors/delete/(:num)', 'Admin\FrameColors::delete/$1');

    // region management
    $routes->get('regions', 'Admin\Regions::index');
    $routes->get('regions/add', 'Admin\Regions::add');
    $routes->post('regions/add', 'Admin\Regions::add');
    $routes->get('regions/edit/(:num)', 'Admin\Regions::edit/$1');
    $routes->post('regions/edit/(:num)', 'Admin\Regions::edit/$1');
    $routes->delete('regions/delete/(:num)', 'Admin\Regions::delete/$1');

    // country - region
    $routes->get('country-regions', 'Admin\CountryRegions::index');
    $routes->get('country-regions/add', 'Admin\CountryRegions::add');
    $routes->post('country-regions/add', 'Admin\CountryRegions::add');
    $routes->get('country-regions/view/(:num)', 'Admin\CountryRegions::view/$1');
    $routes->get('country-regions/edit/(:num)', 'Admin\CountryRegions::edit/$1');
    $routes->post('country-regions/edit/(:num)', 'Admin\CountryRegions::edit/$1');
    $routes->delete('country-regions/delete/(:num)', 'Admin\CountryRegions::delete/$1');

    $routes->get('order-status-codes', 'Admin\OrderStatusCodes::index');
    $routes->get('order-status-codes/create', 'Admin\OrderStatusCodes::create');
    $routes->post('order-status-codes/create', 'Admin\OrderStatusCodes::create');
    $routes->get('order-status-codes/edit/(:num)', 'Admin\OrderStatusCodes::edit/$1');
    $routes->post('order-status-codes/edit/(:num)', 'Admin\OrderStatusCodes::edit/$1');
    $routes->post('order-status-codes/make_default', 'Admin\OrderStatusCodes::make_default');
    $routes->delete('order-status-codes/delete/(:num)', 'Admin\OrderStatusCodes::delete/$1');

    $routes->get('settings', 'Admin\Settings::index');
    $routes->post('settings', 'Admin\Settings::index');

    $routes->get('/', 'Admin\Home::index');
    $routes->get('dashboard', 'Admin\Home::index');
    $routes->get('login', 'Admin\Login::login');
    $routes->post('login', 'Admin\Login::login');
    $routes->get('logout', 'Admin\Login::logout');
});

// API Routes
$routes->group('api', function ($routes) {
    $routes->post('getProductFrameSizes', 'Reseller\Api::getProductFrameSizes');
    $routes->post('getAllProductFrameSizes', 'Reseller\Api::getAllProductFrameSizes');
    $routes->post('getProductFrameColors', 'Reseller\Api::getProductFrameColors');
    $routes->post('getAllProductFrameColors', 'Reseller\Api::getAllProductFrameColors');
    $routes->post('getProductFrameTypes', 'Reseller\Api::getProductFrameTypes');
    $routes->post('getAllProductFrameTypes', 'Reseller\Api::getAllProductFrameTypes');
    $routes->post('getRecipientCountries', 'Reseller\Api::getRecipientCountries');
    $routes->post('calculatePriceTotal', 'Reseller\Api::calculatePriceTotal');
    $routes->post('getRegions', 'Reseller\Api::getRegions');
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
