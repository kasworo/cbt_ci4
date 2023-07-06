<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbuser';
    protected $primaryKey = 'username';
    protected $allowedFields = ['namatmp', 'passwd', 'logakhir'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
