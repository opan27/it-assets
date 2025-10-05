<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========== AUTH ==========
$routes->get('/', fn() => redirect()->to('/login'));
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// ========== DASHBOARD ==========
$routes->get('dashboard', 'Dashboard::index', [
    'filter' => ['auth', 'role:superadmin']
]);

$routes->get('teknisi/dashboard', 'Teknisi::dashboard', [
    'filter' => ['auth', 'role:teknisi']
]);

// ========== PEGAWAI ==========
$routes->group('pegawai', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Pegawai::index');
    $routes->get('create', 'Pegawai::create');
    $routes->post('store', 'Pegawai::store');
    $routes->get('edit/(:num)', 'Pegawai::edit/$1');
    $routes->post('update/(:num)', 'Pegawai::update/$1');
    $routes->get('delete/(:num)', 'Pegawai::delete/$1');
    $routes->post('import', 'Pegawai::import');
    $routes->post('upload', 'Pegawai::upload');
    $routes->post('process', 'Pegawai::processImport');
    $routes->get('template', 'Pegawai::template');
});

// ========== KATEGORI ==========
$routes->group('kategori', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Kategori::index');
    $routes->post('store', 'Kategori::store');
    $routes->post('update/(:num)', 'Kategori::update/$1');
    $routes->get('delete/(:num)', 'Kategori::delete/$1');
});

// ========== KONDISI ==========
$routes->group('kondisi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Kondisi::index');
    $routes->get('create', 'Kondisi::create');
    $routes->post('store', 'Kondisi::store');
    $routes->get('edit/(:num)', 'Kondisi::edit/$1');
    $routes->post('update/(:num)', 'Kondisi::update/$1');
    $routes->get('delete/(:num)', 'Kondisi::delete/$1');
});

// ========== ASSETS ==========
$routes->group('assets', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AssetController::index');
    $routes->get('create', 'AssetController::create');
    $routes->post('store', 'AssetController::store');
    $routes->get('edit/(:num)', 'AssetController::edit/$1');
    $routes->post('update/(:num)', 'AssetController::update/$1');
    $routes->get('delete/(:num)', 'AssetController::delete/$1');
    $routes->get('detail/(:num)', 'AssetController::detail/$1');
    $routes->get('template', 'AssetController::template');
});

// ========== PIC ASSETS ==========
$routes->group('picassets', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'PicAssets::index');
    $routes->post('store', 'PicAssets::store');
    $routes->get('create', 'PicAssets::create');
    $routes->get('edit/(:num)', 'PicAssets::edit/$1');
    $routes->post('update/(:num)', 'PicAssets::update/$1');
    $routes->get('delete/(:num)', 'PicAssets::delete/$1');
    $routes->get('release/(:num)', 'PicAssets::release/$1');
    $routes->post('release/(:num)', 'PicAssets::release/$1');
    $routes->get('maintenance/(:num)', 'PicAssets::maintenance/$1');
    $routes->get('selesai-maintenance/(:num)', 'PicAssets::selesaiMaintenance/$1');
    $routes->get('detail/(:num)', 'PicAssets::detail/$1');
});

// ========== ACTIVITY LOG ==========
$routes->group('activities', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ActivityController::index');
    $routes->get('(:num)', 'ActivityController::show/$1');
});

// ========== REPORT ==========
$routes->get('report/export', 'Report::export', ['filter' => 'auth']);

// ========== MAINTENANCE ==========
$routes->group('maintenance', ['filter' => ['auth','role:admin,superadmin']], function ($routes) {
    $routes->get('/', 'Maintenance::index');
    $routes->get('create', 'Maintenance::create');
    $routes->post('store', 'Maintenance::store');
    $routes->get('detail/(:num)', 'Maintenance::detail/$1');
    $routes->get('get-asset-detail/(:num)', 'Maintenance::getAssetDetail/$1');
    $routes->get('selesai/(:num)', 'Maintenance::selesai/$1');
    $routes->post('sendMessage', 'Maintenance::sendMessage');
    $routes->get('tracking', 'Maintenance::tracking');
});

$routes->get('maintenance/get-asset-detail/(:num)', 'Maintenance::getAssetDetail/$1', ['filter' => ['auth','role:admin,superadmin']]);
$routes->get('maintenance/report/(:num)', 'Maintenance::downloadReport/$1', ['filter' => ['auth','role:admin,superadmin']]);

// ========== TEKNISI ==========
$routes->group('teknisi', ['filter' => ['auth','role:teknisi']], function ($routes) {
    $routes->get('list', 'Teknisi::dashboard');
    $routes->get('detail/(:num)', 'Teknisi::detail/$1');
    $routes->post('update-status', 'Teknisi::updateStatus');
    $routes->post('maintenance/send-message', 'Teknisi::sendMessage');
    $routes->get('acceptTicket/(:num)', 'Teknisi::acceptTicket/$1');
    $routes->get('tracking', 'Teknisi::tracking');
});

// ========== NOTIFICATIONS ==========
$routes->group('notifications', ['filter' => 'auth'], function($routes) {
    $routes->get('unread-count', 'Notifications::unreadCount');
    $routes->get('latest', 'Notifications::latest');
    $routes->post('mark-all-read', 'Notifications::markAllRead');
    $routes->post('send/(:num)', 'Notifications::send/$1');
});

// ========== LOKASI ==========
$routes->group('lokasi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Lokasi::index');
    $routes->post('store', 'Lokasi::store');
    $routes->post('update/(:num)', 'Lokasi::update/$1');
    $routes->get('delete/(:num)', 'Lokasi::delete/$1');
});

// ========== ASSET LOKASI ==========
$routes->group('asset_lokasi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AssetLokasi::index');
    $routes->get('create', 'AssetLokasi::create');
    $routes->post('store', 'AssetLokasi::store');
    $routes->get('edit/(:num)', 'AssetLokasi::edit/$1');
    $routes->post('update/(:num)', 'AssetLokasi::update/$1');
    $routes->get('delete/(:num)', 'AssetLokasi::delete/$1');
});

// ========== ENTITAS ==========
$routes->get('entitas/(:segment)', 'Entitas::dashboard/$1', ['filter' => 'auth']);

// ========== KENDARAAN ==========
$routes->group('kendaraan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'KendaraanController::index');
    $routes->get('create', 'KendaraanController::create');
    $routes->post('store', 'KendaraanController::store');
    $routes->get('edit/(:num)', 'KendaraanController::edit/$1');
    $routes->post('update/(:num)', 'KendaraanController::update/$1');
    $routes->get('delete/(:num)', 'KendaraanController::delete/$1');
});

// ========== BERITA ACARA ==========
$routes->group('beritaacara', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'BeritaAcaraController::index');
    $routes->get('download/(:any)', 'BeritaAcaraController::download/$1');
});
$routes->get('berita-acara/export/(:num)', 'BeritaAcaraController::exportDocx/$1', ['filter' => 'auth']);

// ========== USER MANAGEMENT ==========
$routes->group('users', ['filter' => ['auth', 'role:superadmin']], function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('create', 'Users::create');
    $routes->post('store', 'Users::store');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->post('update/(:num)', 'Users::update/$1');
    $routes->get('delete/(:num)', 'Users::delete/$1');
});

// Alternate admin group
$routes->group('admin', ['filter' => ['auth','role:superadmin']], static function ($routes) {
    $routes->get('users', 'Users::index');
    $routes->get('users/create', 'Users::create');
    $routes->post('users/store', 'Users::store');
});

// IMPORT ASSETS
$routes->post('assets/import', 'AssetController::import', ['filter' => 'auth']);
$routes->get('assets/template', 'AssetController::template', ['filter' => 'auth']);
