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
                <th style="width: 60px;">No</th>
                <th>No Batch</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Stok Saat Ini</th>
                <th>Stok Minimum</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($obat)): ?>
                <tr>
                    <td colspan="8">Tidak ada data obat.</td>
                </tr>
            <?php else: ?>
                <?php 
                $no = 1;
                foreach ($obat as $o): 
                    $isMenipis = $o['stok'] <= $o['stok_minimum'];
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($o['no_batch'] ?: '-') ?></td>
                        <td style="text-align: left; padding-left: 15px;"><strong><?= esc($o['nama_obat']) ?></strong></td>
                        <td><?= esc($o['kategori'] ?: '-') ?></td>
                        <td><?= esc($o['satuan'] ?: '-') ?></td>
                        <td style="font-weight: bold; color: <?= $isMenipis ? 'red' : 'inherit' ?>;">
                            <?= esc($o['stok']) ?>
                        </td>
                        <td><?= esc($o['stok_minimum']) ?></td>
                        <td>
                            <?php if ($isMenipis): ?>
                                <span class="badge-menipis">Menipis</span>
                            <?php else: ?>
                                <span class="badge-aman">Aman</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>