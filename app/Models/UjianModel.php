<?php

namespace App\Models;

use CodeIgniter\Model;

class UjianModel extends Model
{
    protected $table = 'tbujian';
    protected $primaryKey = 'idujian';
    protected $allowedFields = ['akujian', 'nmujian', 'idthpel', 'aktif'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getTahun()
    {
        $rows = $this->db->table('tbthpel');
        $row = $rows->where('aktif', '1');
        return $row->get()->getRowArray();
    }
}
