<?php

namespace App\Controllers;

use App\Models\LogActivityModel;

class LogActivity extends BaseController
{
    public function index()
    {
        // Batasi akses hanya untuk Admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $model = new LogActivityModel();
        
        $data['logs'] = $model->orderBy('id', 'DESC')->paginate(25, 'logs');
        $data['pager'] = $model->pager;

        return view('log_activity/index', $data);
    }
}
