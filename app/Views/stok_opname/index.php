<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>

.judul{
    font-size:32px;
    font-weight:bold;
    margin-bottom:10px;
}

.periode{
    margin-bottom:25px;
}

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    margin-bottom:20px;
    border-radius:5px;
}

.btn-simpan{
    background:#28a745;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:4px;
    cursor:pointer;
}

.btn-simpan:hover{
    background:#218838;
}

.input-stok{
    width:80px;
    padding:6px;
    text-align:center;
}

.status-hijau{
    color:#28a745;
    font-weight:bold;
}

.status-merah{
    color:red;
    font-weight:bold;
}

.custom-nav{
    margin-top:40px;
    background:black;
    height:24px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding-left:10px;
}

.nav-left{
    color:white;
    font-size:20px;
}

.nav-left a{
    color:white;
    text-decoration:none;
}

.nav-right{
    background:#d9d9d9;
    padding:2px 18px;
    font-size:18px;
    font-weight:bold;
}

@media print {
    .sidebar, .header, .custom-nav, .btn-simpan, .no-print, button {
        display: none !important;
    }
    .content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    body {
        background: white !important;
    }
    .input-stok {
        border: none !important;
        outline: none !important;
        background: transparent !important;
        box-shadow: none !important;
    }
}

</style>

<div class="judul">
    LAPORAN STOK OPNAME - APOTEK BARAYA
</div>

<div class="periode" style="display: flex; justify-content: space-between; align-items: center;">
    <span>Periode: <?= date('F Y') ?></span>
    <?php if (session()->get('role') === 'admin'): ?>
        <div class="no-print" style="display: flex; gap: 10px;">
            <button onclick="window.print()" style="padding: 10px 15px; background: #1f76be; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">🖨️ Cetak Laporan</button>
            <a href="/stokopname/download" class="btn" style="background: #28a745; line-height: 22px; font-weight: bold;">📥 Unduh Excel/CSV</a>
        </div>
    <?php endif; ?>
</div>

<?php if(session()->getFlashdata('success')): ?>

<div class="alert-success">
    <?= session()->getFlashdata('success') ?>
</div>

<?php endif; ?>

<?php

$page = isset($_GET['page_stokopname'])
    ? (int)$_GET['page_stokopname']
    : 1;

$no = 1 + (($page - 1) * 10);

?>

<table>

<tr>
    <th>NO</th>
    <th>RAK</th>
    <th>NAMA OBAT</th>
    <th>STOK SISTEM</th>
    <th>STOK FISIK</th>
    <th>SELISIH</th>
    <th>KETERANGAN</th>
    <th>AKSI</th>
</tr>

<?php foreach($obat as $o): ?>

<tr>

<td><?= $no++ ?></td>

<td><?= $o['rak'] ?></td>

<td><?= $o['nama_obat'] ?></td>

<td><?= $o['stok'] ?></td>

<td>

<form action="/stokopname/simpan" method="post">

<input
    type="hidden"
    name="obat_id"
    value="<?= $o['id'] ?>">

<input
    type="hidden"
    name="stok_sistem"
    value="<?= $o['stok'] ?>">

<input
    type="number"
    name="stok_fisik"
    value="<?= $o['stok_fisik'] ?>"
    class="input-stok"
    required>

</td>

<td>

<?php if($o['selisih'] !== ''): ?>

    <?php if($o['selisih'] == 0): ?>

        <span class="status-hijau">
            <?= $o['selisih'] ?>
        </span>

    <?php else: ?>

        <span class="status-merah">
            <?= $o['selisih'] ?>
        </span>

    <?php endif; ?>

<?php endif; ?>

</td>

<td>

<?= $o['keterangan'] ?>

</td>

<td>

<button type="submit" class="btn-simpan">
    Simpan
</button>

</form>

</td>

</tr>

<?php endforeach; ?>

</table>

<div class="custom-nav">

<div class="nav-left">

<?php if($page > 1): ?>

<a href="?page_stokopname=<?= $page-1 ?>">
⬅
</a>

<?php else: ?>

⬅

<?php endif; ?>

</div>

<div class="nav-right">

<?php if(count($obat) >= 10): ?>

<a href="?page_stokopname=<?= $page+1 ?>">
Next
</a>

<?php else: ?>

Next

<?php endif; ?>

</div>

</div>

<?= $this->endSection() ?>