<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'tbjadwal';
    protected $primaryKey = 'idjadwal';
    protected $allowedFields = ['idujian', 'kdjadwal', 'matauji', 'tglujian', 'durasi', 'mulai', 'akhir', 'lambat', 'susulan'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData()
    {
        $query = $this->db->table('tbjadwal')
            ->select('tbjadwal.*')
            ->join('tbujian', 'tbujian.idujian = tbjadwal.idujian', 'left')
            ->where('tbujian.aktif', '1')
            ->get();
        return $query->getResultArray();
    }
}
