<?php

namespace App\Controllers;
use App\Models\PemasukanModel;

class Pemasukan extends BaseController
{
    public function index(): string
    {
        return view('pemasukan',[
            'title' => 'Pemasukan'
        ]);
    }
}
