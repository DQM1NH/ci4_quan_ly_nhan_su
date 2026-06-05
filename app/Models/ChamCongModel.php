<?php

namespace App\Models;

use CodeIgniter\Model;

class ChamCongModel extends Model
{
    protected $table ='cham_cong';
    protected $primaryKey ='cham_cong_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nhan_vien_id',
        'ca_lam_id',
        'ngay_cham_cong',
        'check_in',
        'check_out',
        'gio_lam',
        'trang_thai',
        'ghi_chu'
    ];

    public function getAllChamCong()
    {
        return $this

            ->select('cham_cong.*, nhan_vien.ho_ten, nhan_vien.ma_nhan_vien, ca_lam.ten_ca')

            ->join('nhan_vien', 'nhan_vien.nhan_vien_id = cham_cong.nhan_vien_id')

            ->join( 'ca_lam', 'ca_lam.ca_lam_id = cham_cong.ca_lam_id')

            ->orderBy('cham_cong_id', 'ASC')

            ->findAll();
    }

    public function getChamCongByNhanVien($nhanVienId)
    {
        return $this
            ->select('
                cham_cong.*,
                nhan_vien.ho_ten,
                nhan_vien.ma_nhan_vien,
                ca_lam.ten_ca
            ')
            ->join(
                'nhan_vien',
                'nhan_vien.nhan_vien_id = cham_cong.nhan_vien_id'
            )
            ->join(
                'ca_lam',
                'ca_lam.ca_lam_id = cham_cong.ca_lam_id'
            )
            ->where(
                'cham_cong.nhan_vien_id',
                $nhanVienId
            )
            ->orderBy('cham_cong_id', 'DESC')
            ->findAll();
    }
}