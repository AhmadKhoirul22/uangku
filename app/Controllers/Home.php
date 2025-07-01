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

    private function sendOtpEmail($toEmail, $otp){
        $email = \Config\Services::email();

        $email->setTo($toEmail);
        $email->setFrom('Ahmad Devs', 'Aplikasi Uangku');

        $email->setSubject('Kode OTP Login Anda');
        $email->setMessage("Kode OTP Anda adalah: <b>$otp</b>. Berlaku 5 menit.");

        if (!$email->send()) {
            log_message('error', 'Gagal mengirim email: ' . $email->printDebugger(['headers']));
        }
    }

    public function auth()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        // password_hash($password, PASSWORD_BCRYPT); // saat menyimpan password / add / registrasi
        // password_verify($password, $user['password']); // saat verifikasi

        // Ambil data user berdasarkan email
        $user = new userModel();
        $cek = $user->where('email',$email)->first();

        if ($cek) {
        $otp = random_int(100000, 999999);

        // Simpan OTP & user ID ke session
        session()->set([
            'otp_user_id' => $cek['id'],
            'otp_code'    => $otp,
            'otp_expiry'  => time() + 300 // berlaku 5 menit
        ]);

        // Kirim OTP ke email
        $this->sendOtpEmail($cek['email'], $otp);
        return redirect()->to('/veriy-otp');
            // Verifikasi password menggunakan password_verify
            // if (password_verify($password, $cek['password'])) {
            //     // Jika cocok, set session/login
            //     session()->set('user_id', $cek['id']);
            //     session()->set('email', $cek['email']);
            //     return redirect()->to('/'); // Ganti ke halaman tujuanmu
            // } else {
            //     return redirect()->back()->with('error', 'Password salah');
            // }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }
    public function veriy_otp(){
        return view('veriy-otp');
    }
    public function verifyOtp(){
        $inputOtp = $this->request->getPost('otp');
        $sessionOtp = session()->get('otp_code');
        $userId = session()->get('otp_user_id');
        $expiry = session()->get('otp_expiry');

        if (!$sessionOtp || time() > $expiry) {
            return redirect()->to('/login')->with('error', 'Kode OTP kedaluwarsa');
        }

        if ($inputOtp == $sessionOtp) {
            // Login berhasil
            $userr = new UserModel();
            $user = $userr->find($userId);
            session()->remove(['otp_code', 'otp_user_id', 'otp_expiry']);
            session()->set([
                'user_id' => $user['id'],
                'email'   => $user['email'],
                // bisa tambahkan session lain
            ]);

            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Kode OTP salah');
        }
    }

    public function logout(){
    // Hapus semua session
    session()->destroy();
    // Redirect ke halaman login (atau halaman utama)
    return redirect()->to('/login')->with('success', 'Anda berhasil logout');
    }

}
