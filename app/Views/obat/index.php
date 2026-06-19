<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>

.judul{
    font-size:30px;
    font-weight:bold;
    margin-bottom:10px;
}

.periode{
    margin-bottom:25px;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.btn-tambah{
    background:#d9d9d9;
    color:black;
    padding:12px 20px;
    text-decoration:none;
    font-weight:bold;
    font-size:18px;
}

.search-box{
    display:flex;
    align-items:center;
    gap:10px;
}

.search-box label{
    font-weight:bold;
    font-size:18px;
}

.search-box input{
    padding:8px;
    width:220px;
}

.table-obat{
    width:100%;
    border-collapse:collapse;
    background:white;
}

.table-obat th{
    background:#d9dde1;
    border:1px solid #666;
    padding:12px;
    text-align:center;
    font-size:18px;
}

.table-obat td{
    border:1px solid #666;
    padding:10px;
    text-align:center;
    font-size:16px;
}

.table-obat tr:hover{
    background:#f5f5f5;
}

.badge-aman{
    background:#28a745;
    color:white;
    padding:6px 14px;
    border-radius:5px;
}

.badge-menipis{
    background:red;
    color:white;
    padding:6px 14px;
    border-radius:5px;
}

/* TOMBOL */

.btn-edit{
    background:#ffc107;
    color:black;
    text-decoration:none;
    padding:8px 12px;
    border-radius:4px;
    display:inline-block;
    min-width:80px;
    margin-bottom:4px;
}

.btn-hapus{
    background:#dc3545;
    color:white;
    text-decoration:none;
    padding:8px 12px;
    border-radius:4px;
    display:inline-block;
    min-width:80px;
}

/* PAGINATION */

.custom-nav{
    margin-top:35px;
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
    padding:2px 20px;
    font-size:18px;
    font-weight:bold;
}

.nav-right a{
    text-decoration:none;
    color:black;
}

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    border-radius:5px;
    margin-bottom:15px;
}

</style>

<div class="judul">
    TABEL MASTER OBAT - APOTEK BARAYA
</div>

<div class="periode">
    Periode: <?= date('F Y') ?>
</div>

<?php if(session()->getFlashdata('success')): ?>

<div class="alert-success">
    <?= session()->getFlashdata('success') ?>
</div>

<?php endif; ?>

<div class="top-bar">

    <a href="/obat/tambah" class="btn-tambah">
        + Tambah Obat
    </a>

    <form method="get" class="search-box">

        <label>Search :</label>

        <input
            type="text"
            name="keyword"
            value="<?= $_GET['keyword'] ?? '' ?>"
            placeholder="Cari obat">

        <button type="submit">
            Cari
        </button>

    </form>

</div>

<?php

$page = isset($_GET['page_obat'])
    ? (int) $_GET['page_obat']
    : 1;

$perPage = 10;

$no = 1 + (($page - 1) * $perPage);

?>

<table class="table-obat">

<tr>
    <th width="50">NO</th>
    <th width="70">RAK</th>
    <th>NAMA OBAT</th>
    <th>JENIS</th>
    <th>KATEGORI</th>
    <th>HARGA BELI</th>
    <th>HARGA JUAL</th>
    <th width="80">STOK</th>
    <th>SATUAN</th>
    <th width="120">E D</th>
    <th width="120">STATUS</th>
    <th width="220">AKSI</th>
</tr>

<?php foreach($obat as $o): ?>

<tr>

<td><?= $no++ ?></td>

<td><?= $o['rak'] ?? '-' ?></td>

<td><?= $o['nama_obat'] ?></td>

<td><?= $o['jenis_obat'] ?></td>

<td><?= $o['kategori'] ?? '-' ?></td>

<td>
Rp <?= number_format($o['harga_beli'],0,',','.') ?>
</td>

<td>
Rp <?= number_format($o['harga_jual'],0,',','.') ?>
</td>

<td><?= $o['stok'] ?></td>

<td><?= $o['satuan'] ?></td>

<td>

<?php if(!empty($o['expired_date'])): ?>

<?= date('d/m/Y', strtotime($o['expired_date'])) ?>

<?php else: ?>

-

<?php endif; ?>

</td>

<td>

<?php if($o['stok'] <= $o['stok_minimum']) : ?>

<span class="badge-menipis">
Menipis
</span>

<?php else : ?>

<span class="badge-aman">
Aman
</span>

<?php endif ?>

</td>

<td style="white-space:nowrap;">

<a href="/obat/edit/<?= $o['id'] ?>"
class="btn-edit">
✏ Edit
</a>

<a href="/obat/hapus/<?= $o['id'] ?>"
onclick="return confirm('Yakin ingin menghapus data?')"
class="btn-hapus">
🗑 Hapus
</a>

</td>

</tr>

<?php endforeach ?>

</table>

<?php

$hasNext = count($obat) == 10;

?>

<div class="custom-nav">

    <div class="nav-left">

        <?php if($page > 1): ?>

            <a href="?page_obat=<?= $page-1 ?>">
                ⬅
            </a>

        <?php else: ?>

            ⬅

        <?php endif; ?>

    </div>

    <div class="nav-right">

        <?php if($hasNext): ?>

            <a href="?page_obat=<?= $page+1 ?>">
                Next
            </a>

        <?php else: ?>

            Next

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>