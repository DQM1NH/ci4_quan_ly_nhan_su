<?php

namespace App\Models;

use CodeIgniter\Model;

class KTKLModel extends Model
{
    protected $table = 'khen_thuong_ky_luat';
    protected $primaryKey = 'ktkl_id';
    protected $returnType = 'array';

    protected $allowedFields = [

        'nhan_vien_id',
        'loai',
        'so_tien',
        'ly_do',
        'ngay_ap_dung',
        'nguoi_tao'
    ];

    public function getAllKTKL()
    {
        return $this

            ->select('
                khen_thuong_ky_luat.*,

                nhan_vien.ho_ten,

                nguoi_tao_nv.ho_ten
                AS nguoi_tao_ten
            ')

            ->join(
                'nhan_vien',
                'nhan_vien.nhan_vien_id
                = khen_thuong_ky_luat.nhan_vien_id'
            )

            ->join(
                'nhan_vien AS nguoi_tao_nv',
                'nguoi_tao_nv.nhan_vien_id
                = khen_thuong_ky_luat.nguoi_tao',
                'left'
            )

            ->orderBy(
                'ktkl_id',
                'ASC'
            )

            ->findAll();
    }
}