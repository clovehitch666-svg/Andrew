<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h2>Data Obat Masuk</h2>

<a href="/obatmasuk/tambah">
    + Tambah Obat Masuk
</a>

<br><br>

<table border="1" width="100%" cellpadding="10">

<tr>
    <th>Obat</th>
    <th>Supplier</th>
    <th>Jumlah</th>
    <th>Tanggal Masuk</th>
    <th>Tanggal Kadaluarsa</th>
    <th>Status</th>
</tr>

<?php foreach($obat_masuk as $o): ?>

<tr>
    <td><?= $o['nama_obat'] ?></td>
    <td><?= $o['nama_supplier'] ?></td>
    <td><?= $o['jumlah'] ?></td>
    <td><?= $o['tanggal_masuk'] ?></td>
    <td><?= $o['tanggal_kadaluarsa'] ?></td>

    <td>

        <?php if($o['status_kadaluarsa'] == 'expired'): ?>

            <span style="color:red">
                Expired
            </span>

        <?php elseif($o['status_kadaluarsa'] == 'hampir_expired'): ?>

            <span style="color:orange">
                Hampir Expired
            </span>

        <?php else: ?>

            <span style="color:green">
                Aman
            </span>

        <?php endif ?>

    </td>

</tr>

<?php endforeach ?>

</table>

<?= $this->endSection() ?>