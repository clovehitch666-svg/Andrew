<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\DetailPenjualanModel;
use App\Models\ObatModel;

class Penjualan extends BaseController
{
    public function index()
    {
        $model = new PenjualanModel();

        $data['penjualan'] = $model->findAll();

        return view('penjualan/index', $data);
    }

    public function tambah()
    {
        $obatModel = new ObatModel();

        $data['obat'] = $obatModel->findAll();

        return view('penjualan/tambah', $data);
    }

    public function simpan()
    {
        $obatModel = new ObatModel();
        $penjualanModel = new PenjualanModel();
        $detailModel = new DetailPenjualanModel();

        $obatId = $this->request->getPost('obat_id');
        $jumlah = $this->request->getPost('jumlah');

        $obat = $obatModel->find($obatId);

        if(!$obat)
        {
            return redirect()->back();
        }

        if($jumlah > $obat['stok'])
        {
            return redirect()->back();
        }

        $subtotal = $jumlah * $obat['harga_jual'];

        $penjualanModel->save([
            'user_id' => 1,
            'tanggal' => date('Y-m-d H:i:s'),
            'total' => $subtotal
        ]);

        $penjualanId = $penjualanModel->insertID();

        $detailModel->save([
            'penjualan_id' => $penjualanId,
            'obat_id' => $obatId,
            'jumlah' => $jumlah,
            'harga' => $obat['harga_jual'],
            'subtotal' => $subtotal
        ]);

        $obatModel->update($obatId, [
            'stok' => $obat['stok'] - $jumlah
        ]);

        return redirect()->to('/penjualan');
    }
}