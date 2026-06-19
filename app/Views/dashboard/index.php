<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>

.dashboard-title{
    font-size:30px;
    font-weight:bold;
    margin-bottom:25px;
}

.card-container{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:30px;
}

.card{
    flex:1;
    min-width:250px;
    min-height:170px;
    border-radius:12px;
    color:white;
    padding:25px;
    position:relative;
    overflow:hidden;
    box-shadow:0 4px 10px rgba(0,0,0,.15);
}

.card span{
    display:block;
    font-size:58px;
    font-weight:bold;
    margin-bottom:15px;
}

.card h2{
    font-size:24px;
}

/* ICON */

.card-icon{
    position:absolute;
    right:20px;
    bottom:10px;
    font-size:80px;
    opacity:.25;
}

/* COLORS */

.blue{
    background:#1f76be;
}

.red{
    background:#ef233c;
}

.green{
    background:#59c36a;
}

.welcome-box{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 3px 8px rgba(0,0,0,.1);
}

</style>

<div class="dashboard-title">
    Dashboard Apotek Baraya
</div>

<div class="card-container">

    <div class="card blue">

        <span><?= $jumlahObat ?></span>

        <h2>Total Obat</h2>

        <div class="card-icon">
            💊
        </div>

    </div>

    <div class="card red">

        <span><?= $stokMenipis ?></span>

        <h2>Stok Menipis</h2>

        <div class="card-icon">
            ⚠️
        </div>

    </div>

    <div class="card green">

        <span><?= $totalStok ?></span>

        <h2>Total Stok</h2>

        <div class="card-icon">
            📦
        </div>

    </div>

</div>

<div class="welcome-box">

    <h2>Selamat Datang</h2>

    <br>

    <p>
        Sistem Informasi Apotek Baraya digunakan untuk mengelola data obat,
        stok obat, stok opname, rekap stok, FEFO (First Expired First Out),
        serta laporan persediaan obat.
    </p>

</div>

<?= $this->endSection() ?>