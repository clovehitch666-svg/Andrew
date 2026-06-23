<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>
@media print {
    .sidebar, .header, .no-print, button {
        display: none !important;
    }
    .content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    body {
        background: white !important;
    }
}
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2 style="font-size: 30px; font-weight: bold;">Rekapitulasi Stok Obat</h2>
    <?php if (session()->get('role') === 'admin'): ?>
        <div class="no-print" style="display: flex; gap: 10px;">
            <button onclick="window.print()" style="padding: 10px 15px; background: #1f76be; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">🖨️ Cetak Laporan</button>
            <a href="/rekap/download" class="btn" style="background: #28a745; line-height: 22px; font-weight: bold;">📥 Unduh Excel/CSV</a>
        </div>
    <?php endif; ?>
</div>

<div style="background:white;padding:20px;border-radius:8px;box-shadow:0 3px 8px rgba(0,0,0,.1);">
    <p>
        Halaman ini menampilkan ringkasan stok obat yang tersedia di apotek.
    </p>
</div>

<?= $this->endSection() ?>