<?php

namespace App\Models;

use CodeIgniter\Model;

// use Modules\Authentication\Models\UserAuthModel;

class SattaModel extends Model
{
    protected $table      = 'satta';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'satta_number', 'start_time', 'end_time'];


    // get sata list
    public function getList() {
        $list = $userModel->findAll();

    }
}