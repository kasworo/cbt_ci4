<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table = 'tbmapel';
    protected $primaryKey = 'idmapel';
    protected $allowedFields = ['idkur', 'akmapel', 'nmmampel', 'jenis', 'urut'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData($id = '')
    {
        $sql = "SELECT mp.*, ku.nmkur FROM tbmapel mp INNER JOIN tbkurikulum ku USING(idkur) INNER JOIN tbskul sk USING(idjenjang) WHERE sk.idskul=:id:";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->getResultArray();
    }

    public function getDataByKur($id = '')
    {
        $sql = "SELECT mp.*, ku.nmkur FROM tbmapel mp INNER JOIN tbkurikulum ku USING(idkur) WHERE mp.idkur=:id:";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->getResultArray();
    }

    public function getDataByID($id)
    {
        return $this->where(array('idmapel' => $id))->first();
    }

    public function CountData($id = '')
    {
        return count($this->getData($id));
    }
}
