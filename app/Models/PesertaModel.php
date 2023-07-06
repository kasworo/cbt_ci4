<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table = 'tbpeserta';
    protected $primaryKey = 'idpeserta';
    protected $allowedFields = ['idsiswa', 'nmpeserta', 'idujian', 'idruang', 'aktif', 'passwd'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getpasswd($hrf)
    {
        $kar = '1234567890';
        $jkar = strlen($kar);
        $jkar--;
        $token = NULL;
        for ($x = 1; $x <= $hrf; $x++) {
            $pos = rand(0, $jkar);
            $token .= substr($kar, $pos, 1);
        }
        return $token;
    }

    public function getData($id = '')
    {
        $builder = $this->db->table('tbsiswa si')
            ->select('si.idsiswa, si.nisn, si.nmsiswa, rb.idkelas, rb.nmrombel,sk.nmskul, ps.idujian, ps.nmpeserta , ps.passwd, ps.aktif')
            ->join('tbskul sk', 'si.idskul = sk.idskul', 'inner')
            ->join('tbregistrasi rg', 'rg.idsiswa = si.idsiswa', 'inner')
            ->join('tbrombel rb', 'rb.idrombel = rg.idrombel AND rb.idskul = si.idskul', 'inner')
            ->join('tbkelas kl', 'kl.idkelas = rb.idkelas', 'inner')
            ->join('tbujian uj', 'uj.idujian = ps.idujian', 'left')
            ->where('uj.aktif', '1')
            ->groupBy('si.idsiswa');

        if ($id != '') {
            $builder->where('si.idskul', $id);
        }

        $result = $builder->orderBy('ps.nmpeserta')
            ->get()
            ->getResultArray();

        return $result;
    }

    public function getSkul($id = '')
    {
        $builder = $this->db->table('tbskul');

        if ($id != '') {
            $builder->where('idskul', $id);
        }

        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function getKelas($id = '')
    {
        $builder = $this->db->table('tbkelas k')
            ->join('tbskul s', 's.idjenjang = k.idjenjang', 'inner')
            ->groupBy('k.idkelas');

        if ($id != '') {
            $builder->where('s.idskul', $id);
        }

        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function getUjiAktif()
    {
        $builder = $this->db->table('tbujian u')
            ->join('tbthpel th', 'th.idthpel = u.idthpel', 'inner')
            ->select('u.*, LEFT(th.desthpel,9) as tahun, CASE WHEN RIGHT(th.nmthpel,1) = \'1\' THEN \'Ganjil\' ELSE \'Genap\' END as semester')
            ->where('u.aktif', '1');

        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function ambilKelas($id)
    {
        $builder = $this->db->table('tbkelas k')
            ->join('tbskul sk', 'sk.idjenjang = k.idjenjang', 'inner')
            ->where('sk.idskul', $id)
            ->groupBy('k.idkelas');

        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function isiNopes($uji, $skul)
    {
        $builder = $this->db->table('tbpeserta ps')
            ->join('tbsiswa si', 'si.idsiswa = ps.idsiswa', 'inner')
            ->where('ps.idujian', $uji)
            ->where('si.idskul', $skul);

        $d = $builder->countAllResults() + 1;
        $nopes = ($d < 8) ? substr('0000' . $d, -4) . (10 - (($d % 9 + 1) % 9)) : substr('0000' . $d, -4) . (10 - (($d % 8 + 1) % 8));

        return $nopes;
    }

    public function acakPeserta($skul, $kls)
    {
        $kbh = $this->ambilKelas($skul);
        $kabeh = array_column($kbh, 'idkelas');
        $kelas = array_map('intval', $kls);
        $klse = array_values(array_diff($kabeh, $kelas));

        $builder = $this->db->table('tbregistrasi rg')
            ->select('rg.idsiswa, sk.kdskul, rb.idskul')
            ->join('tbrombel rb', 'rb.idrombel = rg.idrombel', 'inner')
            ->join('tbskul sk', 'sk.idskul = rb.idskul', 'inner')
            ->join('tbkelas kl', 'kl.idkelas = rb.idkelas', 'inner')
            ->join('tbthpel tp', 'tp.idthpel = kl.idthpel', 'inner')
            ->where('rb.idskul', $skul)
            ->where('tp.aktif', '1');

        if (count($klse) == 1) {
            $builder->where('rb.idkelas !=', $klse[0]);
        } elseif (count($klse) == 0) {
            // Do nothing, get all results
        } else {
            $builder->whereIn('rb.idkelas', $kls);
        }

        $result = $builder->orderBy('RAND()')
            ->get()
            ->getResultArray();

        return $result;
    }

    public function getNopes($data)
    {
        $this->deletePeserta();
        $sukses = 0;
        $datapst = $this->acakPeserta($data['idskul'], $data['idkelas']);

        foreach ($datapst as $pst) {
            $paswd = $this->getpasswd(6) . '*';
            $dpn = $pst['kdskul'] . $this->isiNopes($data['idujian'], $pst['idskul']);
            $post = [
                'idujian' => $data['idujian'],
                'idsiswa' => $pst['idsiswa'],
                'nmpeserta' => $dpn,
                'passwd' => $paswd
            ];

            $this->insert($post, false);
            $sukses++;
        }

        $this->setRuang($data['ruang'], $data['idujian']);

        return $sukses;
    }

    public function deletePeserta()
    {
        $builder = $this->db->table('tbpeserta');
        $builder->truncate();
        $builder->resetQuery();
    }

    public function getPeserta($iduji)
    {
        $builder = $this->db->table('tbpeserta');
        $builder->where('idujian', $iduji);

        return $builder->countAllResults();
    }

    public function setRuang($ruang, $iduji)
    {
        $semua = $this->getPeserta($iduji);
        $ok = 0;
        $isi = round($semua / $ruang, 0);
        for ($i = 1; $i <= $ruang; $i++) {
            $sqr = "UPDATE tbpeserta SET idruang=:idrg: WHERE idujian=:iduj: AND idruang IS NULL ORDER BY nmpeserta ASC LIMIT :isi:";
            $key = [
                'idrg' => $i,
                'iduj' => $iduji,
                'isi' => intval($isi)
            ];

            $this->db->query($sqr, $key);
            $ok++;
        }

        return $ok;
    }
}
