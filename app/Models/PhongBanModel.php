<?php

namespace App\Models;

use CodeIgniter\Model;

class PhongBanModel extends Model
{
    protected $table = 'phong_ban';

    protected $primaryKey = 'phong_ban_id';

    protected $allowedFields = [
        'ten_phong_ban',
        'mo_ta'
    ];

    public function getAllPhongBan()
    {
        return $this

            ->select('
                phong_ban.*,
                COUNT(nhan_vien.nhan_vien_id)
                AS tong_nhan_vien
            ')

            ->join(
                'nhan_vien',
                'nhan_vien.phong_ban_id = phong_ban.phong_ban_id',
                'left'
            )

            ->groupBy(
                'phong_ban.phong_ban_id'
            )

            ->orderBy(
                'phong_ban.phong_ban_id',
                'ASC'
            )
            ->findAll();
    }
}