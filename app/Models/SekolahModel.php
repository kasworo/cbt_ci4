<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = 'tbskul';
    protected $primaryKey = 'idskul';
    protected $allowedFields = ['kdskul', 'idjenjang', 'npsn', 'nss', 'nmskul', 'nmskpd', 'alamat', 'kdpos', 'telp', 'email', 'website', 'logoskul', 'logoskpd', 'passwd'];
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData($id = '')
    {
        $builder = $this->db->table('tbskul sk');
        $builder->select('sk.*, jjg.nmjenjang');
        $builder->join('tbjenjang jjg', 'jjg.idjenjang = sk.idjenjang', 'inner');
        if ($id === '') {
            $query = $builder->get();
            return $query->getResultArray();
        } else {
            return $builder->where('sk.idskul', $id)->get()->getRowArray();
        }
    }

    public function getSkul($id = '')
    {
        $builder = $this->db->table('tbskul sk');
        $builder->select('sk.idskul, sk.nmskul');
        $builder->join('tbjenjang jjg', 'jjg.idjenjang = sk.idjenjang', 'inner');

        if ($id === '') {
            $query = $builder->get();
            return $query->getResultArray();
        } else {
            return $builder->where('sk.idskul', $id)->get()->getResultArray();
        }
    }

    public function CountData($id = '')
    {
        return count($this->getSkul($id));
    }
}
