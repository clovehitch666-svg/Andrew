<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>

.custom-nav{
    margin-top:30px;
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
    color:black;
    text-decoration:none;
}

.title{
    font-size:28px;
    font-weight:bold;
    margin-bottom:20px;
}

</style>

<div class="title">
    Laporan Data Obat
</div>

<?php

$page = (int) ($pager->getCurrentPage('laporan') ?? 1);

$perPage = 10;

$no = 1 + (($page - 1) * $perPage);

?>

<table>

<tr>
    <th>No</th>
    <th>Nama Obat</th>
    <th>Jenis</th>
    <th>Satuan</th>
    <th>Harga Beli</th>
    <th>Harga Jual</th>
    <th>Stok</th>
    <th>Stok Minimum</th>
</tr>

<?php foreach($obat as $o): ?>

<tr>

    <td><?= $no++ ?></td>

    <td><?= $o['nama_obat'] ?></td>
    <td><?= $o['jenis_obat'] ?></td>
    <td><?= $o['satuan'] ?></td>

    <td>
        Rp <?= number_format($o['harga_beli'],0,',','.') ?>
    </td>

    <td>
        Rp <?= number_format($o['harga_jual'],0,',','.') ?>
    </td>

    <td><?= $o['stok'] ?></td>

    <td><?= $o['stok_minimum'] ?></td>

</tr>

<?php endforeach ?>

</table>

<div class="custom-nav">

    <div class="nav-left">

        <?php if($page > 1): ?>

            <a href="?page_laporan=<?= $page - 1 ?>">
                ⬅
            </a>

        <?php else: ?>

            ⬅

        <?php endif; ?>

    </div>

    <div class="nav-right">

        <?php if(count($obat) >= 10): ?>

            <a href="?page_laporan=<?= $page + 1 ?>">
                Next
            </a>

        <?php else: ?>

            Next

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>