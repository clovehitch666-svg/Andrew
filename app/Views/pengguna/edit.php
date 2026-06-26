<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>

.form-card {
    max-width: 580px;
    background: white;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.07);
    margin: 10px auto;
}

.form-judul {
    font-size: 22px;
    font-weight: bold;
    color: #2b2b2b;
    margin-bottom: 6px;
}

.form-subjudul {
    font-size: 14px;
    color: #888;
    margin-bottom: 28px;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 16px;
}

.form-group {
    margin-bottom: 18px;
    text-align: left;
}

.form-group label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    color: #444;
}

.form-group input,
.form-group select {
    border: 1.5px solid #ddd;
    border-radius: 7px;
    padding: 10px 13px;
    width: 100%;
    font-size: 15px;
    transition: border-color .2s;
    margin-top: 0;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #59c36a;
    outline: none;
}

.form-group input:disabled {
    background: #f5f5f5;
    cursor: not-allowed;
    color: #999;
}

.form-group small {
    display: block;
    color: #999;
    font-size: 12px;
    margin-top: 5px;
}

.form-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: 28px;
    padding-top: 20px;
    border-top: 2px solid #f0f0f0;
}

.btn-simpan {
    background: #59c36a;
    color: white;
    border: none;
    padding: 11px 30px;
    border-radius: 7px;
    font-weight: bold;
    font-size: 15px;
    cursor: pointer;
    transition: background .2s;
}

.btn-simpan:hover {
    background: #48a958;
}

.btn-batal {
    background: #e0e0e0;
    color: #444;
    text-decoration: none;
    padding: 11px 24px;
    border-radius: 7px;
    font-weight: bold;
    font-size: 15px;
    display: inline-flex;
    align-items: center;
    transition: background .2s;
}

.btn-batal:hover {
    background: #ccc;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 14px;
}

.self-warning {
    background: #fff3cd;
    color: #856404;
    padding: 10px 14px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
}

</style>

<div class="form-card">

    <div class="form-judul">✏️ Edit Pengguna</div>
    <div class="form-subjudul">Ubah informasi akun: <strong><?= esc($user['nama']) ?></strong></div>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert-error">
        ⚠️ <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <?php if ($user['username'] === session()->get('username')): ?>
    <div class="self-warning">
        ⚠️ Anda sedang mengedit akun Anda sendiri. Hati-hati saat mengubah role atau password.
    </div>
    <?php endif; ?>

    <form action="/pengguna/update/<?= $user['id'] ?>" method="post">

        <div class="form-group">
            <label>Nama Lengkap <span style="color:#dc3545">*</span></label>
            <input type="text" name="nama"
                value="<?= esc(old('nama', $user['nama'])) ?>"
                placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group">
            <label>Username <span style="color:#dc3545">*</span></label>
            <input type="text" name="username"
                value="<?= esc(old('username', $user['username'])) ?>"
                placeholder="Masukkan username unik" required>
            <small>Ubah username hanya jika diperlukan. Username harus unik.</small>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password"
                placeholder="Kosongkan jika tidak ingin mengubah password"
                autocomplete="new-password">
            <small>Isi hanya jika ingin mengganti password lama.</small>
        </div>

        <div class="form-group">
            <label>Role / Jabatan <span style="color:#dc3545">*</span></label>
            <select name="role" required>
                <option value="admin"     <?= (old('role', $user['role']) === 'admin')     ? 'selected' : '' ?>>Admin</option>
                <option value="apoteker"  <?= (old('role', $user['role']) === 'apoteker')  ? 'selected' : '' ?>>Apoteker</option>
                <option value="kasir"     <?= (old('role', $user['role']) === 'kasir')     ? 'selected' : '' ?>>Kasir</option>
                <option value="user"      <?= (old('role', $user['role']) === 'user')      ? 'selected' : '' ?>>User</option>
            </select>
            <small>Role menentukan hak akses pengguna di dalam sistem.</small>
        </div>

        <div class="form-group">
            <label>Alamat Email</label>
            <input type="email" name="email"
                value="<?= esc(old('email', $user['email'] ?? '')) ?>"
                placeholder="contoh@domain.com (opsional)">
            <small>Email digunakan untuk menerima notifikasi sistem (opsional).</small>
        </div>

        <div class="form-actions">
            <a href="/pengguna" class="btn-batal">← Batal</a>
            <button type="submit" class="btn-simpan">💾 Simpan Perubahan</button>
        </div>

    </form>

</div>

<?= $this->endSection() ?>
