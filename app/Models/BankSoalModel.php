<?php

namespace App\Models;

use CodeIgniter\Model;

class BankSoalModel extends Model
{
    protected $table = 'tbbanksoal';
    protected $primaryKey = 'idbank';
    protected $allowedFields = ['idujian', 'idkelas', 'idmapel', 'nmbank', 'deleted', 'hal'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getMapel($id)
    {
        $sqmp = "SELECT akmapel FROM tbmapel WHERE idmapel=:id:";
        $query = $this->db->query($sqmp, array('id' => $id));
        return $query->getRowArray();
    }

    public function getUji()
    {
        $quji = "SELECT u.idujian, COUNT(p.idbank)+1 as kode FROM tbbanksoal p RIGHT JOIN tbujian u USING(idujian) WHERE u.status='1'";
        $query = $this->db->query($quji);
        return $query->getRowArray();
    }

    public function getKode($data)
    {
        $map = $this->getMapel($data['idmapel']);
        $uji = $this->getUji();
        return $map['akmapel'] . $uji['idujian'] . str_pad($data['idkelas'], 2, '0', STR_PAD_LEFT) . str_pad($uji['kode'], 3, '0', STR_PAD_LEFT);
    }

    public function getKls($id = '')
    {
        if ($id == '') {
            $sql = "SELECT idkelas, nmkelas FROM tbkelas INNER JOIN tbskul USING(idjenjang) GROUP BY idkelas";
            $query = $this->db->query($sql);
        } else {
            $sql = "SELECT idkelas, nmkelas FROM tbkelas INNER JOIN tbskul USING(idjenjang) WHERE idskul=:id: GROUP BY idkelas";
            $query = $this->db->query($sql, array('id' => $id));
        }
        return $query->getResultArray();
    }


    public function getKur($id = '')
    {
        if ($id == '') {
            $sql = "SELECT ku.* FROM tbkurikulum ku INNER JOIN tbkelas kl USING(idjenjang) GROUP BY ku.idkur";
            $query = $this->db->query($sql);
        } else {
            $sql = "SELECT ku.* FROM tbkurikulum ku INNER JOIN tbkelas kl USING(idjenjang) WHERE kl.idkelas=:id: GROUP BY ku.idkur";
            $query = $this->db->query($sql, array('id' => $id));
        }
        return $query->getResultArray();
    }

    public function getMapelByKur($id)
    {
        $sql = "SELECT mp.* FROM tbmapel mp INNER JOIN tbkurikulum ku USING(idkur) WHERE ku.idkur=:id: GROUP BY mp.idmapel";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->getResultArray();
    }

    public function getBank($id)
    {
        $sql = "SELECT bs.idbank, COUNT(so.idbutir) as jmlsoal, bs.hal FROM tbstimulus st LEFT JOIN tbsoal so USING(idstimulus) INNER JOIN tbbanksoal bs USING(idbank) WHERE st.idbank=:id: GROUP BY st.idbank ";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->getRowArray();
    }

    public function getData()
    {
        $sql = "SELECT bs.idbank, bs.nmbank, mp.nmmapel, k.nmkelas FROM tbbanksoal bs LEFT JOIN tbujian uj USING(idujian) LEFT JOIN tbkelas k USING(idkelas) LEFT JOIN tbmapel mp USING(idmapel) WHERE uj.aktif='1' AND bs.deleted='0'";
        $query = $this->db->query($sql);
        $tampil = [];
        foreach ($query->getResultArray() as $bs) {
            $sqbl = "SELECT bs.idbank, COUNT(so.idbutir) as jmlsoal FROM tbstimulus st LEFT JOIN tbsoal so USING(idstimulus) INNER JOIN tbbanksoal bs USING(idbank) WHERE st.idbank=:id: GROUP BY st.idbank";
            $query = $this->db->query($sqbl, array('id' => $bs['idbank']));
            $js = $query->getRowArray();
            $tampil[] = array(
                'idbank' => $bs['idbank'],
                'nmbank' => $bs['nmbank'],
                'nmkelas' => $bs['nmkelas'],
                'nmmapel' => $bs['nmmapel'],
                'jmlsoal' => $js == NULL ? 0 : $js['jmlsoal']
            );
        }
        return $tampil;
    }

    public function CountData($id = '')
    {
        if ($id == '') {
            return count($this->getData());
        } else {
            return count($this->getData($id));
        }
    }

    public function getSoal($data)
    {
        $opset = intval($data['hal']) <= 1 ? 0 : intval($data['hal']) - 1;
        $sql = "SELECT st.idstimulus, st.petunjuk, st.stimulus, st.gambar, st.audio, st.video, so.idbutir, so.nosoal, so.butirsoal, so.jnssoal, so.headeropsi, bs.idbank, bs.hal FROM tbstimulus st LEFT JOIN tbsoal so USING(idstimulus) INNER JOIN tbbanksoal bs USING(idbank) WHERE st.idbank=:id: LIMIT :hal:,1";
        $query = $this->db->query($sql, array('id' => $data['idbank'], 'hal' => $opset));
        return $query->getRowArray();
    }

    public function getOpsi($data)
    {
        $sql = "SELECT op.* FROM tbopsi op INNER JOIN tbsoal so USING(idbutir) INNER JOIN tbstimulus st USING(idstimulus) WHERE st.idbank=:id: AND so.nosoal=:hal:";
        $query = $this->db->query($sql, array('id' => $data['idbank'], 'hal' => $data['hal']));
        return $query->getResultArray();
    }

    public function updateUrut($data)
    {
        $builder = $this->db->table('tbbanksoal');
        $builder->where('idbank', $data['idbank']);
        return $builder->update(array('hal' => $data['hal']));
    }

    public function getNavSoal($id)
    {
        $sql = "SELECT so.idbutir, so.jnssoal, so.nosoal FROM tbsoal so INNER JOIN tbstimulus st USING(idstimulus) WHERE st.idbank=:id: ORDER BY so.nosoal";
        $query = $this->db->query($sql, array('id' => $id));
        $soal = [];
        foreach ($query->getResultArray() as $so) {
            $opsi = [];
            $sqbt = "SELECT op.* FROM tbopsi op WHERE op.idbutir=:id:";
            $query = $this->db->query($sqbt, array('id' => $so['idbutir']));
            foreach ($query->getResultArray() as $op) {
                $opsi[] = array(
                    'idopsi' => $op['idopsi'],
                    'benar' => $op['benar']
                );
            }
            $soal[] = array(
                'idbutir' => $so['idbutir'],
                'jnssoal' => $so['jnssoal'],
                'nosoal' => $so['nosoal'],
                'opsi' => $opsi
            );
        }
        return $soal;
    }
}
