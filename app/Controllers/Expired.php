<?php

namespace App\Controllers;

use App\Models\ObatModel;

class Expired extends BaseController
{
    public function index()
    {
        $model = new ObatModel();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $query = $model->where('expired_date IS NOT NULL');

        if ($startDate && $endDate) {
            $query = $query->where('expired_date >=', $startDate)
                           ->where('expired_date <=', $endDate);
        } else {
            // Default: Tampilkan semua yang sudah kedaluwarsa hari ini ke belakang
            $query = $query->where('expired_date <=', date('Y-m-d'));
        }

        $data['obat'] = $query->orderBy('expired_date', 'ASC')->paginate(15, 'expired');
        $data['pager'] = $model->pager;
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;

        return view('expired/index', $data);
    }

    public function printReport()
    {
        // Hanya Admin yang bisa print/unduh laporan
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/expired')->with('error', 'Hanya Admin yang dapat mengunduh atau mencetak laporan.');
        }

        $model = new ObatModel();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $query = $model->where('expired_date IS NOT NULL');

        if ($startDate && $endDate) {
            $query = $query->where('expired_date >=', $startDate)
                           ->where('expired_date <=', $endDate);
        } else {
            $query = $query->where('expired_date <=', date('Y-m-d'));
        }

        $data['obat'] = $query->orderBy('expired_date', 'ASC')->findAll();
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;

        return view('expired/print', $data);
    }

    public function download()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/expired')->with('error', 'Hanya Admin yang dapat mengunduh laporan.');
        }

        $model = new ObatModel();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $query = $model->where('expired_date IS NOT NULL');

        if ($startDate && $endDate) {
            $query = $query->where('expired_date >=', $startDate)
                           ->where('expired_date <=', $endDate);
        } else {
            $query = $query->where('expired_date <=', date('Y-m-d'));
        }

        $obat = $query->orderBy('expired_date', 'ASC')->findAll();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=laporan_expired_' . date('Y-m-d') . '.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['No', 'No Batch', 'Nama Obat', 'Kategori', 'Stok', 'Satuan', 'Tanggal Expired']);
        
        $no = 1;
        foreach ($obat as $o) {
            fputcsv($output, [
                $no++,
                $o['no_batch'] ?: '-',
                $o['nama_obat'],
                $o['kategori'],
                $o['stok'],
                $o['satuan'],
                $o['expired_date']
            ]);
        }
        fclose($output);
        exit;
    }
}
