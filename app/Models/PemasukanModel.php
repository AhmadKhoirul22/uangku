<?php
namespace App\Models;

use CodeIgniter\Model;

class PemasukanModel extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['keterangan','nominal','tanggal'];
}
