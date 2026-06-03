<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\NhanVienModel;

class AuthModel extends Model
{
    public $table = 'tai_khoan';
    public $primaryKey = 'tai_khoan_id';

    public function login($username)
    {
        // return $this
        //     ->select('
        //         tai_khoan.*,
        //         nhan_vien.ho_ten,
        //         nhan_vien.nhan_vien_id,
        //         vai_tro.ten_vai_tro
        //     ')
        //     ->join(
        //         'nhan_vien',
        //         'nhan_vien.nhan_vien_id = tai_khoan.nhan_vien_id'
        //     )
        //     ->join(
        //         'vai_tro',
        //         'vai_tro.vai_tro_id = nhan_vien.vai_tro_id'
        //     )
        //     ->where('ten_dang_nhap', $username)
        //     ->where('khoa', 0)
        //     ->first();

        return $this->db->table('tai_khoan tk')
            ->select('
                tk.*,
                nv.nhan_vien_id,
                nv.ho_ten,
                nv.email,
                vt.ten_vai_tro,
                vt.vai_tro_id
            ')
            ->join('nhan_vien nv', 'nv.nhan_vien_id = tk.nhan_vien_id')
            ->join('vai_tro vt', 'vt.vai_tro_id = nv.vai_tro_id')
            ->where('tk.ten_dang_nhap', $username)
            ->get()
            ->getRowArray();
    }

    public function getPermissions($vaiTroId)
    {
        return $this->db->table('vai_tro_quyen vtq')
            ->select('q.ten_quyen')
            ->join('quyen q', 'q.quyen_id = vtq.quyen_id')
            ->where('vtq.vai_tro_id', $vaiTroId)
            ->get()
            ->getResultArray();
    }
}