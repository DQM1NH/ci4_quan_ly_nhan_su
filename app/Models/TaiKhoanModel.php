<?php

namespace App\Models;

use CodeIgniter\Model;

class TaiKhoanModel extends Model
{
    protected $table = 'tai_khoan';

    protected $primaryKey = 'tai_khoan_id';

    protected $allowedFields = [

        'ten_dang_nhap',
        'mat_khau',
        'nhan_vien_id',
        'khoa'
    ];

    public function getUserLogin($username)
    {
        return $this

            ->select('tai_khoan.*, nhan_vien.ho_ten, nhan_vien.vai_tro_id')

            ->join(
                'nhan_vien',
                'nhan_vien.nhan_vien_id
                = tai_khoan.nhan_vien_id'
            )

            ->where(
                'ten_dang_nhap',
                $username
            )

            ->first();
    }

    public function getAllTaiKhoan()
    {
        return $this

            ->select('
                tai_khoan.tai_khoan_id,
                tai_khoan.ten_dang_nhap,
                tai_khoan.khoa,

                nhan_vien.ho_ten,
                nhan_vien.email,
                nhan_vien.so_dien_thoai,

                vai_tro.ten_vai_tro,

                phong_ban.ten_phong_ban
            ')

            ->join(
                'nhan_vien',
                'nhan_vien.nhan_vien_id = tai_khoan.nhan_vien_id'
            )

            ->join(
                'vai_tro',
                'vai_tro.vai_tro_id = nhan_vien.vai_tro_id'
            )

            ->join(
                'phong_ban',
                'phong_ban.phong_ban_id = nhan_vien.phong_ban_id',
                'left'
            )

            ->orderBy(
                'tai_khoan.tai_khoan_id',
                'DESC'
            )

            ->findAll();
    }
}