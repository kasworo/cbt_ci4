<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function jmlSkul($id = '')
    {

        if ($id == '') {
            $sql = "SELECT*FROM tbskul";
            $query = $this->db->query($sql);
        } else {
            $sql = "SELECT*FROM tbskul WHERE idskul=:id:";
            $query = $this->db->query($sql, array('id' => $id));
        }
        return $query->getNumRows();
    }


    public function jmlMapel($id = '')
    {
        if ($id == '') {
            $sql = "SELECT*FROM tbmapel";
            $query = $this->db->query($sql);
        } else {
            $sql = "SELECT mp.* FROM tbmapel mp INNER JOIN tbkurikulum kr USING(idkur) INNER JOIN tbskul sk USING(idjenjang) WHERE sk.idskul=:id:";
            $query = $this->db->query($sql, array('id' => $id));
        }
        return $query->getNumRows();
    }

    public function jmlBank()
    {
        $sql = "SELECT*FROM tbbanksoal";
        $query = $this->db->query($sql);
        return $query->getNumRows();
    }
}
