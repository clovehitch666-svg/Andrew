<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\StokOpnameModel;

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

        return redirect()->to('/stokopname')
            ->with('success', 'Stok opname berhasil disimpan');
    }
}