<?php

namespace App\Controllers;
use App\Models\PemasukanModel;
use App\Models\PengeluaranModel;
use App\Models\UserModel;
class Home extends BaseController
{
    public function index(){
        $pengeluaranModel = new PengeluaranModel();
        $total_today = $pengeluaranModel->dana_keluar_today();
        $total_month = $pengeluaranModel->dana_keluar_month();
        $pengeluaran_harian = $pengeluaranModel->getPengeluaranHarian();
        $pengeluaran_bulanan = $pengeluaranModel->getPengeluaranBulanan();

        $data = [
            'title' => 'Dashboard',
            'total_today' => $total_today,
            'total_month' => $total_month,
            'pengeluaran_harian' => $pengeluaran_harian,
            'pengeluaran_bulanan' => $pengeluaran_bulanan,
        ];
        return view('home',$data);
    }

    public function login(){
        $data = [
            'title' => 'Login'
        ];
        return view('login',$data);
    }

    public function auth()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Ambil data user berdasarkan email
        $user = new userModel();
        $cek = $user->where('email',$email)->first();

        if ($cek) {
            // Verifikasi password menggunakan password_verify
            if (password_verify($password, $cek['password'])) {
                // Jika cocok, set session/login
                session()->set('user_id', $cek['id']);
                session()->set('email', $cek['email']);
                return redirect()->to('/'); // Ganti ke halaman tujuanmu
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }
}
