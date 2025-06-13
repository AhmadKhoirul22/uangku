<?php

namespace App\Controllers;
use App\Models\PemasukanModel;

class Pemasukan extends BaseController
{
    protected $pemasukanModel;
    public function __construct(){
        $this->pemasukanModel = new PemasukanModel();
    }
    public function index(){
        return view('pemasukan',[
            'title' => 'Pemasukan'
        ]);
    }
    public function getData() {
    $data = $this->pemasukanModel->orderBy('tanggal', 'DESC')->findAll();
    return $this->response->setJSON($data);
    }

    public function add(){
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

        if ($this->pemasukanModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
        }
    }
}
