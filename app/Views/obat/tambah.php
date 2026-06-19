<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>

.form-card{
    background:white;
    padding:30px;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}

.form-group input,
.form-group select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:4px;
}

.btn-simpan{
    background:#28a745;
    color:white;
    border:none;
    padding:10px 20px;
    cursor:pointer;
    border-radius:4px;
}

.btn-kembali{
    background:#6c757d;
    color:white;
    padding:10px 20px;
    text-decoration:none;
    border-radius:4px;
}

</style>

<h2>Tambah Data Obat</h2>

<div class="form-card">

<form action="/obat/simpan" method="post">

    <div class="form-group">
        <label>Rak</label>
        <input type="text" name="rak" required>
    </div>

    <div class="form-group">
        <label>Nama Obat</label>
        <input type="text" name="nama_obat" required>
    </div>

    <div class="form-group">
        <label>Jenis Obat</label>
        <input type="text" name="jenis_obat" required>
    </div>

    <div class="form-group">
        <label>Kategori</label>
        <input type="text" name="kategori" required>
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" required>
    </div>

    <div class="form-group">
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" required>
    </div>

    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" required>
    </div>

    <div class="form-group">
        <label>Tanggal Kadaluarsa</label>
        <input type="date" name="expired_date" required>
    </div>

    <div class="form-group">
        <label>Satuan</label>

        <select name="satuan" required>
            <option value="">-- Pilih Satuan --</option>
            <option value="Tablet">Tablet</option>
            <option value="Kapsul">Kapsul</option>
            <option value="Strip">Strip</option>
            <option value="Botol">Botol</option>
            <option value="Tube">Tube</option>
            <option value="Sachet">Sachet</option>
        </select>

    </div>

    <div class="form-group">
        <label>Stok Minimum</label>
        <input type="number" name="stok_minimum" value="10" required>
    </div>

    <button type="submit" class="btn-simpan">
        Simpan
    </button>

    <a href="/obat" class="btn-kembali">
        Kembali
    </a>

</form>

</div>

<?= $this->endSection() ?>