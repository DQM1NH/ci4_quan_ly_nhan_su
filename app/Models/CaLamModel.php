<?php

namespace App\Models;

use CodeIgniter\Model;

class CaLamModel extends Model
{
    protected $table =
        'ca_lam';

    protected $primaryKey =
        'ca_lam_id';

    protected $allowedFields = [

        'ten_ca',
        'gio_bat_dau',
        'gio_ket_thuc'
    ];
}