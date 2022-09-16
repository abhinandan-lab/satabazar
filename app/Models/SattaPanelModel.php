<?php

namespace App\Models;

use CodeIgniter\Model;

// use Modules\Authentication\Models\UserAuthModel;

class SattaPanelModel extends Model
{
    protected $primaryKey = 'id';
    protected $table      = 'satta_panel';
    protected $allowedFields = ['satta_number', 'current_date', 'satta_id'];
}