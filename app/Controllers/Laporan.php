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
}