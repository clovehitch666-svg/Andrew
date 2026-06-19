<?php

namespace App\Controllers;

use App\Models\ObatMasukModel;
use App\Models\ObatModel;
use App\Models\SupplierModel;

class ObatMasuk extends BaseController
{
    public function index()
    {
        $model = new ObatMasukModel();

        $data['obat_masuk'] = $model
            ->select('obat_masuk.*, obat.nama_obat, suppliers.nama_supplier')
            ->join('obat', 'obat.id = obat_masuk.obat_id')
            ->join('suppliers', 'suppliers.id = obat_masuk.supplier_id')
            ->findAll();

        return view('obat_masuk/index', $data);
    }

    public function tambah()
    {
        $obatModel = new ObatModel();
        $supplierModel = new SupplierModel();

        $data['obat'] = $obatModel->findAll();
        $data['supplier'] = $supplierModel->findAll();

        return view('obat_masuk/tambah', $data);
    }

    public function simpan()
    {
        $model = new ObatMasukModel();
        $obatModel = new ObatModel();

        $tanggalKadaluarsa = $this->request->getPost('tanggal_kadaluarsa');

        $hari = floor(
            (strtotime($tanggalKadaluarsa) - time())
            / 86400
        );

        if ($hari < 0) {
            $status = 'expired';
        } elseif ($hari <= 30) {
            $status = 'hampir_expired';
        } else {
            $status = 'aman';
        }

        $model->save([
            'obat_id'            => $this->request->getPost('obat_id'),
            'supplier_id'        => $this->request->getPost('supplier_id'),
            'jumlah'             => $this->request->getPost('jumlah'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $tanggalKadaluarsa,
            'status_kadaluarsa'  => $status
        ]);

        $obat = $obatModel->find(
            $this->request->getPost('obat_id')
        );

        $obatModel->update(
            $obat['id'],
            [
                'stok' => $obat['stok']
                    + $this->request->getPost('jumlah')
            ]
        );

        return redirect()->to('/obatmasuk');
    }
}