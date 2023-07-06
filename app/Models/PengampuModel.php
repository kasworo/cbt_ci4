<?php

namespace App\Models;

use CodeIgniter\Model;

class PengampuModel extends Model
{
    protected $table = 'tbpengampu';
    protected $primaryKey = 'idampu';
    protected $allowedFields = ['idrombel', 'idmapel', 'idgtk'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }
    public function getData($id)
    {
        $sql = "SELECT mp.nmmapel,mp.akmapel, rb.nmrombel, mp.idmapel, am.idgtk, rb.idrombel, gr.nama FROM tbmapel mp INNER JOIN tbkurikulum k USING(idkur) INNER JOIN tbrombel rb USING(idkur) LEFT JOIN tbpengampu am USING(idrombel, idmapel) LEFT JOIN tbgtk gr ON am.idgtk=gr.idgtk WHERE rb.idrombel=:id:";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->getResultArray();
    }

    public function getGuru()
    {
        $sql = "SELECT gt.idgtk, gt.nama FROM tbgtk gt INNER JOIN tbskul sk USING(idskul) WHERE gt.jbtdinas<>'1'";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function cekData($data)
    {
        $builder = $this->table($this->table);
        $builder->where($data);
        return $builder->countAllResults();
    }
}
