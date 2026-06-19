<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
{
    public function index()
    {
        $model = new SupplierModel();

        $data['supplier'] = $model->findAll();

        return view('supplier/index', $data);
    }

    public function tambah()
    {
        return view('supplier/tambah');
    }

    public function simpan()
    {
        $model = new SupplierModel();

        $model->save([
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp')
        ]);

        return redirect()->to('/supplier');
    }

    public function edit($id)
    {
        $model = new SupplierModel();

        $data['supplier'] = $model->find($id);

        return view('supplier/edit', $data);
    }

    public function update($id)
    {
        $model = new SupplierModel();

        $model->update($id, [
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp')
        ]);

        return redirect()->to('/supplier');
    }

    public function hapus($id)
    {
        $model = new SupplierModel();

        $model->delete($id);

        return redirect()->to('/supplier');
    }
}