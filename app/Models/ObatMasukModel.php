<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatMasukModel extends Model
{
    protected $table = 'obat_masuk';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'obat_id',
        'supplier_id',
        'jumlah',
        'tanggal_masuk',
        'tanggal_kadaluarsa',
        'status_kadaluarsa'
    ];
}