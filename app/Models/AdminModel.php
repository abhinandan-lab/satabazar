<?php

namespace App\Models;

use CodeIgniter\Model;

// use Modules\Authentication\Models\UserAuthModel;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'verify_otp'];

}