<?php

namespace App\Models;

use CodeIgniter\Model;

// use Modules\Authentication\Models\UserAuthModel;

class AdminModel extends Model
{
    protected $allowedFields = ['email', 'password', 'verify_otp'];

}