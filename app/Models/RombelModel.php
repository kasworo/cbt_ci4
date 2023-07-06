<?php

namespace App\Models;

use CodeIgniter\Model;

class RombelModel extends Model
{
    protected $table = 'tbrombel';
    protected $primaryKey = 'idrombel';
    protected $allowedFields = ['idkelas', 'idkur', 'idskul', 'idthpel', 'idgtk', 'nmrombel'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getData($id = '')
    {
        if ($id == '') {
            $query = $this->db->table($this->table);
            $query->select('tbrombel.*,tbkelas.nmkelas, tbgtk.nama, tbkurikulum.nmkur')
                ->join('tbskul', 'tbrombel.idskul = tbskul.idskul', 'inner')
                ->join('tbkelas', 'tbrombel.idkelas = tbkelas.idkelas', 'inner')
                ->join('tbkurikulum', 'tbrombel.idkur = tbkurikulum.idkur', 'inner')
                ->join('tbgtk', 'tbrombel.idgtk = tbgtk.idgtk', 'inner')
                ->join('tbthpel', 'tbrombel.idthpel = tbthpel.idthpel', 'inner')
                ->where('tbthpel.aktif', '1');
        } else {
            $query = $this->db->table($this->table);
            $query->select('tbrombel.*,tbkelas.nmkelas, tbgtk.nama, tbkurikulum.nmkur')
                ->join('tbskul', 'tbrombel.idskul = tbskul.idskul', 'inner')
                ->join('tbkelas', 'tbrombel.idkelas = tbkelas.idkelas', 'inner')
                ->join('tbkurikulum', 'tbrombel.idkur = tbkurikulum.idkur', 'inner')
                ->join('tbgtk', 'tbrombel.idgtk = tbgtk.idgtk', 'inner')
                ->join('tbthpel', 'tbrombel.idthpel = tbthpel.idthpel', 'inner')
                ->where(array('tbthpel.aktif' => '1', 'tbrombel.idskul' => $id));
        }
        return $query->get()->getResultArray();
    }

    public function CountData($id = '')
    {
        return count($this->getData($id));
    }

    public function getKelas($id = '')
    {
        if ($id == '') {
            $sql = "SELECT k.idkelas, k.nmkelas FROM tbkelas k INNER JOIN tbskul sk USING(idjenjang)";
            $query = $this->db->query($sql)->getResultArray();
        } else {
            $sql = "SELECT k.idkelas, k.nmkelas FROM tbkelas k INNER JOIN tbskul sk USING(idjenjang) WHERE sk.idskul=:id: GROUP BY idkelas";
            $query = $this->db->query($sql, ['id' => $id])->getResultArray();
        }
        return $query;
    }
}
