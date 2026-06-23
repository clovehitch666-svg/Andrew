<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>
.rekap-title {
    font-size: 30px;
    font-weight: bold;
}

.table-responsive {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,.1);
    margin-top: 20px;
}

.badge-aman {
    background: #28a745;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 13px;
    font-weight: bold;
}

.badge-menipis {
    background: red;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 13px;
    font-weight: bold;
}

@media print {
    .sidebar, .header, .no-print, button {
        display: none !important;
    }
    .content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    body {
        background: white !important;
    }
}
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2 class="rekap-title">Rekapitulasi Stok Obat</h2>
    <?php if (session()->get('role') === 'admin'): ?>
        <div class="no-print" style="display: flex; gap: 10px;">
            <button onclick="window.print()" style="padding: 10px 15px; background: #1f76be; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">🖨️ Cetak Laporan</button>
            <a href="/rekap/download" class="btn" style="background: #28a745; line-height: 22px; font-weight: bold;">📥 Unduh Excel/CSV</a>
        </div>
    <?php endif; ?>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th style="width: 60px;">NO</th>
                <th>Nama Obat</th>
                <th>Rak</th>
                <th>Stok Awal</th>
                <th>Stok Akhir</th>
                <th>Jumlah masuk</th>
                <th>Jumlah Keluar</th>
                <th>Satuan</th>
                <th>Exp. Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($obat)): ?>
                <tr>
                    <td colspan="9">Tidak ada data obat.</td>
                </tr>
            <?php else: ?>
                <?php 
                $no = 1;
                foreach ($obat as $o): 
                    $stokAkhir = $o['stok'];
                    $stokAwal = $stokAkhir - $o['jumlah_masuk'] + $o['jumlah_keluar'];
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td style="text-align: left; padding-left: 15px;"><strong><?= esc($o['nama_obat']) ?></strong></td>
                        <td><?= esc($o['rak'] ?: '-') ?></td>
                        <td><?= esc($stokAwal) ?></td>
                        <td style="font-weight: bold; color: <?= ($stokAkhir <= $o['stok_minimum']) ? 'red' : 'inherit' ?>;">
                            <?= esc($stokAkhir) ?>
                        </td>
                        <td><?= esc($o['jumlah_masuk']) ?></td>
                        <td><?= esc($o['jumlah_keluar']) ?></td>
                        <td><?= esc($o['satuan'] ?: '-') ?></td>
                        <td style="font-weight: bold;">
                            <?= $o['expired_date'] ? date('d/m/Y', strtotime($o['expired_date'])) : '-' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>