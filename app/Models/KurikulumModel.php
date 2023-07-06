<?php

namespace App\Models;

use CodeIgniter\Model;

class KurikulumModel extends Model
{
    protected $table = 'tbkurikulum';
    protected $primaryKey = 'idkur';
    protected $allowedFields = ['idjenjang', 'akkur', 'nmkur', 'aktif'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData($id = '')
    {
        if ($id == '') {
            $builder = $this->db->table($this->table);
            $builder->select('tbkurikulum.*, tbjenjang.nmjenjang');
            $builder->join('tbjenjang', 'tbjenjang.idjenjang = tbkurikulum.idjenjang', 'inner');
            $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('tbkurikulum.*, tbjenjang.nmjenjang');
            $builder->join('tbjenjang', 'tbjenjang.idjenjang = tbkurikulum.idjenjang', 'inner');
            $builder->join('tbskul', 'tbskul.idjenjang = tbjenjang.idjenjang', 'inner');
            $builder->where('tbskul.idskul', $id);
            $query = $builder->get();
        }
        return $query->getResultArray();
    }

    public function getJenjang()
    {
        $builder = $this->db->table($this->table);
        $builder->select('tbjenjang.*');
        $builder->join('tbjenjang', 'tbjenjang.idjenjang = tbkurikulum.idjenjang', 'inner');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
