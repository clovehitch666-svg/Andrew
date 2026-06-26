<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div style="max-width: 600px; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin: 20px auto;">
    <h2 style="margin-bottom: 20px; color: #2b2b2b;">👤 Profil Saya</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="/profil/save" method="post">
        <div style="margin-bottom: 15px; text-align: left;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Nama Lengkap</label>
            <input type="text" name="nama" value="<?= esc($user['nama']) ?>" required style="border: 1px solid #ddd; border-radius: 6px; padding: 10px; width: 100%;">
        </div>

        <div style="margin-bottom: 15px; text-align: left;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Username</label>
            <input type="text" value="<?= esc($user['username']) ?>" disabled style="border: 1px solid #ddd; border-radius: 6px; padding: 10px; width: 100%; background: #f5f5f5; cursor: not-allowed;">
        </div>

        <div style="margin-bottom: 15px; text-align: left;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Alamat Email (Penerima Notifikasi)</label>
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="email" id="userEmail" name="email" value="<?= esc($user['email']) ?>" placeholder="contoh@domain.com" style="border: 1px solid #ddd; border-radius: 6px; padding: 10px; flex: 1; margin-top: 0;">
                <?php if (!empty($user['email'])): ?>
                    <button type="button" id="btnTestEmail" style="background: #17a2b8; color: white; border: none; border-radius: 6px; padding: 10px 15px; cursor: pointer; font-weight: bold; white-space: nowrap; height: 100%; margin-top: 0;">Tes Kirim Email</button>
                <?php endif; ?>
            </div>
            <small style="color: #666; display: block; margin-top: 5px;">Masukkan alamat email untuk menerima notifikasi sistem (seperti barang kadaluarsa).</small>
        </div>

        <div style="margin-bottom: 25px; text-align: left;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Password Baru</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" style="border: 1px solid #ddd; border-radius: 6px; padding: 10px; width: 100%;">
        </div>

        <div style="text-align: right;">
            <button type="submit" style="font-weight: bold; padding: 12px 30px; background: #59c36a; color: white; border: none; border-radius: 6px; cursor: pointer;">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnTestEmail = document.getElementById('btnTestEmail');
    if (btnTestEmail) {
        btnTestEmail.addEventListener('click', function() {
            const originalText = btnTestEmail.textContent;
            btnTestEmail.textContent = 'Mengirim...';
            btnTestEmail.disabled = true;
            btnTestEmail.style.opacity = '0.7';

            fetch('/profil/test-email', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal menghubungi server');
                return response.json();
            })
            .then(res => {
                alert(res.message);
                if (res.debug) {
                    console.log('Debugger SMTP Info:', res.debug);
                }
            })
            .catch(err => {
                alert(err.message);
            })
            .finally(() => {
                btnTestEmail.textContent = originalText;
                btnTestEmail.disabled = false;
                btnTestEmail.style.opacity = '1';
            });
        });
    }
});
</script>
<?= $this->endSection() ?>
