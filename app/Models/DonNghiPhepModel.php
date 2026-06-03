<?php

namespace App\Models;

use CodeIgniter\Model;

class DonNghiPhepModel extends Model
{
    protected $table = 'don_nghi_phep';

    protected $primaryKey = 'don_nghi_phep_id';

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

    public function getAll()
    {
        return $this

            ->select('
                don_nghi_phep.*,
                nhan_vien.ho_ten,
                loai_nghi_phep.ten_loai_nghi
            ')

            ->join(
                'nhan_vien',
                'nhan_vien.nhan_vien_id
                = don_nghi_phep.nhan_vien_id'
            )

            ->join(
                'loai_nghi_phep',
                'loai_nghi_phep.loai_nghi_phep_id
                = don_nghi_phep.loai_nghi_phep_id'
            )

            ->orderBy(
                'don_nghi_phep_id',
                'DESC'
            )

            ->findAll();
    }
}