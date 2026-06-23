<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\LogActivityModel;

class Obat extends BaseController
{
    public function index()
    {
        $model = new ObatModel();

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {

            $data['obat'] = $model
                ->like('nama_obat', $keyword)
                ->paginate(10, 'obat');

        } else {

            $data['obat'] = $model
                ->paginate(10, 'obat');

        }

        $data['pager'] = $model->pager;

        return view('obat/index', $data);
    }

    public function tambah()
    {
        return view('obat/tambah');
    }

    public function simpan()
    {
        $model = new ObatModel();

        $hargaBeli = str_replace('.', '', $this->request->getPost('harga_beli'));
        $hargaJual = str_replace('.', '', $this->request->getPost('harga_jual'));

        $model->save([
            'rak'           => $this->request->getPost('rak'),
            'nama_obat'     => $this->request->getPost('nama_obat'),
            'jenis_obat'    => $this->request->getPost('jenis_obat'),
            'kategori'      => $this->request->getPost('kategori'),
            'harga_beli'    => $hargaBeli,
            'harga_jual'    => $hargaJual,
            'stok'          => $this->request->getPost('stok'),
            'expired_date'  => $this->request->getPost('expired_date'),
            'satuan'        => $this->request->getPost('satuan'),
            'stok_minimum'  => $this->request->getPost('stok_minimum'),
            'no_batch'      => $this->request->getPost('no_batch')
        ]);

        LogActivityModel::log("Menambahkan data obat baru: " . $this->request->getPost('nama_obat') . " (Batch: " . $this->request->getPost('no_batch') . ")");

        return redirect()->to('/obat')
            ->with('success', 'Data obat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new ObatModel();

        $data['obat'] = $model->find($id);

        if (!$data['obat']) {

            return redirect()->to('/obat')
                ->with('success', 'Data obat tidak ditemukan');

        }

        return view('obat/edit', $data);
    }

    public function update($id)
    {
        $model = new ObatModel();

        $hargaBeli = str_replace('.', '', $this->request->getPost('harga_beli'));
        $hargaJual = str_replace('.', '', $this->request->getPost('harga_jual'));

        $model->update($id, [
            'rak'           => $this->request->getPost('rak'),
            'nama_obat'     => $this->request->getPost('nama_obat'),
            'jenis_obat'    => $this->request->getPost('jenis_obat'),
            'kategori'      => $this->request->getPost('kategori'),
            'harga_beli'    => $hargaBeli,
            'harga_jual'    => $hargaJual,
            'stok'          => $this->request->getPost('stok'),
            'expired_date'  => $this->request->getPost('expired_date'),
            'satuan'        => $this->request->getPost('satuan'),
            'stok_minimum'  => $this->request->getPost('stok_minimum'),
            'no_batch'      => $this->request->getPost('no_batch')
        ]);

        LogActivityModel::log("Mengubah data obat: " . $this->request->getPost('nama_obat') . " (ID: " . $id . ")");

        return redirect()->to('/obat')
            ->with('success', 'Data obat berhasil diperbarui');
    }

    public function hapus($id)
    {
        $model = new ObatModel();
        $obat = $model->find($id);
        $namaObat = $obat ? $obat['nama_obat'] : 'Tidak diketahui';

        $model->delete($id);

        LogActivityModel::log("Menghapus data obat: " . $namaObat . " (ID: " . $id . ")");

        return redirect()->to('/obat')
            ->with('success', 'Data obat berhasil dihapus');
    }
}