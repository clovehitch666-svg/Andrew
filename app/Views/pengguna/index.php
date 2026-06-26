<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>

.judul {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 10px;
}

.periode {
    margin-bottom: 25px;
    color: #666;
    font-size: 15px;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.btn-tambah {
    background: #59c36a;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background .2s;
}

.btn-tambah:hover {
    background: #48a958;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-box label {
    font-weight: bold;
    font-size: 16px;
}

.search-box input {
    padding: 8px 12px;
    width: 220px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-top: 0;
}

.search-box button {
    padding: 8px 16px;
    background: #59c36a;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.search-box button:hover {
    background: #48a958;
}

.table-pengguna {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
}

.table-pengguna th {
    background: #d9dde1;
    border: 1px solid #666;
    padding: 12px;
    text-align: center;
    font-size: 16px;
}

.table-pengguna td {
    border: 1px solid #ddd;
    padding: 11px 12px;
    text-align: center;
    font-size: 15px;
}

.table-pengguna tr:hover td {
    background: #f5f5f5;
}

.badge-admin {
    background: #1f76be;
    color: white;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
}

.badge-apoteker {
    background: #59c36a;
    color: white;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
}

.badge-kasir {
    background: #8a7ddc;
    color: white;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
}

.badge-user {
    background: #888;
    color: white;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
}

.btn-edit {
    background: #ffc107;
    color: black;
    text-decoration: none;
    padding: 7px 14px;
    border-radius: 5px;
    display: inline-block;
    margin-bottom: 4px;
    font-weight: 500;
    font-size: 14px;
    transition: opacity .2s;
}

.btn-edit:hover {
    opacity: .85;
}

.btn-hapus {
    background: #dc3545;
    color: white;
    text-decoration: none;
    padding: 7px 14px;
    border-radius: 5px;
    display: inline-block;
    font-weight: 500;
    font-size: 14px;
    transition: opacity .2s;
}

.btn-hapus:hover {
    opacity: .85;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.current-user-row td {
    background: #f0fdf4 !important;
}

</style>

<div class="judul">
    👥 KELOLA PENGGUNA
</div>

<div class="periode">
    Manajemen akun pengguna sistem Apotek Baraya
</div>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert-success">
    ✅ <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<div class="alert-error">
    ⚠️ <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<div class="top-bar">

    <a href="/pengguna/tambah" class="btn-tambah">
        ➕ Tambah Pengguna
    </a>

    <form method="get" class="search-box">
        <label>Search :</label>
        <input
            type="text"
            name="keyword"
            value="<?= esc($keyword ?? '') ?>"
            placeholder="Cari nama / username">
        <button type="submit">Cari</button>
    </form>

</div>

<table class="table-pengguna">

<tr>
    <th width="50">NO</th>
    <th>NAMA LENGKAP</th>
    <th>USERNAME</th>
    <th>EMAIL</th>
    <th width="130">ROLE</th>
    <th width="200">AKSI</th>
</tr>

<?php $no = 1; ?>
<?php foreach ($users as $u): ?>

<tr <?= ($u['username'] === session()->get('username')) ? 'class="current-user-row"' : '' ?>>

    <td><?= $no++ ?></td>

    <td>
        <?= esc($u['nama']) ?>
        <?php if ($u['username'] === session()->get('username')): ?>
            <span style="font-size:12px; color:#59c36a; font-weight:bold;"> (Anda)</span>
        <?php endif; ?>
    </td>

    <td><?= esc($u['username']) ?></td>

    <td><?= esc($u['email'] ?: '-') ?></td>

    <td>
        <?php
            $roleClass = match($u['role']) {
                'admin'    => 'badge-admin',
                'apoteker' => 'badge-apoteker',
                'kasir'    => 'badge-kasir',
                default    => 'badge-user',
            };
        ?>
        <span class="<?= $roleClass ?>">
            <?= ucfirst(esc($u['role'])) ?>
        </span>
    </td>

    <td style="white-space: nowrap;">
        <a href="/pengguna/edit/<?= $u['id'] ?>" class="btn-edit">✏ Edit</a>

        <?php if ($u['username'] !== session()->get('username')): ?>
        <a href="/pengguna/hapus/<?= $u['id'] ?>"
            onclick="return confirm('Yakin ingin menghapus akun <?= esc($u['nama']) ?>?')"
            class="btn-hapus">🗑 Hapus</a>
        <?php endif; ?>
    </td>

</tr>

<?php endforeach; ?>

<?php if (empty($users)): ?>
<tr>
    <td colspan="6" style="padding: 30px; color: #888; font-style: italic;">
        <?= $keyword ? 'Tidak ada pengguna yang cocok dengan pencarian.' : 'Belum ada data pengguna.' ?>
    </td>
</tr>
<?php endif; ?>

</table>

<div style="margin-top: 16px; color: #888; font-size: 13px;">
    Total: <?= count($users) ?> pengguna
</div>

<?= $this->endSection() ?>
