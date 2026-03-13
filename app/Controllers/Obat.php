<?php

namespace App\Controllers;
use App\Models\ObatModel;

class Obat extends BaseController
{

    public function index()
    {
        $model = new ObatModel();
        $data['obat'] = $model->findAll();

        return view('obat/index',$data);
    }

    public function tambah()
    {
        return view('obat/tambah');
    }

    public function simpan()
    {
        $model = new ObatModel();

        $model->save([
            'nama_obat' => $this->request->getPost('nama_obat'),
            'jenis_obat' => $this->request->getPost('jenis_obat'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/obat');
    }

}