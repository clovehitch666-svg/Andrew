<?php

namespace App\Controllers;

use App\Models\ObatModel;

class Laporan extends BaseController
{
    public function index()
    {
        $model = new ObatModel();

        $data['obat'] = $model->paginate(10, 'laporan');
        $data['pager'] = $model->pager;

        return view('laporan/index', $data);
    }

    public function stok()
    {
        $model = new ObatModel();

        $data['obat'] = $model->paginate(10, 'laporan');
        $data['pager'] = $model->pager;

        return view('laporan/index', $data);
    }

    public function download()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/laporan')->with('error', 'Hanya Admin yang dapat mengunduh laporan.');
        }

        $model = new ObatModel();
        $obat = $model->findAll();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=laporan_obat_' . date('Y-m-d') . '.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['No', 'Nama Obat', 'Jenis', 'Satuan', 'Harga Beli', 'Harga Jual', 'Stok', 'Stok Minimum']);

        $no = 1;
        foreach ($obat as $o) {
            fputcsv($output, [
                $no++,
                $o['nama_obat'],
                $o['jenis_obat'],
                $o['satuan'],
                $o['harga_beli'],
                $o['harga_jual'],
                $o['stok'],
                $o['stok_minimum']
            ]);
        }
        fclose($output);
        exit;
    }
}