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
$routes->get('/stokopname/download', 'StokOpname::download');

/*
|--------------------------------------------------------------------------
| REKAP STOK
|--------------------------------------------------------------------------
*/

$routes->get('/rekap', function () {
    return view('rekap/index');
});
$routes->get('/rekap/download', function () {
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/rekap');
    }
    $model = new \App\Models\ObatModel();
    $obat = $model->findAll();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=rekap_stok_' . date('Y-m-d') . '.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['No', 'Nama Obat', 'Stok', 'Status']);
    $no = 1;
    foreach ($obat as $o) {
        $status = ($o['stok'] <= $o['stok_minimum']) ? 'Menipis' : 'Aman';
        fputcsv($output, [
            $no++,
            $o['nama_obat'],
            $o['stok'],
            $status
        ]);
    }
    fclose($output);
    exit;
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
$routes->get('/laporan/download', 'Laporan::download');
$routes->get('/logactivity', 'LogActivity::index');
$routes->get('/expired', 'Expired::index');
$routes->get('/expired/print', 'Expired::printReport');
$routes->get('/expired/download', 'Expired::download');