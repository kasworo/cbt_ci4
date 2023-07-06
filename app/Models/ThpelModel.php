<?php

namespace App\Models;

use CodeIgniter\Model;

class ThpelModel extends Model
{
    protected $table = 'tbthpel';
    protected $primaryKey = 'idthpel';
    protected $allowedFields = ['nmthpel', 'desthpel', 'awal', 'aktif'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
