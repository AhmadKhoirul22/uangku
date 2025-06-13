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
}
