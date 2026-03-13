<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidebar'); ?>

<h3>Data Obat</h3>

<a href="/obat/tambah">Tambah Obat</a>

<table border="1">

<tr>
<th>Nama</th>
<th>Jenis</th>
<th>Harga Jual</th>
<th>Stok</th>
</tr>

<?php foreach($obat as $o): ?>

<tr>
<td><?= $o['nama_obat'] ?></td>
<td><?= $o['jenis_obat'] ?></td>
<td><?= $o['harga_jual'] ?></td>
<td><?= $o['stok'] ?></td>
</tr>

<?php endforeach ?>

</table>

<?= $this->include('layout/footer'); ?>