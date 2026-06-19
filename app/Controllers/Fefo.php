<?php

namespace App\Controllers;

use App\Models\ObatModel;

class Fefo extends BaseController
{
    public function index()
    {
        $model = new ObatModel();

        $data['obat'] = $model
            ->where('expired_date IS NOT NULL')
            ->orderBy('expired_date', 'ASC')
            ->findAll();

        return view('fefo/index', $data);
    }
}