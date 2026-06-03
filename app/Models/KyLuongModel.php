<?php
namespace App\Models;

use CodeIgniter\Model;

class KyLuongModel extends Model
{
    protected $table = 'ky_luong';
    protected $primaryKey = 'ky_luong_id';
    protected $allowedFields = [
        'thang',
        'nam',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'trang_thai'
    ];
}