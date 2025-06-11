<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['keterangan', 'nominal', 'tanggal'];
    protected $useTimestamps = false; // Menonaktifkan fitur timestamps

    public function dana_keluar_today()
    {
        $today = date('Y-m-d'); // Mendapatkan tanggal hari ini
        return $this->where('tanggal', $today)->selectSum('nominal')->first();
    }

    public function dana_keluar_month()
    {
        $month = date('Y-m'); // Mendapatkan bulan dan tahun saat ini
        return $this->like('tanggal', $month, 'after')->selectSum('nominal')->first();
    }

    public function getPengeluaranBulanan()
    {
        $bulan = date('Y-m');
        return $this->where('DATE_FORMAT(tanggal, "%Y-%m") =', $bulan)->findAll();
    }

    public function getPengeluaranHarian()
    {
        $tanggal = date('Y-m-d');
        return $this->where('tanggal', $tanggal)->findAll();
    }
}
