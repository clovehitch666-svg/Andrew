<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table = 'obat';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

   protected $allowedFields = [
    'rak',
    'nama_obat',
    'jenis_obat',
    'kategori',
    'harga_beli',
    'harga_jual',
    'stok',
    'expired_date',
    'satuan',
    'stok_minimum',
    'no_batch'
];
}