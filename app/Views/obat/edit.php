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

.btn-update{
    background:#007bff;
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

<h2>Edit Data Obat</h2>

<div class="form-card">

<form action="/obat/update/<?= $obat['id'] ?>" method="post">

    <div class="form-group">
        <label>Rak</label>
        <input
            type="text"
            name="rak"
            value="<?= $obat['rak'] ?>"
            required>
    </div>

    <div class="form-group">
        <label>Nama Obat</label>
        <input
            type="text"
            name="nama_obat"
            value="<?= $obat['nama_obat'] ?>"
            required>
    </div>

    <div class="form-group">
        <label>Jenis Obat</label>
        <input
            type="text"
            name="jenis_obat"
            value="<?= $obat['jenis_obat'] ?>"
            required>
    </div>

    <div class="form-group">
        <label>Kategori</label>
        <input
            type="text"
            name="kategori"
            value="<?= $obat['kategori'] ?>"
            required>
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input
            type="number"
            name="harga_beli"
            value="<?= $obat['harga_beli'] ?>"
            required>
    </div>

    <div class="form-group">
        <label>Harga Jual</label>
        <input
            type="number"
            name="harga_jual"
            value="<?= $obat['harga_jual'] ?>"
            required>
    </div>

    <div class="form-group">
        <label>Stok</label>
        <input
            type="number"
            name="stok"
            value="<?= $obat['stok'] ?>"
            required>
    </div>

    <div class="form-group">
        <label>Tanggal Kadaluarsa</label>
        <input
            type="date"
            name="expired_date"
            value="<?= $obat['expired_date'] ?>"
            required>
    </div>

    <div class="form-group">
        <label>Satuan</label>

        <select name="satuan" required>

            <option value="Tablet" <?= ($obat['satuan']=='Tablet')?'selected':'' ?>>
                Tablet
            </option>

            <option value="Kapsul" <?= ($obat['satuan']=='Kapsul')?'selected':'' ?>>
                Kapsul
            </option>

            <option value="Strip" <?= ($obat['satuan']=='Strip')?'selected':'' ?>>
                Strip
            </option>

            <option value="Botol" <?= ($obat['satuan']=='Botol')?'selected':'' ?>>
                Botol
            </option>

            <option value="Tube" <?= ($obat['satuan']=='Tube')?'selected':'' ?>>
                Tube
            </option>

            <option value="Sachet" <?= ($obat['satuan']=='Sachet')?'selected':'' ?>>
                Sachet
            </option>

        </select>

    </div>

    <div class="form-group">
        <label>Stok Minimum</label>
        <input
            type="number"
            name="stok_minimum"
            value="<?= $obat['stok_minimum'] ?>"
            required>
    </div>

    <button type="submit" class="btn-update">
        Update
    </button>

    <a href="/obat" class="btn-kembali">
        Kembali
    </a>

</form>

</div>

<?= $this->endSection() ?>