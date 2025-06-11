<?php

namespace App\Controllers;
use App\Models\PemasukanModel;
use App\Models\PengeluaranModel;
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
}
