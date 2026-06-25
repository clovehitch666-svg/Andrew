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
$routes->get('/api/notifications', 'Dashboard::getNotifications');

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
    $db = \Config\Database::connect();
    $query = $db->query("
        SELECT 
            o.*,
            (SELECT COALESCE(SUM(jumlah), 0) FROM obat_masuk WHERE obat_id = o.id) AS jumlah_masuk,
            (SELECT COALESCE(SUM(jumlah), 0) FROM detail_penjualan WHERE obat_id = o.id) AS jumlah_keluar
        FROM obat o
        ORDER BY o.nama_obat ASC
    ");
    $data['obat'] = $query->getResultArray();
    return view('rekap/index', $data);
});
$routes->get('/rekap/download', function () {
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/rekap');
    }
    $db = \Config\Database::connect();
    $query = $db->query("
        SELECT 
            o.*,
            (SELECT COALESCE(SUM(jumlah), 0) FROM obat_masuk WHERE obat_id = o.id) AS jumlah_masuk,
            (SELECT COALESCE(SUM(jumlah), 0) FROM detail_penjualan WHERE obat_id = o.id) AS jumlah_keluar
        FROM obat o
        ORDER BY o.nama_obat ASC
    ");
    $obat = $query->getResultArray();
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=rekap_stok_' . date('Y-m-d') . '.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['No', 'Nama Obat', 'Rak', 'Stok Awal', 'Stok Akhir', 'Jumlah Masuk', 'Jumlah Keluar', 'Satuan', 'Exp. Date']);
    
    $no = 1;
    foreach ($obat as $o) {
        $stokAkhir = $o['stok'];
        $stokAwal = $stokAkhir - $o['jumlah_masuk'] + $o['jumlah_keluar'];
        fputcsv($output, [
            $no++,
            $o['nama_obat'],
            $o['rak'] ?? '-',
            $stokAwal,
            $stokAkhir,
            $o['jumlah_masuk'],
            $o['jumlah_keluar'],
            $o['satuan'] ?? '-',
            $o['expired_date'] ?? '-'
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