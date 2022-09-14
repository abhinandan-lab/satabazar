<?php

namespace App\Models;

use CodeIgniter\Model;

// use Modules\Authentication\Models\UserAuthModel;

class SattaModel extends Model
{
    protected $primaryKey = 'id';
    protected $table      = 'satta_panel';
    protected $allowedFields = ['satta_number', 'current_date', 'satta_id'];
}