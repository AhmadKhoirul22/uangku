<?php

namespace App\Controllers;
use App\Models\PemasukanModel;
use App\Models\PengeluaranModel;
class Home extends BaseController
{
    public function index(){
        
        $data = [
            'title' => 'Dashboard'
        ];
        return view('home',$data);
    }
}
