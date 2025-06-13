<?php
namespace App\Models;

use CodeIgniter\Model;

class PemasukanModel extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['keterangan','nominal','tanggal'];

        public function dana_masuk_today()
    {
        $today = date('Y-m-d'); // Mendapatkan tanggal hari ini
        return $this->where('tanggal', $today)->selectSum('nominal')->first();
    }

    public function dana_masuk_month()
    {
        $month = date('Y-m'); // Mendapatkan bulan dan tahun saat ini
        return $this->like('tanggal', $month, 'after')->selectSum('nominal')->first();
    }

    public function getPemasukanBulanan()
    {
        $bulan = date('Y-m');
        return $this->where('DATE_FORMAT(tanggal, "%Y-%m") =', $bulan)->findAll();
    }

    public function getPemasukanHarian()
    {
        $tanggal = date('Y-m-d');
        return $this->where('tanggal', $tanggal)->findAll();
    }
}
