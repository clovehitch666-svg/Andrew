<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Auth::login');
$routes->post('/login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

$routes->get('/dashboard', 'Dashboard::index');

/*
|--------------------------------------------------------------------------
| MASTER OBAT
|--------------------------------------------------------------------------
*/

$routes->get('/obat', 'Obat::index');

$routes->get('/obat/tambah', 'Obat::tambah');
$routes->post('/obat/simpan', 'Obat::simpan');

$routes->get('/obat/edit/(:num)', 'Obat::edit/$1');
$routes->post('/obat/update/(:num)', 'Obat::update/$1');

$routes->get('/obat/hapus/(:num)', 'Obat::hapus/$1');

/*
|--------------------------------------------------------------------------
| STOK OPNAME
|--------------------------------------------------------------------------
*/


$routes->get('/stokopname', 'StokOpname::index');
$routes->post('/stokopname/simpan', 'StokOpname::simpan');

/*
|--------------------------------------------------------------------------
| REKAP STOK
|--------------------------------------------------------------------------
*/

$routes->get('/rekap', function () {
    return view('rekap/index');
});

/*
|--------------------------------------------------------------------------
| FEFO
|--------------------------------------------------------------------------
*/

$routes->get('/fefo', 'Fefo::index');

/*
|--------------------------------------------------------------------------
| LAPORAN
|--------------------------------------------------------------------------
*/

$routes->get('/laporan', 'Laporan::index');
$routes->get('/laporan/stok', 'Laporan::stok');