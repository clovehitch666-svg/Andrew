<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>
.expired-title {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 25px;
}

.filter-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,.1);
    margin-bottom: 25px;
}

.filter-form {
    display: flex;
    gap: 15px;
    align-items: flex-end;
    flex-wrap: wrap;
}

.form-group-filter {
    flex: 1;
    min-width: 150px;
}

.form-group-filter label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.form-group-filter input {
    margin-top: 0;
}

.btn-container {
    display: flex;
    gap: 10px;
}

.table-responsive {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,.1);
}

.pager-container {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.pager-container ul {
    display: flex;
    list-style: none;
    gap: 5px;
}

.pager-container a, .pager-container span {
    padding: 8px 12px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #333;
    border-radius: 4px;
}

.pager-container .active span {
    background: #59c36a;
    color: white;
    border-color: #59c36a;
}

.btn-print {
    background: #1f76be;
}
.btn-print:hover {
    background: #155a92;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    padding: 12px;
    border-radius: 5px;
    margin-bottom: 15px;
}
</style>

<div class="expired-title">
    Laporan Produk Expired
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="filter-box">
    <form method="GET" action="/expired" class="filter-form">
        <div class="form-group-filter">
            <label>Tanggal Awal</label>
            <input type="date" name="start_date" value="<?= esc($start_date) ?>" required>
        </div>
        
        <div class="form-group-filter">
            <label>Tanggal Akhir</label>
            <input type="date" name="end_date" value="<?= esc($end_date) ?>" required>
        </div>
        
        <div class="btn-container">
            <button type="submit">Filter</button>
            <a href="/expired" class="btn" style="background: #cfcfcf; color: black; line-height: 22px;">Reset</a>
            
            <?php if (session()->get('role') === 'admin'): ?>
                <a href="/expired/print?start_date=<?= esc($start_date) ?>&end_date=<?= esc($end_date) ?>" target="_blank" class="btn btn-print" style="line-height: 22px;">🖨️ Cetak Laporan</a>
                <a href="/expired/download?start_date=<?= esc($start_date) ?>&end_date=<?= esc($end_date) ?>" class="btn" style="background: #28a745; line-height: 22px;">📥 Unduh Excel/CSV</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th>No Batch</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Tanggal Expired</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($obat)): ?>
                <tr>
                    <td colspan="8">Tidak ada produk expired dalam kriteria filter ini.</td>
                </tr>
            <?php else: ?>
                <?php 
                $page = isset($_GET['page_expired']) ? (int)$_GET['page_expired'] : 1;
                $no = 1 + (($page - 1) * 15);
                foreach ($obat as $o): 
                    $isExpired = strtotime($o['expired_date']) <= time();
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($o['no_batch'] ?: '-') ?></td>
                        <td><strong><?= esc($o['nama_obat']) ?></strong></td>
                        <td><?= esc($o['kategori']) ?></td>
                        <td><?= esc($o['stok']) ?></td>
                        <td><?= esc($o['satuan']) ?></td>
                        <td style="color: <?= $isExpired ? '#ef233c' : 'inherit' ?>; font-weight: bold;">
                            <?= esc($o['expired_date']) ?>
                        </td>
                        <td>
                            <?php if ($isExpired): ?>
                                <span style="background: #f8d7da; color: #721c24; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Expired</span>
                            <?php else: ?>
                                <span style="background: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Mendekati</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pager-container">
        <?= $pager->links('expired', 'default_full') ?>
    </div>
</div>

<?= $this->endSection() ?>
