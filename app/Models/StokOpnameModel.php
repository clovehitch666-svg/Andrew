<?php

namespace App\Models;

use CodeIgniter\Model;

class StokOpnameModel extends Model
{
    protected $table = 'stok_opname';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'obat_id',
        'stok_sistem',
        'stok_fisik',
        'selisih',
        'keterangan'
    ];
}