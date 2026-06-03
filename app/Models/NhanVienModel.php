<?php

namespace App\Models;

use CodeIgniter\Model;

class NhanVienModel extends Model
{
    protected $table = 'nhan_vien';

    protected $primaryKey = 'nhan_vien_id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'ma_nhan_vien',
        'ho_ten',
        'gioi_tinh',
        'ngay_sinh',
        'so_dien_thoai',
        'email',
        'dia_chi',
        'luong',
        'ngay_vao_lam',
        'phong_ban_id',
        'vai_tro_id',
        'quan_ly_id',
        'trang_thai'
    ];
    protected $useTimestamps = true;

    public function getAllNhanVien()
    {
        return $this
            ->select('
                nhan_vien.*,
                phong_ban.ten_phong_ban,
                vai_tro.ten_vai_tro
            ')
            ->join(
                'phong_ban',
                'phong_ban.phong_ban_id = nhan_vien.phong_ban_id',
                'left'
            )
            ->join(
                'vai_tro',
                'vai_tro.vai_tro_id = nhan_vien.vai_tro_id',
                'left'
            )
            ->orderBy(
                'nhan_vien_id',
                'DESC'
            )
            ->findAll();
    }

    public function getNhanVien()
    {
        return $this
            ->select('nhan_vien_id, ho_ten')

            ->orderBy('ho_ten', 'ASC')

            ->findAll();
    }

    public function getDetail($id)
    {
        return $this

            ->select('nhan_vien.*, phong_ban.ten_phong_ban, vai_tro.ten_vai_tro')

            ->join('phong_ban', 'phong_ban.phong_ban_id = nhan_vien.phong_ban_id', 'left')

            ->join('vai_tro', 'vai_tro.vai_tro_id = nhan_vien.vai_tro_id', 'left')

            ->where('nhan_vien_id', $id)

            ->first();
    }
}