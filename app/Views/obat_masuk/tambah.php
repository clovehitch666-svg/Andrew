<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h2>Tambah Obat Masuk</h2>

<form action="/obatmasuk/simpan" method="post">

    <p>
        <label>Obat</label><br>

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
        <label>Supplier</label><br>

        <select name="supplier_id" required>

            <option value="">
                -- Pilih Supplier --
            </option>

            <?php foreach($supplier as $s): ?>

                <option value="<?= $s['id'] ?>">
                    <?= $s['nama_supplier'] ?>
                </option>

            <?php endforeach ?>

        </select>
    </p>

    <p>
        <label>Jumlah Masuk</label><br>

        <input type="number"
               name="jumlah"
               required>
    </p>

    <p>
        <label>Tanggal Masuk</label><br>

        <input type="date"
               name="tanggal_masuk"
               required>
    </p>

    <p>
        <label>Tanggal Kadaluarsa</label><br>

        <input type="date"
               name="tanggal_kadaluarsa"
               required>
    </p>

    <button type="submit">
        Simpan
    </button>

    <a href="/obatmasuk">
        Kembali
    </a>

</form>

<?= $this->endSection() ?>