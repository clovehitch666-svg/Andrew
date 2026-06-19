<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>

.status-aman{
    background:#28a745;
    color:white;
    padding:5px 10px;
    border-radius:4px;
}

.status-warning{
    background:#ffc107;
    color:black;
    padding:5px 10px;
    border-radius:4px;
}

.status-expired{
    background:#dc3545;
    color:white;
    padding:5px 10px;
    border-radius:4px;
}

</style>

<div class="title">
    FEFO (First Expired First Out)
</div>

<div style="
background:white;
padding:20px;
border-radius:8px;
">

<h3>Manajemen FEFO</h3>

<p>
Obat dengan tanggal kadaluarsa paling dekat
akan ditampilkan terlebih dahulu.
</p>

<br>

<table>

<tr>
    <th>No</th>
    <th>Nama Obat</th>
    <th>Tanggal Kadaluarsa</th>
    <th>Sisa Hari</th>
    <th>Status</th>
</tr>

<?php

$no = 1;

foreach($obat as $o):

$today = strtotime(date('Y-m-d'));

$expired = strtotime($o['expired_date']);

$selisih = floor(($expired - $today) / 86400);

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $o['nama_obat'] ?></td>

<td>
<?= date('d-m-Y', strtotime($o['expired_date'])) ?>
</td>

<td>

<?php

if($selisih < 0){

    echo 'Kadaluarsa';

}else{

    echo $selisih . ' Hari';

}

?>

</td>

<td>

<?php if($selisih < 0): ?>

<span class="status-expired">
Kadaluarsa
</span>

<?php elseif($selisih <= 30): ?>

<span class="status-warning">
Segera Habis
</span>

<?php else: ?>

<span class="status-aman">
Aman
</span>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

<?php if(empty($obat)): ?>

<tr>
    <td colspan="5" align="center">
        Belum ada data FEFO
    </td>
</tr>

<?php endif; ?>

</table>

</div>

<?= $this->endSection() ?>