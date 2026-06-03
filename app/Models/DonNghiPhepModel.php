<?php

namespace App\Models;

use CodeIgniter\Model;

class DonNghiPhepModel extends Model
{
    protected $table =
        'don_nghi_phep';

    protected $primaryKey =
        'don_nghi_phep_id';

    protected $allowedFields = [

        'nhan_vien_id',
        'loai_nghi_phep_id',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'tong_so_ngay',
        'ly_do',
        'trang_thai',
        'nguoi_duyet',
        'ngay_duyet'
    ];
}