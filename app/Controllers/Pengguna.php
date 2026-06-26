<?php

namespace App\Controllers;
use App\Models\UserModel;

class Pengguna extends BaseController
{
    private function cekAdmin()
    {
        if (!session()->get('login') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }
        return null;
    }

    public function index()
    {
        $redirect = $this->cekAdmin();
        if ($redirect) return $redirect;

        $model = new UserModel();
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['users'] = $model->like('nama', $keyword)
                ->orLike('username', $keyword)
                ->findAll();
        } else {
            $data['users'] = $model->findAll();
        }

        $data['keyword'] = $keyword;
        return view('pengguna/index', $data);
    }

    public function tambah()
    {
        $redirect = $this->cekAdmin();
        if ($redirect) return $redirect;

        return view('pengguna/tambah');
    }

    public function simpan()
    {
        $redirect = $this->cekAdmin();
        if ($redirect) return $redirect;

        $model = new UserModel();

        $username = $this->request->getPost('username');
        // Cek apakah username sudah ada
        $existing = $model->where('username', $username)->first();
        if ($existing) {
            return redirect()->back()->withInput()
                ->with('error', 'Username "' . $username . '" sudah digunakan. Pilih username lain.');
        }

        $model->insert([
            'nama'     => $this->request->getPost('nama'),
            'username' => $username,
            'password' => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role'),
            'email'    => $this->request->getPost('email') ?: null,
        ]);

        return redirect()->to('/pengguna')->with('success', 'Akun pengguna berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $redirect = $this->cekAdmin();
        if ($redirect) return $redirect;

        $model = new UserModel();
        $data['user'] = $model->find($id);

        if (!$data['user']) {
            return redirect()->to('/pengguna')->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('pengguna/edit', $data);
    }

    public function update($id)
    {
        $redirect = $this->cekAdmin();
        if ($redirect) return $redirect;

        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/pengguna')->with('error', 'Pengguna tidak ditemukan.');
        }

        $newUsername = $this->request->getPost('username');
        // Cek username duplikat, kecuali user yang sedang diedit
        $existing = $model->where('username', $newUsername)->where('id !=', $id)->first();
        if ($existing) {
            return redirect()->back()->withInput()
                ->with('error', 'Username "' . $newUsername . '" sudah digunakan. Pilih username lain.');
        }

        $updateData = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $newUsername,
            'role'     => $this->request->getPost('role'),
            'email'    => $this->request->getPost('email') ?: null,
        ];

        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $updateData['password'] = $newPassword;
        }

        $model->update($id, $updateData);

        return redirect()->to('/pengguna')->with('success', 'Akun pengguna berhasil diperbarui!');
    }

    public function hapus($id)
    {
        $redirect = $this->cekAdmin();
        if ($redirect) return $redirect;

        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/pengguna')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Cegah admin menghapus akun dirinya sendiri
        if ($user['username'] === session()->get('username')) {
            return redirect()->to('/pengguna')->with('error', 'Tidak dapat menghapus akun Anda sendiri!');
        }

        $model->delete($id);
        return redirect()->to('/pengguna')->with('success', 'Akun pengguna berhasil dihapus!');
    }
}
