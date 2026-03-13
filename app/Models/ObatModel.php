<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{

    protected $table = 'obat';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_obat',
        'jenis_obat',
        'harga_beli',
        'harga_jual',
        'stok'
    ];

}