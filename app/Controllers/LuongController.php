<?php

namespace App\Controllers;

class LuongController extends BaseController
{
    public function tinhLuong()
    {
        $db = \Config\Database::connect();
        $db->query(" CALL sp_tinh_luong(1, 1, 10000000, 1000000, 500000, 0, 0, 1000000, 500000)");
        return 'Đã tính lương';
    }
}