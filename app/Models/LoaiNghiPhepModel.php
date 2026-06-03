<?php

namespace App\Models;

use CodeIgniter\Model;

class LoaiNghiPhepModel extends Model
{
    protected $table = 'loai_nghi_phep';

    protected $primaryKey = 'loai_nghi_phep_id';

    protected $allowedFields = [
        'ten_loai_nghi',
        'nghi_co_luong',
        'so_ngay_toi_da',
        'mo_ta'
    ];
}