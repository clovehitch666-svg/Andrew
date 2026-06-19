<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'tanggal',
        'total'
    ];
}