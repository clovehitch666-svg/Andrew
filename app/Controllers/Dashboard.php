<?php

namespace App\Controllers;

use App\Models\ObatModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $obatModel = new ObatModel();

        $data['jumlahObat'] = $obatModel->countAll();

        $data['stokMenipis'] = $obatModel
            ->where('stok <= stok_minimum')
            ->countAllResults();

        $stok = $obatModel
            ->selectSum('stok')
            ->first();

        $data['totalStok'] = $stok['stok'] ?? 0;

        $data['totalExpired'] = $obatModel
            ->where('expired_date IS NOT NULL')
            ->where('expired_date <=', date('Y-m-d'))
            ->countAllResults();

        return view('dashboard/index', $data);
    }
}