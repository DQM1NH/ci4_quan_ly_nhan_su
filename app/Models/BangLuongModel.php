<?php

namespace App\Models;

use CodeIgniter\Model;

class BangLuongModel extends Model
{
    protected $table = 'bang_luong';
    protected $primaryKey = 'bang_luong_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nhan_vien_id',
        'ky_luong_id',
        'luong_co_ban',
        'phu_cap',
        'thuong',
        'luong_tang_ca',
        'khau_tru',
        'bao_hiem',
        'thue',
        'luong_thuc_nhan',
        'ngay_thanh_toan',
        'trang_thai_thanh_toan'
    ];

    public function getAllBangLuong()
    {
        return $this
            ->select('bang_luong.*, nhan_vien.ho_ten, ky_luong.thang, ky_luong.nam')
            ->join('nhan_vien', 'nhan_vien.nhan_vien_id = bang_luong.nhan_vien_id')
            ->join('ky_luong', 'ky_luong.ky_luong_id = bang_luong.ky_luong_id')
            ->orderBy('bang_luong_id', 'ASC')
            ->findAll();
    }

    public function getDetail($id)
    {
        return $this
            ->select('bang_luong.*, nhan_vien.ho_ten, nhan_vien.ma_nhan_vien, ky_luong.thang, ky_luong.nam')
            ->join('nhan_vien', 'nhan_vien.nhan_vien_id = bang_luong.nhan_vien_id')
            ->join('ky_luong', 'ky_luong.ky_luong_id = bang_luong.ky_luong_id')
            ->where('bang_luong_id', $id)
            ->first();
    }
}