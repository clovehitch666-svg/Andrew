<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\StokOpnameModel;
use App\Models\LogActivityModel;

class StokOpname extends BaseController
{
    public function index()
    {
        $obatModel = new ObatModel();
        $opnameModel = new StokOpnameModel();

        $obat = $obatModel->paginate(10, 'stokopname');

        foreach ($obat as &$o) {

            $hasil = $opnameModel
                ->where('obat_id', $o['id'])
                ->orderBy('id', 'DESC')
                ->first();

            $o['stok_fisik'] = $hasil['stok_fisik'] ?? '';
            $o['selisih'] = $hasil['selisih'] ?? '';
            $o['keterangan'] = $hasil['keterangan'] ?? '';
        }

        $data['obat'] = $obat;
        $data['pager'] = $obatModel->pager;

        return view('stok_opname/index', $data);
    }

    public function simpan()
    {
        $model = new StokOpnameModel();

        $obatId = $this->request->getPost('obat_id');
        $stokSistem = $this->request->getPost('stok_sistem');
        $stokFisik = $this->request->getPost('stok_fisik');

        $selisih = $stokSistem - $stokFisik;

        if ($selisih == 0) {
            $keterangan = 'Akurat';
        } elseif ($selisih > 0) {
            $keterangan = 'Kurang';
        } else {
            $keterangan = 'Lebih';
        }

        $cek = $model
            ->where('obat_id', $obatId)
            ->first();

        if ($cek) {

            $model->update($cek['id'], [
                'stok_sistem' => $stokSistem,
                'stok_fisik' => $stokFisik,
                'selisih' => $selisih,
                'keterangan' => $keterangan
            ]);

        } else {

            $model->insert([
                'obat_id' => $obatId,
                'stok_sistem' => $stokSistem,
                'stok_fisik' => $stokFisik,
                'selisih' => $selisih,
                'keterangan' => $keterangan
            ]);

        }

        $obatModel = new ObatModel();
        $obat = $obatModel->find($obatId);
        $namaObat = $obat ? $obat['nama_obat'] : 'Tidak diketahui';
        LogActivityModel::log("Menyimpan stok opname untuk obat: " . $namaObat . " (Fisik: " . $stokFisik . ", Selisih: " . $selisih . ", Ket: " . $keterangan . ")");

        return redirect()->to('/stokopname')
            ->with('success', 'Stok opname berhasil disimpan');
    }

    public function download()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/stokopname')->with('error', 'Hanya Admin yang dapat mengunduh laporan.');
        }

        $obatModel = new ObatModel();
        $opnameModel = new StokOpnameModel();

        $obat = $obatModel->findAll();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=laporan_stokopname_' . date('Y-m-d') . '.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['No', 'Rak', 'Nama Obat', 'Stok Sistem', 'Stok Fisik', 'Selisih', 'Keterangan']);

        $no = 1;
        foreach ($obat as $o) {
            $hasil = $opnameModel
                ->where('obat_id', $o['id'])
                ->orderBy('id', 'DESC')
                ->first();

            fputcsv($output, [
                $no++,
                $o['rak'] ?? '-',
                $o['nama_obat'],
                $o['stok'],
                $hasil['stok_fisik'] ?? '',
                $hasil['selisih'] ?? '',
                $hasil['keterangan'] ?? ''
            ]);
        }
        fclose($output);
        exit;
    }
}