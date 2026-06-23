<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_obat'    => 'Paracetamol 500mg',
                'jenis_obat'   => 'Generik',
                'harga_beli'   => 5000.00,
                'harga_jual'   => 7500.00,
                'stok'         => 120,
                'satuan'       => 'Tablet',
                'stok_minimum' => 15,
                'rak'          => 'A1',
                'expired_date' => '2027-12-15',
                'kategori'     => 'Analgesik',
                'no_batch'     => 'BCH-PCT-001'
            ],
            [
                'nama_obat'    => 'Amoxicillin 500mg',
                'jenis_obat'   => 'Generik',
                'harga_beli'   => 12000.00,
                'harga_jual'   => 15000.00,
                'stok'         => 80,
                'satuan'       => 'Tablet',
                'stok_minimum' => 20,
                'rak'          => 'A2',
                'expired_date' => '2027-08-10',
                'kategori'     => 'Antibiotik',
                'no_batch'     => 'BCH-AMX-002'
            ],
            [
                'nama_obat'    => 'Mylanta Cair 150ml',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 15000.00,
                'harga_jual'   => 18500.00,
                'stok'         => 25,
                'satuan'       => 'Botol',
                'stok_minimum' => 5,
                'rak'          => 'B1',
                'expired_date' => '2024-05-12', // EXPIRED (Lama)
                'kategori'     => 'Antasida',
                'no_batch'     => 'BCH-MYL-003'
            ],
            [
                'nama_obat'    => 'Combantrin Jeruk 10ml',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 16000.00,
                'harga_jual'   => 19800.00,
                'stok'         => 3, // MENIPIS
                'satuan'       => 'Botol',
                'stok_minimum' => 10,
                'rak'          => 'B2',
                'expired_date' => '2026-09-24', // Aktif/Mendekati
                'kategori'     => 'Obat Cacing',
                'no_batch'     => 'BCH-COM-004'
            ],
            [
                'nama_obat'    => 'Panadol Extra',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 8500.00,
                'harga_jual'   => 11000.00,
                'stok'         => 150,
                'satuan'       => 'Strip',
                'stok_minimum' => 25,
                'rak'          => 'A1',
                'expired_date' => '2026-05-01', // EXPIRED (Baru lewat)
                'kategori'     => 'Analgesik',
                'no_batch'     => 'BCH-PAN-005'
            ],
            [
                'nama_obat'    => 'Bodrex Sakit Kepala',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 4000.00,
                'harga_jual'   => 5500.00,
                'stok'         => 5, // MENIPIS
                'satuan'       => 'Strip',
                'stok_minimum' => 15,
                'rak'          => 'A1',
                'expired_date' => '2028-02-28',
                'kategori'     => 'Analgesik',
                'no_batch'     => 'BCH-BOD-006'
            ],
            [
                'nama_obat'    => 'Loperamide 2mg',
                'jenis_obat'   => 'Generik',
                'harga_beli'   => 3500.00,
                'harga_jual'   => 5000.00,
                'stok'         => 200,
                'satuan'       => 'Tablet',
                'stok_minimum' => 30,
                'rak'          => 'C1',
                'expired_date' => '2027-11-20',
                'kategori'     => 'Antidiare',
                'no_batch'     => 'BCH-LOP-007'
            ],
            [
                'nama_obat'    => 'Betadine Antiseptic 15ml',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 9500.00,
                'harga_jual'   => 12500.00,
                'stok'         => 45,
                'satuan'       => 'Botol',
                'stok_minimum' => 10,
                'rak'          => 'D1',
                'expired_date' => '2025-01-15', // EXPIRED
                'kategori'     => 'Antiseptik',
                'no_batch'     => 'BCH-BET-008'
            ],
            [
                'nama_obat'    => 'Decolgen Tablet',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 5500.00,
                'harga_jual'   => 7000.00,
                'stok'         => 60,
                'satuan'       => 'Strip',
                'stok_minimum' => 15,
                'rak'          => 'E1',
                'expired_date' => '2026-06-01', // EXPIRED
                'kategori'     => 'Obat Flu',
                'no_batch'     => 'BCH-DEC-009'
            ],
            [
                'nama_obat'    => 'Sanmol Sirup 60ml',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 12500.00,
                'harga_jual'   => 16000.00,
                'stok'         => 18,
                'satuan'       => 'Botol',
                'stok_minimum' => 5,
                'rak'          => 'B1',
                'expired_date' => '2027-04-10',
                'kategori'     => 'Analgesik anak',
                'no_batch'     => 'BCH-SAN-010'
            ],
            [
                'nama_obat'    => 'Cefadroxil 500mg',
                'jenis_obat'   => 'Generik',
                'harga_beli'   => 18000.00,
                'harga_jual'   => 23000.00,
                'stok'         => 90,
                'satuan'       => 'Kapsul',
                'stok_minimum' => 20,
                'rak'          => 'A2',
                'expired_date' => '2027-10-18',
                'kategori'     => 'Antibiotik',
                'no_batch'     => 'BCH-CEF-011'
            ],
            [
                'nama_obat'    => 'Insto Eye Drops 7.5ml',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 11000.00,
                'harga_jual'   => 14500.00,
                'stok'         => 2, // MENIPIS
                'satuan'       => 'Botol',
                'stok_minimum' => 8,
                'rak'          => 'D2',
                'expired_date' => '2025-11-30', // EXPIRED
                'kategori'     => 'Obat Mata',
                'no_batch'     => 'BCH-INS-012'
            ],
            [
                'nama_obat'    => 'OBH Tropica 100ml',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 13000.00,
                'harga_jual'   => 16500.00,
                'stok'         => 35,
                'satuan'       => 'Botol',
                'stok_minimum' => 10,
                'rak'          => 'E1',
                'expired_date' => '2026-06-15', // EXPIRED
                'kategori'     => 'Obat Batuk',
                'no_batch'     => 'BCH-OBH-013'
            ],
            [
                'nama_obat'    => 'Salbutamol 2mg',
                'jenis_obat'   => 'Generik',
                'harga_beli'   => 6000.00,
                'harga_jual'   => 8000.00,
                'stok'         => 110,
                'satuan'       => 'Tablet',
                'stok_minimum' => 20,
                'rak'          => 'C2',
                'expired_date' => '2027-09-05',
                'kategori'     => 'Asma',
                'no_batch'     => 'BCH-SAL-014'
            ],
            [
                'nama_obat'    => 'Voltaren Gel 20g',
                'jenis_obat'   => 'Paten',
                'harga_beli'   => 38000.00,
                'harga_jual'   => 48000.00,
                'stok'         => 14,
                'satuan'       => 'Tube',
                'stok_minimum' => 5,
                'rak'          => 'F1',
                'expired_date' => '2025-08-22', // EXPIRED
                'kategori'     => 'Topikal Otot',
                'no_batch'     => 'BCH-VOL-015'
            ]
        ];

        // Insert ke tabel obat
        $this->db->table('obat')->insertBatch($data);
    }
}
