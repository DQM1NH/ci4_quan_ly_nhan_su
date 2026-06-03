<?php

namespace App\Models;

use CodeIgniter\Model;

class VaiTroModel extends Model
{
    protected $table =
        'vai_tro';

    protected $primaryKey =
        'vai_tro_id';

    protected $allowedFields = [

        'ten_vai_tro',
        'cap_bac',
        'mo_ta'
    ];

    public function getAllVaiTro()
    {
        return $this

            ->orderBy(
                'cap_bac',
                'ASC'
            )

            ->findAll();
    }
}