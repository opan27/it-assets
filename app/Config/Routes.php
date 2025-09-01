<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    return redirect()->to('/login');
});
# This route is for the login page
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

#pegawai routes
$routes->group('pegawai', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pegawai::index');
    $routes->get('create', 'Pegawai::create');
    $routes->post('store', 'Pegawai::store');
    $routes->get('edit/(:num)', 'Pegawai::edit/$1');
    $routes->post('update/(:num)', 'Pegawai::update/$1');
    $routes->get('delete/(:num)', 'Pegawai::delete/$1');
});

#routes for importing data
$routes->get('pegawai', 'Pegawai::index');
$routes->post('pegawai/import', 'Pegawai::import');
$routes->post('pegawai/upload', 'Pegawai::upload');
$routes->post('pegawai/process', 'Pegawai::processImport');
$routes->get('pegawai', 'Pegawai::index');
$routes->post('pegawai/import', 'Pegawai::import');
$routes->get('pegawai/template', 'Pegawai::template');

#kategori routes
$routes->group('kategori', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Kategori::index');
    $routes->post('store', 'Kategori::store');
    $routes->post('update/(:num)', 'Kategori::update/$1');
    $routes->get('delete/(:num)', 'Kategori::delete/$1');
});

#routes for kategori
$routes->get('kondisi', 'Kondisi::index');
$routes->get('kondisi/create', 'Kondisi::create');
$routes->post('kondisi/store', 'Kondisi::store');
$routes->get('kondisi/edit/(:num)', 'Kondisi::edit/$1');
$routes->post('kondisi/update/(:num)', 'Kondisi::update/$1');
$routes->get('kondisi/delete/(:num)', 'Kondisi::delete/$1');

#asset routes
$routes->group('assets', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'AssetController::index');              // list data
    $routes->post('store', 'AssetController::store');         // simpan data
    $routes->get('delete/(:num)', 'AssetController::delete/$1'); // hapus data
    $routes->get('edit/(:num)', 'AssetController::edit/$1');
    $routes->post('update/(:num)', 'AssetController::update/$1');

});
#routes for pic assets
$routes->get('picassets', 'PicAssets::index');
$routes->post('picassets/store', 'PicAssets::store');
$routes->get('picassets/create', 'PicAssets::create');
$routes->get('picassets/edit/(:num)', 'PicAssets::edit/$1');
$routes->post('picassets/update/(:num)', 'PicAssets::update/$1');
$routes->get('picassets/delete/(:num)', 'PicAssets::delete/$1');

$routes->get('picassets/release/(:num)', 'PicAssets::release/$1');
$routes->get('picassets/maintenance/(:num)', 'PicAssets::maintenance/$1');
$routes->get('picassets/selesai-maintenance/(:num)', 'PicAssets::selesaiMaintenance/$1');

#routes for activities log
$routes->group('activities', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'ActivityController::index');        // List log
    $routes->get('(:num)', 'ActivityController::show/$1'); // Detail log
});

#routes for report
$routes->get('report/export', 'Report::export');

#routes for maintenance
$routes->group('maintenance', function($routes) {
    $routes->get('/', 'Maintenance::index');                // daftar maintenance
    $routes->get('create/(:num)', 'Maintenance::create/$1'); // form create dari PIC Asset
    $routes->post('store', 'Maintenance::store');           // simpan data maintenance
    $routes->get('detail/(:num)', 'Maintenance::detail/$1'); // detail maintenance
    $routes->get('selesai/(:num)', 'Maintenance::selesai/$1'); // selesaikan maintenance
});
#routes for lokasi
$routes->group('lokasi', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Lokasi::index');
    $routes->post('store', 'Lokasi::store');
    $routes->post('update/(:num)', 'Lokasi::update/$1');
    $routes->get('delete/(:num)', 'Lokasi::delete/$1');
});
#routes for asset lokasi
$routes->group('asset_lokasi', function($routes) {
    $routes->get('/', 'AssetLokasi::index');
    $routes->get('create', 'AssetLokasi::create');
    $routes->post('store', 'AssetLokasi::store');
    $routes->get('edit/(:num)', 'AssetLokasi::edit/$1');
    $routes->post('update/(:num)', 'AssetLokasi::update/$1');
    $routes->get('delete/(:num)', 'AssetLokasi::delete/$1');
});











