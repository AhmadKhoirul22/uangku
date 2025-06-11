<?php

namespace App\Controllers;
use App\Models\PengeluaranModel;

class Pengeluaran extends BaseController
{
    protected $pengeluaranModel;

    public function __construct()
    {
        $this->pengeluaranModel = new PengeluaranModel();
    }

    public function index()
    {
        return view('pengeluaran', [
            'title' => 'Pengeluaran'
        ]);
    }

    public function add()
    {
        $keterangan = $this->request->getPost('keterangan');
        $nominal = $this->request->getPost('nominal');
        $tanggal = $this->request->getPost('tanggal');

        // Validasi input sederhana
        if (empty($keterangan) || empty($nominal) || empty($tanggal)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Semua field harus diisi.']);
        }

        // Validasi tambahan (opsional)
        if (!is_numeric($nominal)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Nominal harus berupa angka.']);
        }

        $data = [
            'keterangan' => $keterangan,
            'nominal' => $nominal,
            'tanggal' => $tanggal,
        ];

        if ($this->pengeluaranModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function getData(){
        $data = $this->pengeluaranModel->findAll();
        return $this->response->setJSON($data);
    }
       public function delete($id)
    {
        // $db = \Config\Database::connect();
        // $builder = $db->table('nama_tabel_anda'); // Ganti dengan nama tabel Anda
        // Validasi: Pastikan ID ada dan valid (opsional)
        $builder = $this->pengeluaranModel;
        $data = $builder->find($id);
        if (!$data) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
        }
        $builder->delete(['id' => $id]);
        if ($db->affectedRows() > 0) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }
}
