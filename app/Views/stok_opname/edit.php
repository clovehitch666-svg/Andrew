<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h2>Tambah Stok Opname</h2>

<form action="/stokopname/simpan" method="post">

    <p>
        <label>Obat</label>

        <select name="obat_id" required>

            <option value="">
                -- Pilih Obat --
            </option>

            <?php foreach($obat as $o): ?>

            <option value="<?= $o['id'] ?>">
                <?= $o['nama_obat'] ?>
            </option>

            <?php endforeach ?>

        </select>
    </p>

    <p>
        <label>Stok Fisik</label>

        <input
            type="number"
            name="stok_fisik"
            required>
    </p>

    <br>

    <button type="submit">
        Simpan
    </button>

    <a href="/stokopname" class="btn">
        Kembali
    </a>

</form>

<?= $this->endSection() ?>