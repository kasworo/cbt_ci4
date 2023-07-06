<?php

namespace App\Models;

use CodeIgniter\Model;

class KkmModel extends Model
{
    protected $table = 'tbkkm';
    protected $primaryKey = 'idkkm';
    protected $allowedFields = ['idskul', 'idkelas', 'idthpel', 'kkm'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKelas($skul)
    {
        $sql = "SELECT k.idkelas, k.nmkelas, rb.idkur FROM tbrombel rb INNER JOIN tbkelas k USING(idkelas) INNER JOIN tbkurikulum kur USING(idkur) INNER JOIN tbthpel tp USING(idthpel) INNER JOIN tbskul s ON s.idjenjang=k.idjenjang AND kur.idjenjang=s.idjenjang WHERE s.idskul=:id: AND tp.aktif='1' GROUP BY rb.idkelas ORDER BY rb.idkelas";
        $query = $this->db->query($sql, array('id' => $skul));
        return $query->getResultArray();
    }

    public function getMapel($skul)
    {
        $sql = "SELECT mp.*, kur.nmkur FROM tbmapel mp INNER JOIN tbkurikulum kur USING(idkur) INNER JOIN tbrombel rb USING(idkur) INNER JOIN tbthpel tp USING(idthpel) INNER JOIN tbskul s USING(idskul) WHERE s.idskul=:id: AND tp.aktif='1' GROUP BY mp.idmapel, rb.idkur";
        $query = $this->db->query($sql, array('id' => $skul));
        return $query->getResultArray();
    }
}
