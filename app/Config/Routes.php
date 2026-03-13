<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Auth::login');
$routes->post('/login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/obat', 'Obat::index');
$routes->get('/obat/tambah', 'Obat::tambah');
$routes->post('/obat/simpan', 'Obat::simpan');
$routes->get('/obat/edit/(:num)', 'Obat::edit/$1');
$routes->post('/obat/update/(:num)', 'Obat::update/$1');
$routes->get('/obat/hapus/(:num)', 'Obat::hapus/$1');

$routes->get('/supplier', 'Supplier::index');
$routes->get('/supplier/tambah', 'Supplier::tambah');
$routes->post('/supplier/simpan', 'Supplier::simpan');
$routes->get('/supplier/edit/(:num)', 'Supplier::edit/$1');
$routes->post('/supplier/update/(:num)', 'Supplier::update/$1');
$routes->get('/supplier/hapus/(:num)', 'Supplier::hapus/$1');

$routes->get('/obatmasuk', 'ObatMasuk::index');
$routes->get('/obatmasuk/tambah', 'ObatMasuk::tambah');
$routes->post('/obatmasuk/simpan', 'ObatMasuk::simpan');

$routes->get('/penjualan', 'Penjualan::index');
$routes->get('/penjualan/tambah', 'Penjualan::tambah');
$routes->post('/penjualan/simpan', 'Penjualan::simpan');

$routes->get('/laporan/stok', 'Laporan::stok');
$routes->get('/laporan/kadaluarsa', 'Laporan::kadaluarsa');
$routes->get('/laporan/penjualan', 'Laporan::penjualan');