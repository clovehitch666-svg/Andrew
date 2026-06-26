<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username',$username)->first();

        if($user){
            if($password == $user['password']){
                session()->set([
                    'login'    => true,
                    'username' => $user['username'],
                    'nama'     => $user['nama'],
                    'role'     => $user['role']
                ]);
                return redirect()->to('/dashboard');
            }
        }

        return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function profil()
    {
        if (!session()->get('login')) {
            return redirect()->to('/');
        }

        $model = new UserModel();
        $username = session()->get('username');
        $data['user'] = $model->where('username', $username)->first();

        return view('auth/profil', $data);
    }

    public function saveProfil()
    {
        if (!session()->get('login')) {
            return redirect()->to('/');
        }

        $model = new UserModel();
        $username = session()->get('username');
        $user = $model->where('username', $username)->first();

        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $newPassword = $this->request->getPost('password');

        $updateData = [
            'nama' => $nama,
            'email' => $email ?: null,
        ];

        if (!empty($newPassword)) {
            $updateData['password'] = $newPassword;
        }

        $model->update($user['id'], $updateData);

        session()->set([
            'nama' => $nama
        ]);

        return redirect()->to('/profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function testEmail()
    {
        if (!session()->get('login')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Unauthorized'])->setStatusCode(401);
        }

        $model = new UserModel();
        $username = session()->get('username');
        $user = $model->where('username', $username)->first();

        if (empty($user['email'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Silakan isi dan simpan alamat email Anda terlebih dahulu!'
            ]);
        }

        $email = \Config\Services::email();
        
        $email->setTo($user['email']);
        $email->setSubject('Tes Koneksi Email SMTP Apotek Baraya');
        $email->setMessage('Halo ' . $user['nama'] . ",\n\nIni adalah email uji coba dari sistem Apotek Baraya. Jika Anda menerima email ini, berarti pengaturan SMTP Google Anda di berkas .env sudah berfungsi dengan benar!");

        if ($email->send()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Email uji coba berhasil dikirim ke ' . $user['email']
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengirim email. Silakan periksa kredensial SMTP Anda.',
                'debug' => $email->printDebugger(['headers', 'subject', 'body'])
            ]);
        }
    }
}