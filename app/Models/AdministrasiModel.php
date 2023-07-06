<?php

namespace App\Models;

use CodeIgniter\Model;

class AdministrasiModel extends Model
{
    public function getUjiAktif()
    {
        $builder = $this->db->table('tbujian u');
        $builder->select('u.*, LEFT(th.desthpel,9) as tahun, CASE WHEN RIGHT(th.nmthpel,1)="1" THEN "Ganjil" ELSE "Genap" END as semester');
        $builder->join('tbthpel th', 'u.idthpel = th.idthpel');
        $builder->where('u.aktif', '1');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getPeserta($id = '')
    {
        $builder = $this->db->table('tbsiswa si');
        $builder->select('si.idsiswa, si.nisn, si.nis, si.tmplahir, si.tgllahir, si.nmsiswa, kl.idkelas, kl.nmkelas, rb.nmrombel, sk.nmskul, ps.idujian, ps.nmpeserta, ps.idruang, ps.passwd, ps.aktif, sk.nmskul');
        $builder->join('tbskul sk', 'si.idskul = sk.idskul');
        $builder->join('tbregistrasi rg', 'si.idsiswa = rg.idsiswa');
        $builder->join('tbrombel rb', 'rg.idrombel = rb.idrombel AND sk.idskul = rb.idskul');
        $builder->join('tbkelas kl', 'rb.idkelas = kl.idkelas AND sk.idjenjang = kl.idjenjang');
        $builder->join('tbpeserta ps', 'si.idsiswa = ps.idsiswa', 'left');
        $builder->join('tbujian uj', 'ps.idujian = uj.idujian', 'left');
        $builder->where('uj.aktif', '1');

        if (!empty($id)) {
            $builder->where('si.idskul', $id);
        } else {
            $builder->orWhere('ps.idujian IS NULL');
        }

        $builder->groupBy('si.idsiswa');

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getRombel($id = '')
    {
        $builder = $this->db->table('tbsiswa si');
        $builder->select('rg.idrombel, rb.nmrombel, si.idskul, sk.nmskul, ps.idujian, u.nmujian, LEFT(tp.desthpel,9) as tahun');
        $builder->join('tbskul sk', 'si.idskul = sk.idskul', 'inner');
        $builder->join('tbpeserta ps', 'si.idsiswa = ps.idsiswa', 'inner');
        $builder->join('tbregistrasi rg', 'si.idsiswa = rg.idsiswa', 'inner');
        $builder->join('tbrombel rb', 'rb.idrombel = rg.idrombel AND rb.idskul=sk.idskul', 'inner');
        $builder->join('tbujian u', 'ps.idujian = u.idujian', 'inner');
        $builder->join('tbthpel tp', 'u.idthpel = tp.idthpel', 'inner');
        $builder->where('u.aktif', '1');
        if (!empty($id)) {
            $builder->where('rb.idskul', $id);
        }
        $builder->groupBy(['rg.idrombel', 'si.idskul']);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPesertaRombel($id)
    {
        $builder = $this->db->table('tbpeserta ps');
        $builder->select('ps.nmpeserta, si.nis, si.nisn, si.nmsiswa, si.tmplahir, si.tgllahir,rb.nmrombel, ps.idruang, ps.passwd');
        $builder->join('tbsiswa si', 'si.idsiswa = ps.idsiswa');
        $builder->join('tbujian u', 'u.idujian = ps.idujian');
        $builder->join('tbregistrasi rg', 'rg.idsiswa = ps.idsiswa');
        $builder->join('tbrombel rb', 'rb.idrombel = rg.idrombel');
        $builder->join('tbthpel tp', 'tp.idthpel = rb.idthpel AND tp.idthpel = u.idthpel');
        $builder->where('rg.idrombel', $id);
        $builder->orderBy('si.nmsiswa');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getRuang($id = '')
    {
        $builder = $this->db->table('tbsiswa si');
        $builder->select('si.idskul, sk.nmskul, ps.idruang, ps.idujian, u.nmujian, LEFT(tp.desthpel,9) as tahun');
        $builder->join('tbskul sk', 'si.idskul = sk.idskul', 'inner');
        $builder->join('tbpeserta ps', 'si.idsiswa = ps.idsiswa', 'inner');
        $builder->join('tbujian u', 'ps.idujian = u.idujian', 'inner');
        $builder->join('tbthpel tp', 'u.idthpel = tp.idthpel', 'inner');
        $builder->where('u.aktif', '1');

        if (!empty($id)) {
            $builder->where('si.idskul', $id);
        }
        $builder->groupBy(['ps.idruang', 'si.idskul']);

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPesertaRuang()
    {
        $peserta = [];
        $ruangData = $this->getRuang();
        foreach ($ruangData as $data) {
            $builder = $this->db->table('tbpeserta ps');
            $builder->select('ps.nmpeserta, si.nis, si.nisn, si.nmsiswa, rb.nmrombel, ps.idruang');
            $builder->join('tbsiswa si', 'si.idsiswa = ps.idsiswa');
            $builder->join('tbujian u', 'u.idujian = ps.idujian');
            $builder->join('tbregistrasi rg', 'rg.idsiswa = ps.idsiswa');
            $builder->join('tbrombel rb', 'rb.idrombel = rg.idrombel');
            $builder->join('tbthpel tp', 'tp.idthpel = rb.idthpel AND tp.idthpel = u.idthpel');
            $builder->where('ps.idujian', $data['idujian']);
            $builder->where('si.idskul', $data['idskul']);
            $builder->where('ps.idruang', $data['idruang']);
            $builder->orderBy('ps.nmpeserta');

            $query = $builder->get();
            $peserta[] = $query->getResultArray();
        }

        return $peserta;
    }
}
